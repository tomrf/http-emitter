<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter\Interface;

use Psr\Http\Message\ResponseInterface;

interface SapiEmitterInterface
{
    public function emit(ResponseInterface $response): void;
}
