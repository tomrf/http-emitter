<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter;

use Psr\Http\Message\ResponseInterface;
use Tomrf\HttpEmitter\Interface\SapiEmitterInterface;
use Tomrf\HttpEmitter\Sapi\SapiCliEmitter;
use Tomrf\HttpEmitter\Sapi\SapiEmitter;

/**
 * PSR-7 message response emitter.
 */
class HttpEmitter
{
    public function emit(ResponseInterface $response): void
    {
        $emitterClass = SapiEmitter::class;

        if (\PHP_SAPI === 'cli') {
            $emitterClass = SapiCliEmitter::class;
        }

        /** @var SapiEmitterInterface */
        $sapiEmitter = new $emitterClass();

        $sapiEmitter->emit($response);
    }
}
