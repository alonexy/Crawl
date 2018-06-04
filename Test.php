<?php
##  https://chromedevtools.github.io/devtools-protocol/1-2/Runtime#type-ScriptId
## http://127.0.0.1:59538/json/new?http://www.alonexy.com
## http://127.0.0.1:59538/json/close/{pageid}
require_once __DIR__ . '/vendor/autoload.php';
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
use Clue\React\Redis\Factory;
use Clue\React\Redis\Client;
use Workerman\Email;
date_default_timezone_set('PRC');
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$logPath =  __DIR__.'/Logs/init.log';
$worker = new Worker();
$worker->count = 1;

$worker->onWorkerStart = function($worker){
    //连接Redis
    global $factory;
    global $RedisClient;
    $loop    = Worker::getEventLoop();
    $factory = new Factory($loop);
    $factory->createClient(getenv('REDIS_URL'))->then(function (Client $client){
        global $RedisClient;
        $RedisClient = $client;
    },function (Exception $e) {
        echo "RedisErr:";
        var_dump($e->getMessage());
        echo "\n";
    });
    $con = new AsyncTcpConnection("ws://127.0.0.1:54742/devtools/page/AA70E6D36386C7BE5EEB0FBA8026051B");
    //环境区分 正式 1 模拟 0
    $con->ServerENV = 0;
    $con->onConnect = function($con) {
        $con->send('{"id":4, "method": "Runtime.enable"}');
        $data = [];
        $data['id'] = 10;
        $data['method'] = "Runtime.evaluate";
        $data['params'] = [
            "expression"=>'console.log($("body"))'
        ];
        echo json_encode($data);
        echo "======";
        $con->send(json_encode($data));
    };
    // 远程websocket服务器发来消息时
    $con->onMessage = function($connection, $data){

        $arr = json_decode($data,1);
        if(isset($arr['id']) && $arr['id']== 10000){

        }else{
            echo "Return===>:\n";
            print_r($arr);
            echo "<===:\n";
        }
//        global $RedisClient;
//        $RedisClient->lpush(getenv('RELA_ORDER_PUSH_REDIS_TEST_KEY'), $data);
    };
    // 连接上发生错误时，一般是连接远程websocket服务器失败错误
    $con->onError = function($connection, $code, $msg){
        echo "error: $msg\n";
    };
    // 当连接远程websocket服务器的连接断开时
    $con->onClose = function($connection){
        echo "谷歌调试test 断开\n";

    };
    $con->connect();
//    // 每2.5秒执行一次
//    $time_interval = 2.5;
//    \Workerman\Lib\Timer::add($time_interval, function()use($con)
//    {
//        global $RedisClient;
//        $RedisClient->ping();
//        $con->send('{"id":10000, "method": "Runtime.evaluate", "params": {"expression":"console.log(\'==heart==\')"}}');
//    });
};
Worker::$stdoutFile = $logPath;
Worker::runAll();
