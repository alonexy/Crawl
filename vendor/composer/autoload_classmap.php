<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Channel\\Client' => $baseDir . '/Channel/Client.php',
    'Channel\\Server' => $baseDir . '/Channel/Server.php',
    'Clue\\React\\Redis\\Client' => $vendorDir . '/clue/redis-react/src/Client.php',
    'Clue\\React\\Redis\\ConnectionUpcaster' => $vendorDir . '/clue/redis-react/src/ConnectionUpcaster.php',
    'Clue\\React\\Redis\\ConnectorUpcaster' => $vendorDir . '/clue/redis-react/src/ConnectorUpcaster.php',
    'Clue\\React\\Redis\\Factory' => $vendorDir . '/clue/redis-react/src/Factory.php',
    'Clue\\React\\Redis\\StreamingClient' => $vendorDir . '/clue/redis-react/src/StreamingClient.php',
    'Clue\\Redis\\Protocol\\Factory' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Factory.php',
    'Clue\\Redis\\Protocol\\Model\\BulkReply' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/BulkReply.php',
    'Clue\\Redis\\Protocol\\Model\\ErrorReply' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/ErrorReply.php',
    'Clue\\Redis\\Protocol\\Model\\IntegerReply' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/IntegerReply.php',
    'Clue\\Redis\\Protocol\\Model\\ModelInterface' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/ModelInterface.php',
    'Clue\\Redis\\Protocol\\Model\\MultiBulkReply' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/MultiBulkReply.php',
    'Clue\\Redis\\Protocol\\Model\\Request' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/Request.php',
    'Clue\\Redis\\Protocol\\Model\\StatusReply' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Model/StatusReply.php',
    'Clue\\Redis\\Protocol\\Parser\\MessageBuffer' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Parser/MessageBuffer.php',
    'Clue\\Redis\\Protocol\\Parser\\ParserException' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Parser/ParserException.php',
    'Clue\\Redis\\Protocol\\Parser\\ParserInterface' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Parser/ParserInterface.php',
    'Clue\\Redis\\Protocol\\Parser\\RequestParser' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Parser/RequestParser.php',
    'Clue\\Redis\\Protocol\\Parser\\ResponseParser' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Parser/ResponseParser.php',
    'Clue\\Redis\\Protocol\\Serializer\\RecursiveSerializer' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Serializer/RecursiveSerializer.php',
    'Clue\\Redis\\Protocol\\Serializer\\SerializerInterface' => $vendorDir . '/clue/redis-protocol/src/Clue/Redis/Protocol/Serializer/SerializerInterface.php',
    'Dotenv\\Dotenv' => $vendorDir . '/vlucas/phpdotenv/src/Dotenv.php',
    'Dotenv\\Exception\\ExceptionInterface' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ExceptionInterface.php',
    'Dotenv\\Exception\\InvalidCallbackException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php',
    'Dotenv\\Exception\\InvalidFileException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidFileException.php',
    'Dotenv\\Exception\\InvalidPathException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidPathException.php',
    'Dotenv\\Exception\\ValidationException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ValidationException.php',
    'Dotenv\\Loader' => $vendorDir . '/vlucas/phpdotenv/src/Loader.php',
    'Dotenv\\Validator' => $vendorDir . '/vlucas/phpdotenv/src/Validator.php',
    'Evenement\\EventEmitter' => $vendorDir . '/evenement/evenement/src/Evenement/EventEmitter.php',
    'Evenement\\EventEmitterInterface' => $vendorDir . '/evenement/evenement/src/Evenement/EventEmitterInterface.php',
    'Evenement\\EventEmitterTrait' => $vendorDir . '/evenement/evenement/src/Evenement/EventEmitterTrait.php',
    'PHPMailer\\PHPMailer\\Exception' => $vendorDir . '/phpmailer/phpmailer/src/Exception.php',
    'PHPMailer\\PHPMailer\\OAuth' => $vendorDir . '/phpmailer/phpmailer/src/OAuth.php',
    'PHPMailer\\PHPMailer\\PHPMailer' => $vendorDir . '/phpmailer/phpmailer/src/PHPMailer.php',
    'PHPMailer\\PHPMailer\\POP3' => $vendorDir . '/phpmailer/phpmailer/src/POP3.php',
    'PHPMailer\\PHPMailer\\SMTP' => $vendorDir . '/phpmailer/phpmailer/src/SMTP.php',
    'React\\Cache\\ArrayCache' => $vendorDir . '/react/cache/src/ArrayCache.php',
    'React\\Cache\\CacheInterface' => $vendorDir . '/react/cache/src/CacheInterface.php',
    'React\\Dns\\BadServerException' => $vendorDir . '/react/dns/src/BadServerException.php',
    'React\\Dns\\Config\\Config' => $vendorDir . '/react/dns/src/Config/Config.php',
    'React\\Dns\\Config\\FilesystemFactory' => $vendorDir . '/react/dns/src/Config/FilesystemFactory.php',
    'React\\Dns\\Config\\HostsFile' => $vendorDir . '/react/dns/src/Config/HostsFile.php',
    'React\\Dns\\Model\\HeaderBag' => $vendorDir . '/react/dns/src/Model/HeaderBag.php',
    'React\\Dns\\Model\\Message' => $vendorDir . '/react/dns/src/Model/Message.php',
    'React\\Dns\\Model\\Record' => $vendorDir . '/react/dns/src/Model/Record.php',
    'React\\Dns\\Protocol\\BinaryDumper' => $vendorDir . '/react/dns/src/Protocol/BinaryDumper.php',
    'React\\Dns\\Protocol\\Parser' => $vendorDir . '/react/dns/src/Protocol/Parser.php',
    'React\\Dns\\Query\\CachedExecutor' => $vendorDir . '/react/dns/src/Query/CachedExecutor.php',
    'React\\Dns\\Query\\CancellationException' => $vendorDir . '/react/dns/src/Query/CancellationException.php',
    'React\\Dns\\Query\\Executor' => $vendorDir . '/react/dns/src/Query/Executor.php',
    'React\\Dns\\Query\\ExecutorInterface' => $vendorDir . '/react/dns/src/Query/ExecutorInterface.php',
    'React\\Dns\\Query\\HostsFileExecutor' => $vendorDir . '/react/dns/src/Query/HostsFileExecutor.php',
    'React\\Dns\\Query\\Query' => $vendorDir . '/react/dns/src/Query/Query.php',
    'React\\Dns\\Query\\RecordBag' => $vendorDir . '/react/dns/src/Query/RecordBag.php',
    'React\\Dns\\Query\\RecordCache' => $vendorDir . '/react/dns/src/Query/RecordCache.php',
    'React\\Dns\\Query\\RetryExecutor' => $vendorDir . '/react/dns/src/Query/RetryExecutor.php',
    'React\\Dns\\Query\\TimeoutException' => $vendorDir . '/react/dns/src/Query/TimeoutException.php',
    'React\\Dns\\Query\\TimeoutExecutor' => $vendorDir . '/react/dns/src/Query/TimeoutExecutor.php',
    'React\\Dns\\RecordNotFoundException' => $vendorDir . '/react/dns/src/RecordNotFoundException.php',
    'React\\Dns\\Resolver\\Factory' => $vendorDir . '/react/dns/src/Resolver/Factory.php',
    'React\\Dns\\Resolver\\Resolver' => $vendorDir . '/react/dns/src/Resolver/Resolver.php',
    'React\\EventLoop\\ExtEventLoop' => $vendorDir . '/react/event-loop/src/ExtEventLoop.php',
    'React\\EventLoop\\Factory' => $vendorDir . '/react/event-loop/src/Factory.php',
    'React\\EventLoop\\LibEvLoop' => $vendorDir . '/react/event-loop/src/LibEvLoop.php',
    'React\\EventLoop\\LibEventLoop' => $vendorDir . '/react/event-loop/src/LibEventLoop.php',
    'React\\EventLoop\\LoopInterface' => $vendorDir . '/react/event-loop/src/LoopInterface.php',
    'React\\EventLoop\\StreamSelectLoop' => $vendorDir . '/react/event-loop/src/StreamSelectLoop.php',
    'React\\EventLoop\\Tick\\FutureTickQueue' => $vendorDir . '/react/event-loop/src/Tick/FutureTickQueue.php',
    'React\\EventLoop\\Tick\\NextTickQueue' => $vendorDir . '/react/event-loop/src/Tick/NextTickQueue.php',
    'React\\EventLoop\\Timer\\Timer' => $vendorDir . '/react/event-loop/src/Timer/Timer.php',
    'React\\EventLoop\\Timer\\TimerInterface' => $vendorDir . '/react/event-loop/src/Timer/TimerInterface.php',
    'React\\EventLoop\\Timer\\Timers' => $vendorDir . '/react/event-loop/src/Timer/Timers.php',
    'React\\Promise\\CancellablePromiseInterface' => $vendorDir . '/react/promise/src/CancellablePromiseInterface.php',
    'React\\Promise\\CancellationQueue' => $vendorDir . '/react/promise/src/CancellationQueue.php',
    'React\\Promise\\Deferred' => $vendorDir . '/react/promise/src/Deferred.php',
    'React\\Promise\\Exception\\LengthException' => $vendorDir . '/react/promise/src/Exception/LengthException.php',
    'React\\Promise\\ExtendedPromiseInterface' => $vendorDir . '/react/promise/src/ExtendedPromiseInterface.php',
    'React\\Promise\\FulfilledPromise' => $vendorDir . '/react/promise/src/FulfilledPromise.php',
    'React\\Promise\\LazyPromise' => $vendorDir . '/react/promise/src/LazyPromise.php',
    'React\\Promise\\Promise' => $vendorDir . '/react/promise/src/Promise.php',
    'React\\Promise\\PromiseInterface' => $vendorDir . '/react/promise/src/PromiseInterface.php',
    'React\\Promise\\PromisorInterface' => $vendorDir . '/react/promise/src/PromisorInterface.php',
    'React\\Promise\\RejectedPromise' => $vendorDir . '/react/promise/src/RejectedPromise.php',
    'React\\Promise\\Timer\\TimeoutException' => $vendorDir . '/react/promise-timer/src/TimeoutException.php',
    'React\\Promise\\UnhandledRejectionException' => $vendorDir . '/react/promise/src/UnhandledRejectionException.php',
    'React\\SocketClient\\ConnectionInterface' => $vendorDir . '/react/socket-client/src/ConnectionInterface.php',
    'React\\SocketClient\\Connector' => $vendorDir . '/react/socket-client/src/Connector.php',
    'React\\SocketClient\\ConnectorInterface' => $vendorDir . '/react/socket-client/src/ConnectorInterface.php',
    'React\\SocketClient\\DnsConnector' => $vendorDir . '/react/socket-client/src/DnsConnector.php',
    'React\\SocketClient\\SecureConnector' => $vendorDir . '/react/socket-client/src/SecureConnector.php',
    'React\\SocketClient\\StreamConnection' => $vendorDir . '/react/socket-client/src/StreamConnection.php',
    'React\\SocketClient\\StreamEncryption' => $vendorDir . '/react/socket-client/src/StreamEncryption.php',
    'React\\SocketClient\\TcpConnector' => $vendorDir . '/react/socket-client/src/TcpConnector.php',
    'React\\SocketClient\\TimeoutConnector' => $vendorDir . '/react/socket-client/src/TimeoutConnector.php',
    'React\\SocketClient\\UnixConnector' => $vendorDir . '/react/socket-client/src/UnixConnector.php',
    'React\\Socket\\Connection' => $vendorDir . '/react/socket/src/Connection.php',
    'React\\Socket\\ConnectionInterface' => $vendorDir . '/react/socket/src/ConnectionInterface.php',
    'React\\Socket\\Connector' => $vendorDir . '/react/socket/src/Connector.php',
    'React\\Socket\\ConnectorInterface' => $vendorDir . '/react/socket/src/ConnectorInterface.php',
    'React\\Socket\\DnsConnector' => $vendorDir . '/react/socket/src/DnsConnector.php',
    'React\\Socket\\LimitingServer' => $vendorDir . '/react/socket/src/LimitingServer.php',
    'React\\Socket\\SecureConnector' => $vendorDir . '/react/socket/src/SecureConnector.php',
    'React\\Socket\\SecureServer' => $vendorDir . '/react/socket/src/SecureServer.php',
    'React\\Socket\\Server' => $vendorDir . '/react/socket/src/Server.php',
    'React\\Socket\\ServerInterface' => $vendorDir . '/react/socket/src/ServerInterface.php',
    'React\\Socket\\StreamEncryption' => $vendorDir . '/react/socket/src/StreamEncryption.php',
    'React\\Socket\\TcpConnector' => $vendorDir . '/react/socket/src/TcpConnector.php',
    'React\\Socket\\TimeoutConnector' => $vendorDir . '/react/socket/src/TimeoutConnector.php',
    'React\\Socket\\UnixConnector' => $vendorDir . '/react/socket/src/UnixConnector.php',
    'React\\Stream\\BufferedSink' => $vendorDir . '/react/stream/src/BufferedSink.php',
    'React\\Stream\\CompositeStream' => $vendorDir . '/react/stream/src/CompositeStream.php',
    'React\\Stream\\DuplexResourceStream' => $vendorDir . '/react/stream/src/DuplexResourceStream.php',
    'React\\Stream\\DuplexStreamInterface' => $vendorDir . '/react/stream/src/DuplexStreamInterface.php',
    'React\\Stream\\ReadableResourceStream' => $vendorDir . '/react/stream/src/ReadableResourceStream.php',
    'React\\Stream\\ReadableStream' => $vendorDir . '/react/stream/src/ReadableStream.php',
    'React\\Stream\\ReadableStreamInterface' => $vendorDir . '/react/stream/src/ReadableStreamInterface.php',
    'React\\Stream\\Stream' => $vendorDir . '/react/stream/src/Stream.php',
    'React\\Stream\\ThroughStream' => $vendorDir . '/react/stream/src/ThroughStream.php',
    'React\\Stream\\Util' => $vendorDir . '/react/stream/src/Util.php',
    'React\\Stream\\WritableResourceStream' => $vendorDir . '/react/stream/src/WritableResourceStream.php',
    'React\\Stream\\WritableStream' => $vendorDir . '/react/stream/src/WritableStream.php',
    'React\\Stream\\WritableStreamInterface' => $vendorDir . '/react/stream/src/WritableStreamInterface.php',
    'Workerman\\Autoloader' => $baseDir . '/Autoloader.php',
    'Workerman\\Connection\\AsyncTcpConnection' => $baseDir . '/Connection/AsyncTcpConnection.php',
    'Workerman\\Connection\\AsyncUdpConnection' => $baseDir . '/Connection/AsyncUdpConnection.php',
    'Workerman\\Connection\\ConnectionInterface' => $baseDir . '/Connection/ConnectionInterface.php',
    'Workerman\\Connection\\TcpConnection' => $baseDir . '/Connection/TcpConnection.php',
    'Workerman\\Connection\\UdpConnection' => $baseDir . '/Connection/UdpConnection.php',
    'Workerman\\Email' => $baseDir . '/Email.php',
    'Workerman\\Events\\Ev' => $baseDir . '/Events/Ev.php',
    'Workerman\\Events\\Event' => $baseDir . '/Events/Event.php',
    'Workerman\\Events\\EventInterface' => $baseDir . '/Events/EventInterface.php',
    'Workerman\\Events\\Libevent' => $baseDir . '/Events/Libevent.php',
    'Workerman\\Events\\React\\ExtEventLoop' => $baseDir . '/Events/React/ExtEventLoop.php',
    'Workerman\\Events\\React\\LibEventLoop' => $baseDir . '/Events/React/LibEventLoop.php',
    'Workerman\\Events\\React\\StreamSelectLoop' => $baseDir . '/Events/React/StreamSelectLoop.php',
    'Workerman\\Events\\Select' => $baseDir . '/Events/Select.php',
    'Workerman\\Events\\Swoole' => $baseDir . '/Events/Swoole.php',
    'Workerman\\Lib\\Timer' => $baseDir . '/Lib/Timer.php',
    'Workerman\\Protocols\\Frame' => $baseDir . '/Protocols/Frame.php',
    'Workerman\\Protocols\\Http' => $baseDir . '/Protocols/Http.php',
    'Workerman\\Protocols\\HttpCache' => $baseDir . '/Protocols/Http.php',
    'Workerman\\Protocols\\ProtocolInterface' => $baseDir . '/Protocols/ProtocolInterface.php',
    'Workerman\\Protocols\\Text' => $baseDir . '/Protocols/Text.php',
    'Workerman\\Protocols\\Websocket' => $baseDir . '/Protocols/Websocket.php',
    'Workerman\\Protocols\\Ws' => $baseDir . '/Protocols/Ws.php',
    'Workerman\\WebServer' => $baseDir . '/WebServer.php',
    'Workerman\\Worker' => $baseDir . '/Worker.php',
);
