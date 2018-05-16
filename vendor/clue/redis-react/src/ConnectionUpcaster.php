<?php

namespace Clue\React\Redis;

use Evenement\EventEmitter;
use React\Socket\ConnectionInterface;
use React\Stream\DuplexStreamInterface;
use React\Stream\WritableStreamInterface;
use React\Stream\Util;

/**
 * Adapter to upcast a legacy SocketClient-Connector result to a new Socket-ConnectionInterface
 *
 * @internal
 */
class ConnectionUpcaster extends EventEmitter implements ConnectionInterface
{
    private $stream;

    public function __construct(DuplexStreamInterface $stream)
    {
        $this->stream = $stream;

        Util::forwardEvents($stream, $this, array('data', 'end', 'close', 'error', 'drain'));
        $this->stream->on('close', array($this, 'close'));
    }

    public function isReadable()
    {
        return $this->stream->isReadable();
    }

    public function isWritable()
    {
        return $this->isWritable();
    }

    public function pause()
    {
        $this->stream->pause();
    }

    public function resume()
    {
        $this->stream->resume();
    }

    public function pipe(WritableStreamInterface $dest, array $options = array())
    {
        $this->stream->pipe($dest, $options);
    }

    public function write($data)
    {
        return $this->stream->write($data);
    }

    public function end($data = null)
    {
        return $this->stream->end($data);
    }

    public function close()
    {
        $this->stream->close();
        $this->removeAllListeners();
    }

    public function getRemoteAddress()
    {
        return null;
    }

    public function getLocalAddress()
    {
        return null;
    }
}
