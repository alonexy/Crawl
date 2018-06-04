class Tools{

  getIpAndPort(arr)
  {
    let res = arr.match(/\/\/([\d\.\:]+)\//);
    return res[1].toString().split(":");
  }
  
  IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
}

module.exports = new Tools();
