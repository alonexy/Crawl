
const puppeteer = require('puppeteer');
var net = require('net');
var request = require('request');
var HOST = '127.0.0.1';
var PORT = 6969;
var browserWSEndpoint = null;
var Tools = require("./tools.js")
var WS_IP = null;
var WS_PORT = null;

puppeteer.launch({
  headless: false,
  devtools:true
}).then(async browser => {
  // Store the endpoint to be able to reconnect to Chromium
  browserWSEndpoint = browser.wsEndpoint();
  let resp = Tools.getIpAndPort(browserWSEndpoint)
  WS_IP   = resp[0]
  WS_PORT = resp[1]
  console.log(WS_IP,WS_PORT)
});

// 创建一个TCP服务器实例，调用listen函数开始监听指定端口
// 传入net.createServer()的回调函数将作为”connection“事件的处理函数
// 在每一个“connection”事件中，该回调函数接收到的socket对象是唯一的
net.createServer(function(sock) {
  // 我们获得一个连接 - 该连接自动关联一个socket对象
  console.log('CONNECTED: ' + sock.remoteAddress + ':' + sock.remotePort);
  // 为这个socket实例添加一个"data"事件处理函数
  sock.on('data', function(data) {
    if(Tools.IsJsonString(data)){
        var DataObj = JSON.parse(data)
        console.log(DataObj)
        if(DataObj.type = 'get_list'){
          var url = 'http://'+WS_IP+':'+WS_PORT+'/json';
          request({
              url: url,
              method: "GET",
              json: true,
              headers: {
                  "content-type": "application/json",
              }
          }, function(error, response, body) {
              if (!error && response.statusCode == 200) {
                console.log(response,body,error)
              }
          });
        }
    }else{
      sock.write('data is not json!!');
    }

  });

  // 为这个socket实例添加一个"close"事件处理函数
  sock.on('close', function(data) {
    console.log('CLOSED: ' +
        sock.remoteAddress + ' ' + sock.remotePort);
  });

}).listen(PORT, HOST);

console.log('Server listening on ' + HOST +':'+ PORT);
