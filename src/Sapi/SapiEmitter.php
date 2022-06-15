<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter\Sapi;

use Psr\Http\Message\ResponseInterface;
use Tomrf\HttpEmitter\Interface\SapiEmitterInterface;

/**
 * Generic PSR-7 message response emitter for SAPI.
 */
class SapiEmitter implements SapiEmitterInterface
{
    /**
     * Emits the response to standard output.
     */
    public function emit(ResponseInterface $response): void
    {
        $this->setHeaders($response);
        $this->emitResponseBody($response);
    }

    /**
     * Sets all response headers using header().
     */
    private function setHeaders(ResponseInterface $response): void
    {
        header(sprintf(
            'HTTP/%s %d %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        ));

        foreach ($response->getHeaders() as $key => $values) {
            header(sprintf('%s: %s', $key, implode(', ', $values)));
        }
    }

    /**
     * Emits the response body.
     */
    private function emitResponseBody(ResponseInterface $response): void
    {
        echo $response->getBody();
    }
}
