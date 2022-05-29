<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter\Test;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Tomrf\HttpEmitter\HttpEmitter;

/**
 * @internal
 * @covers \Tomrf\HttpEmitter\HttpEmitter
 * @covers \Tomrf\HttpEmitter\Sapi\SapiCliEmitter
 * @covers \Tomrf\HttpEmitter\Sapi\SapiEmitter
 */
final class HttpEmitterTest extends TestCase
{
    public static $psr17Factory;
    public static \Faker\Generator $faker;

    public static function setUpBeforeClass(): void
    {
        static::$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
        static::$faker = \Faker\Factory::create();
    }

    public function testHttpEmitterIsInstanceOfHttpEmitter(): void
    {
        static::assertInstanceOf(HttpEmitter::class, new HttpEmitter());
    }

    public function testHttpEmitter(): void
    {
        $httpEmitter = new HttpEmitter();

        $body = static::$faker->randomHtml();
        $status = random_int(100, 599);

        $response = $this->createResponse($status, $body);

        $this->expectOutputRegex(sprintf('/HTTP\\/1\.1 %d/', $status));
        $httpEmitter->emit($response);
    }

    public function testHttpEmitterWithCustomHeaders(): void
    {
        $httpEmitter = new HttpEmitter();
        $response = $this->createResponse(200, static::$faker->randomHtml());

        $key = static::$faker->word();
        $value = static::$faker->words(random_int(1, 5), true);

        $response = $response->withHeader($key, $value);

        $this->expectOutputRegex(sprintf('/\\*   %s: %s/', $key, $value));
        $httpEmitter->emit($response);
    }

    private function createResponse(int $status, ?string $body = null): ResponseInterface
    {
        /** @var ResponseFactoryInterface */
        $responseFactory = static::$psr17Factory;

        $response = $responseFactory->createResponse($status, '');

        if (null !== $body) {
            $response->getBody()->write($body);
        }

        return $response;
    }
}
