<?php

declare(strict_types=1);

namespace Tomrf\HttpEmitter\Sapi;

use Psr\Http\Message\ResponseInterface;
use Tomrf\HttpEmitter\Interface\SapiEmitterInterface;

/**
 * PSR-7 message response emitter for SAPI cli.
 */
class SapiCliEmitter extends SapiEmitter implements SapiEmitterInterface
{
    private const TERM_COLOR_DEFAULT = 92;
    private const TERM_COLOR_WARNING = 93;
    private const TERM_COLOR_ERROR = 91;

    /**
     * Emits the response body.
     */
    public function emit(ResponseInterface $response): void
    {
        // set terminal color to for printing message information
        $termColor = self::TERM_COLOR_DEFAULT;
        if ($response->getStatusCode() > 299) {
            $termColor = self::TERM_COLOR_WARNING;
        }
        if ($response->getStatusCode() > 399) {
            $termColor = self::TERM_COLOR_ERROR;
        }

        // rewind and get message body
        $response->getBody()->rewind();
        $messageBody = $response->getBody()->getContents();

        // print http response status
        $this->echo($termColor, sprintf(
            '* HTTP/%s %d %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase(),
        ));

        // print message headers
        $this->echo($termColor, '* Headers');
        foreach ($response->getHeaders() as $key => $values) {
            $this->echo($termColor, '*   '.$key.': '.implode(', ', $values));
        }

        // print message body
        $this->echo($termColor, '* Body');
        echo $messageBody;

        // print end of message body indicator
        $this->echo(
            $termColor,
            sprintf(
                '* End of response body (%d bytes emitted)',
                \strlen($messageBody)
            )
        );
    }

    /**
     * Prints to terminal using specified text foreground color.
     *
     * @param bool|float|int|string ...$args
     */
    private function echo(int $termColor, string|int|float|bool ...$args): void
    {
        foreach ($args as $arg) {
            echo sprintf("\033[%dm %s \033[0m", $termColor, $arg);
        }
        echo PHP_EOL;
    }
}
