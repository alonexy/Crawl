const puppeteer = require('puppeteer');

puppeteer.launch().then(async browser => {
  // Store the endpoint to be able to reconnect to Chromium
  const browserWSEndpoint = 'ws://127.0.0.1:57624/devtools/browser/8b907b7c-406a-4229-9185-6930c017b620';
  console.log(browserWSEndpoint)

  const browser2 = await puppeteer.connect({browserWSEndpoint});
  var page = browser2.targets()
  console.log(page)
  // await page.evaluate( async (options)=> {
  //     console.log(111)
      // var ws = new WebSocket("ws://127.0.0.1:57624/devtools/browser/8b907b7c-406a-4229-9185-6930c017b620");
      // ws.onopen = function(e){
      //     console.log("连接SUC:",e);
      //     ws.send('sss')
      // }
      // ws.onmessage = function(e) {
      //     console.log("收到服务端的消息:",e);
      // }
  // });
  // Close Chromium
  // await browser2.close();
});
