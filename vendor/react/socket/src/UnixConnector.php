<?php

namespace React\Socket;

use React\Socket\ConnectorInterface;
use React\EventLoop\LoopInterface;
use React\Promise;
use RuntimeException;

/**
 * Unix domain socket connector
 *
 * Unix domain sockets use atomic operations, so we can as well emulate
 * async behavior.
 */
final class UnixConnector implements ConnectorInterface
{
    private $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function connect($path)
    {
        if (strpos($path, '://') === false) {
            $path = 'unix://' . $path;
        } elseif (substr($path, 0, 7) !== 'unix://') {
            return Promise\reject(new \InvalidArgumentException('Given URI "' . $path . '" is invalid'));
        }

        $resource = @stream_socket_client($path, $errno, $errstr, 1.0);

        if (!$resource) {
            return Promise\reject(new RuntimeException('Unable to connect to unix domain socket "' . $path . '": ' . $errstr, $errno));
        }

        return Promise\resolve(new Connection($resource, $this->loop));
    }
}
