# Crawl

workman + chromedevtools


## https://chromedevtools.github.io/devtools-protocol/1-2/


##  浏览器操作
```
    browserWSEndpoint
    ws://127.0.0.1:54742/devtools/browser/3f1149cb-0ec5-4ee3-9503-a3398cb8d07e

    http://127.0.0.1:54742/json ## 概览 json展示

    http://127.0.0.1:54742/json/new?http://www.alonexy.com ## 新开网页

```
## 新开网页 返回实例
```
{
    description: "",
    devtoolsFrontendUrl: "/devtools/inspector.html?ws=127.0.0.1:54742/devtools/page/AA70E6D36386C7BE5EEB0FBA8026051B",
    id: "AA70E6D36386C7BE5EEB0FBA8026051B",
    title: "",
    type: "page",
    url: "http://www.alonexy.com/",
    webSocketDebuggerUrl: "ws://127.0.0.1:54742/devtools/page/AA70E6D36386C7BE5EEB0FBA8026051B"
}
```

## 页面通讯 使用连接 webSocketDebuggerUrl

```
ws://127.0.0.1:54742/devtools/page/AA70E6D36386C7BE5EEB0FBA8026051B

```