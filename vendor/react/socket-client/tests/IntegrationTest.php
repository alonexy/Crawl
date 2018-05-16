<?php

namespace React\Tests\SocketClient;

use React\Dns\Resolver\Factory;
use React\EventLoop\StreamSelectLoop;
use React\SocketClient\Connector;
use React\SocketClient\SecureConnector;
use React\SocketClient\TcpConnector;
use React\Stream\BufferedSink;
use Clue\React\Block;
use React\SocketClient\DnsConnector;

class IntegrationTest extends TestCase
{
    const TIMEOUT = 5.0;

    /** @test */
    public function gettingStuffFromGoogleShouldWork()
    {
        $loop = new StreamSelectLoop();
        $connector = new Connector($loop);

        $conn = Block\await($connector->connect('google.com:80'), $loop);

        $this->assertContains(':80', $conn->getRemoteAddress());
        $this->assertNotEquals('google.com:80', $conn->getRemoteAddress());

        $conn->write("GET / HTTP/1.0\r\n\r\n");

        $response = Block\await(BufferedSink::createPromise($conn), $loop, self::TIMEOUT);

        $this->assertRegExp('#^HTTP/1\.0#', $response);
    }

    /** @test */
    public function gettingEncryptedStuffFromGoogleShouldWork()
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            $this->markTestSkipped('Not supported on your platform (outdated HHVM?)');
        }

        $loop = new StreamSelectLoop();
        $secureConnector = new Connector($loop);

        $conn = Block\await($secureConnector->connect('tls://google.com:443'), $loop);

        $conn->write("GET / HTTP/1.0\r\n\r\n");

        $response = Block\await(BufferedSink::createPromise($conn), $loop, self::TIMEOUT);

        $this->assertRegExp('#^HTTP/1\.0#', $response);
    }

    /** @test */
    public function gettingEncryptedStuffFromGoogleShouldWorkIfHostIsResolvedFirst()
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            $this->markTestSkipped('Not supported on your platform (outdated HHVM?)');
        }

        $loop = new StreamSelectLoop();

        $factory = new Factory();
        $dns = $factory->create('8.8.8.8', $loop);

        $connector = new DnsConnector(
            new SecureConnector(
                new TcpConnector($loop),
                $loop
            ),
            $dns
        );

        $conn = Block\await($connector->connect('google.com:443'), $loop);

        $conn->write("GET / HTTP/1.0\r\n\r\n");

        $response = Block\await(BufferedSink::createPromise($conn), $loop, self::TIMEOUT);

        $this->assertRegExp('#^HTTP/1\.0#', $response);
    }

    /** @test */
    public function testConnectingFailsIfDnsUsesInvalidResolver()
    {
        $loop = new StreamSelectLoop();

        $factory = new Factory();
        $dns = $factory->create('demo.invalid', $loop);

        $connector = new Connector($loop, array(
            'dns' => $dns
        ));

        $this->setExpectedException('RuntimeException');
        Block\await($connector->connect('google.com:80'), $loop, self::TIMEOUT);
    }

    /** @test */
    public function testConnectingFailsIfTimeoutIsTooSmall()
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            $this->markTestSkipped('Not supported on your platform (outdated HHVM?)');
        }

        $loop = new StreamSelectLoop();

        $connector = new Connector($loop, array(
            'timeout' => 0.001
        ));

        $this->setExpectedException('RuntimeException');
        Block\await($connector->connect('google.com:80'), $loop, self::TIMEOUT);
    }

    /** @test */
    public function testSelfSignedRejectsIfVerificationIsEnabled()
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            $this->markTestSkipped('Not supported on your platform (outdated HHVM?)');
        }

        $loop = new StreamSelectLoop();

        $connector = new Connector($loop, array(
            'tls' => array(
                'verify_peer' => true
            )
        ));

        $this->setExpectedException('RuntimeException');
        Block\await($connector->connect('tls://self-signed.badssl.com:443'), $loop, self::TIMEOUT);
    }

    /** @test */
    public function testSelfSignedResolvesIfVerificationIsDisabled()
    {
        if (!function_exists('stream_socket_enable_crypto')) {
            $this->markTestSkipped('Not supported on your platform (outdated HHVM?)');
        }

        $loop = new StreamSelectLoop();

        $connector = new Connector($loop, array(
            'tls' => array(
                'verify_peer' => false
            )
        ));

        $conn = Block\await($connector->connect('tls://self-signed.badssl.com:443'), $loop, self::TIMEOUT);
        $conn->close();
    }

    public function testCancelPendingConnection()
    {
        $loop = new StreamSelectLoop();

        $connector = new TcpConnector($loop);
        $pending = $connector->connect('8.8.8.8:80');

        $loop->addTimer(0.001, function () use ($pending) {
            $pending->cancel();
        });

        $pending->then($this->expectCallableNever(), $this->expectCallableOnce());

        $loop->run();
    }
}
