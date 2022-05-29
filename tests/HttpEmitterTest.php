<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter\Test;

use PHPUnit\Framework\TestCase;
use Tomrf\HttpEmitter\HttpEmitter;

/**
 * @internal
 * @covers \Tomrf\SkeletonPackage\SkeletonClass
 */
final class HttpEmitterTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        // ...
    }

    public function testSkeletonClassIsInstanceOfSkeletonClass(): void
    {
        static::assertInstanceOf(HttpEmitter::class, new HttpEmitter());
    }

    public function testHello(): void
    {
        static::assertSame('Hello, world.', (new HttpEmitter())->hello());
    }
}
