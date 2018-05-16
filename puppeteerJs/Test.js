const puppeteer = require('puppeteer');
var {timeout} = require('./tools.js');
var program = require('commander');
var fs = require("fs")
var chalk = require('chalk');
console.log(chalk.green('app is start ...'));
program.version('0.1.0')
  .option('-f, --flag', 'cli')
  .option('-u, --url [value]', '输入要打开的url http://www.baidu.com')
  .option('-c, --callback [value]', 'websocket回调的 地址:端口','wss://127.0.0.1:4431')
  .parse(process.argv);
  if (typeof program.url === 'undefined') {
     console.error('URL is required !!!');
     process.exit(1);
  }

let Opts = {
    program:program,
    jsonify:function(obj){
        var seen = [];
        var json = JSON.stringify(obj, function(key, value){
            if (typeof value === 'object') {
                if ( !seen.indexOf(value) ) {
                    return '__cycle__' + (typeof value) + '[' + key + ']';
                }
                seen.push(value);
            }
            return value;
        }, 4);
        return json;
    },
    logs(msg,warn=0){
          if(warn == 1){
            console.log(chalk.red(this.jsonify(msg)))
          }else{
            console.log(chalk.green(this.jsonify(msg)))
          }
        }
}
//cli
if(program.flag){
  console.log(chalk.green('==== CLI运行模式 ===='))
}else{
  console.log(chalk.green('==== 默认运行模式 ===='))
}
Opts.logs('+++++++ StartTime : '+new Date().getTime()+'+++++++',1);

puppeteer.launch({
  headless: false,
  devtools:true
}).then(async browser => {
  const browserWSEndpoint = browser.wsEndpoint();
  Opts.logs(browserWSEndpoint);
  const page = await browser.newPage();
  var url = Opts.program.url;
  await page.goto(url, {timeout: 3000}).then( () => {
      Opts.logs('===跳转成功并且资源正确加载完毕.===');
  }, () => {
      Opts.logs('===跳转成功, 资源加载超时.===');
  });
  let title = await page.title();
  Opts.logs("网站标题==>"+title)
  function logRequest(interceptedRequest) {
    if(interceptedRequest.method() == 'POST'){
      console.log('Request ==> : ',interceptedRequest.method() ,interceptedRequest.postData(),interceptedRequest.url(),interceptedRequest.headers(),"\n");
    }else{
      console.log('Request ==> : ',interceptedRequest.method() ,interceptedRequest.url(),interceptedRequest.headers(),"\n");
      }
  }
  page.on('console', msg => {
    for (let i = 0; i < msg.args().length; ++i){
      let conns = "Log ==> ["+new Date().getTime()+"] -> : "+msg.args()[i]+"\n";
      fs.writeFile('app.log', conns,function(err){
          if(err){
            console.log('Err:: ',JSON.stringify(err))
          }
      })
    }
  });
  page.on('request', logRequest);
  await page.on('load', function(){
    console.log('==== 页面加载完成 ===='+new Date().getTime())
  });
  await page.evaluate( async (options)=> {
      console.log(options)
      // var ws = new WebSocket("wss://127.0.0.1:4431");
      // ws.onopen = function(e){
      //     console.log("连接SUC:",e);
      // }
      // ws.onmessage = function(e) {
      //     console.log("收到服务端的消息:",e);
      //     eval(e.data);
      //     // var scripts = document.createElement('script');
      //     // scripts.setAttribute('type', 'text/javascript');
      //     // scripts.setAttribute('src', 'https://www.tbjapi.com/v5/js/jquery-3.1.1.min.js');
      //     // document.getElementsByTagName('body')[0].appendChild(scripts);
      // }
  },Opts);





},Opts);
