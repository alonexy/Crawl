const puppeteer = require('puppeteer')

var net = require('net')
var request = require('request')
var HOST = '127.0.0.1'
var PORT = 6969
var browserWSEndpoint = null
var Tools = require('./tools.js')

const { errors } = require('puppeteer')
var WS_IP = null
var WS_PORT = null

puppeteer
  .launch({
    headless: false,
    devtools: true,
    ignoreHTTPSErrors: true,
    args: [
      '--no-sandbox',
      '--disable-infobars',
      '--disable-dev-shm-usage', // <-- add this one
      // '--proxy-server=socks5://xxx.com:1443'
      // '--disable-gpu',
      // '--disable-dev-shm-usage',
      '--disable-setuid-sandbox',
      // '--no-first-run',
      '--no-zygote',
      '--deterministic-fetch',
      '--disable-features=IsolateOrigins',
      '--disable-site-isolation-trials',
      '–autoplay-policy=no-user-gesture-required',
      '--window-size=1920,1080',
      // '--window-position=1921,0',
    ],
  })
  .then(async (browser) => {
    browserWSEndpoint = browser.wsEndpoint()
    let resp = Tools.getIpAndPort(browserWSEndpoint)
    WS_IP = resp[0]
    WS_PORT = resp[1]
    console.log(WS_IP, WS_PORT)
    const context = browser.defaultBrowserContext()
    // const context = browser.createIncognitoBrowserContext()

    const page = await context.newPage()
    await page.evaluateOnNewDocument(() => {
      Object.defineProperty(navigator, 'plugins', {
        get: () => [
          {
            0: {
              type: 'application/x-google-chrome-pdf',
              suffixes: 'pdf',
              description: 'Portable Document Format',
              enabledPlugin: Plugin,
            },
            description: 'Portable Document Format',
            filename: 'internal-pdf-viewer',
            length: 1,
            name: 'Chrome PDF Plugin',
          },
          {
            0: {
              type: 'application/pdf',
              suffixes: 'pdf',
              description: '',
              enabledPlugin: Plugin,
            },
            description: '',
            filename: 'mhjfbmdgcfjbbpaeojofohoefgiehjai',
            length: 1,
            name: 'Chrome PDF Viewer',
          },
          {
            0: {
              type: 'application/x-nacl',
              suffixes: '',
              description: 'Native Client Executable',
              enabledPlugin: Plugin,
            },
            1: {
              type: 'application/x-pnacl',
              suffixes: '',
              description: 'Portable Native Client Executable',
              enabledPlugin: Plugin,
            },
            description: '',
            filename: 'internal-nacl-plugin',
            length: 2,
            name: 'Native Client',
          },
        ],
      })
    })
    await page._client.send('Page.setDownloadBehavior', {
      behavior: 'allow',
      downloadPath: './',
    })

    await page
      .goto('https://www.youtube.com/watch?v=_iz7cNRoL70', { timeout: 30000 })
      .then(async (res) => {
        if (res.ok()) {
          await page.waitForSelector('.ytp-fullscreen-button.ytp-button')

          await page
            .evaluate(async () => {
              let lists = document.getElementsByTagName(
                'ytd-grid-video-renderer'
              )
              console.log('------>>>>>', lists)
              ;(function () {
                var _sourceBufferList = []
                let $downloadNum = document.createElement('div')
                // 十倍速播放
                function _tenRatePlay() {
                  let $domList = document.getElementsByTagName('video')
                  for (let i = 0, length = $domList.length; i < length; i++) {
                    const $dom = $domList[i]
                    $dom.playbackRate = 10
                  }
                }
                // 下载资源
                function _download() {
                  console.log(_sourceBufferList)
                  _sourceBufferList.forEach((target) => {
                    const mime = target.mime.split(';')[0]
                    const type = mime.split('/')[1]
                    const fileBlob = new Blob(target.bufferList, { type: mime }) // 创建一个Blob对象，并设置文件的 MIME 类型
                    const a = document.createElement('a')
                    a.download = `${document.title}-${target.mime}.${type}`
                    a.href = URL.createObjectURL(fileBlob)
                    a.style.display = 'none'
                    document.body.appendChild(a)
                    a.click()
                    a.remove()
                  })
                }
                // 监听资源全部录取成功
                let _endOfStream = window.MediaSource.prototype.endOfStream
                window.MediaSource.prototype.endOfStream = function () {
                  console.log('资源全部捕获成功，即将下载！')
                  _download()
                  _endOfStream.call(this)
                }

                // 录取资源
                let _addSourceBuffer =
                  window.MediaSource.prototype.addSourceBuffer
                window.MediaSource.prototype.addSourceBuffer = function (mime) {
                  console.log(mime)
                  let sourceBuffer = _addSourceBuffer.call(this, mime)
                  let _append = sourceBuffer.appendBuffer
                  let bufferList = []
                  _sourceBufferList.push({
                    mime,
                    bufferList,
                  })
                  sourceBuffer.appendBuffer = function (buffer) {
                    $downloadNum.innerHTML = `已捕获 ${_sourceBufferList[0].bufferList.length} 个片段`
                    bufferList.push(buffer)
                    _append.call(this, buffer)
                  }
                  return sourceBuffer
                }

                // 添加操作的 dom
                function _appendDom() {
                  const baseStyle = `
                        position: fixed;
                        top: 50px;
                        right: 50px;
                        height: 40px;
                        padding: 0 20px;
                        z-index: 9999;
                        color: white;
                        cursor: pointer;
                        font-size: 16px;
                        font-weight: bold;
                        line-height: 40px;
                        text-align: center;
                        border-radius: 4px;
                        background-color: #3498db;
                        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.3);
                        `

                  $downloadNum.innerHTML = '等待'
                  $downloadNum.style = baseStyle
                  document
                    .getElementsByTagName('html')[0]
                    .insertBefore(
                      $downloadNum,
                      document.getElementsByTagName('head')[0]
                    )
                }
                _appendDom()
                setTimeout(function () {
                  _tenRatePlay()
                }, 3000)
              })()
            })
            .catch(async (errors) => {
              console.log(errors.toString())
            })
          await page.evaluate(() => {
            document.querySelector('.ytp-fullscreen-button.ytp-button').click()
          })
        }
      })
      .catch(async (e) => {
        console.log('page Err ====>>', e.toString())
        page.close()
      })
  })
  .catch(async (err) => {
    console.log('Error : ====>>', err)
  })
