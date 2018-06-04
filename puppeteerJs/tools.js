class Tools{

  getIpAndPort(arr)
  {
    let res = arr.match(/\/\/([\d\.\:]+)\//);
    return res[1].toString().split(":");
  }
}

module.exports = new Tools();
