<?php

namespace React\SocketClient;

use React\EventLoop\LoopInterface;
use React\Stream\Stream;
use React\Promise;

final class SecureConnector implements ConnectorInterface
{
    private $connector;
    private $streamEncryption;
    private $context;

    public function __construct(ConnectorInterface $connector, LoopInterface $loop, array $context = array())
    {
        $this->connector = $connector;
        $this->streamEncryption = new StreamEncryption($loop);
        $this->context = $context;
    }

    public function connect($uri)
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            return Promise\reject(new \BadMethodCallException('Encryption not supported on your platform (HHVM < 3.8?)'));
        }

        if (strpos($uri, '://') === false) {
            $uri = 'tls://' . $uri;
        }

        $parts = parse_url($uri);
        if (!$parts || !isset($parts['scheme']) || $parts['scheme'] !== 'tls') {
            return Promise\reject(new \InvalidArgumentException('Given URI "' . $uri . '" is invalid'));
        }

        $uri = str_replace('tls://', '', $uri);
        $context = $this->context;

        $encryption = $this->streamEncryption;
        return $this->connector->connect($uri)->then(function (ConnectionInterface $connection) use ($context, $encryption) {
            // (unencrypted) TCP/IP connection succeeded

            if (!$connection instanceof Stream) {
                $connection->close();
                throw new \UnexpectedValueException('Connection MUST extend Stream in order to access underlying stream resource');
            }

            // set required SSL/TLS context options
            foreach ($context as $name => $value) {
                stream_context_set_option($connection->stream, 'ssl', $name, $value);
            }

            // try to enable encryption
            return $encryption->enable($connection)->then(null, function ($error) use ($connection) {
                // establishing encryption failed => close invalid connection and return error
                $connection->close();
                throw $error;
            });
        });
    }
}
