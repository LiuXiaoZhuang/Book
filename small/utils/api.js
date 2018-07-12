const config = require('./config.js');

const getUrl = function (uri) {
  return config.domain + uri;
}

const setData = function (data) {
  var token = config.getToken();
  if (token!=''){
    data.token = token
  }
  return data;
}

const request=function (url,data, func) {
  var _url=url;
  url = getUrl(url);
  data = setData(data);
  wx.request({
    url: url,
    method: "POST",
    data: data,
    success: function (res) {
      if(res.data.status==3){
        reLogin(_url, data, func);
      }else{
        if (typeof func == "function") {
          func(res);
        }
      }
    },
    fail:function(err){
      wx.hideLoading();
    }
  });
};

const reLogin=function(url,data,func){
  wx.login({
    success: function (res) {
      if (res.code) {
        api.login(res.code, function (json) {
          if (json.data.status == 1) {
            config.setToken(json.data.data.token);
            //再调用之前的方法
            request(url, data, func);
          }
        });
      }
    }
  });
}

const api={
  /**
   * 登录
   */
  login: function (code, func) {
    var data = {
      code: code
    };
    request(config.api.login, data, func);
  },

  /**
   * 首页
   */
  home: function (func) {
    request(config.api.home, {}, func);
  },

  /**
   * 小说详情
   */
  novelDetail: function (novel_id, novel_chapter_id, func) {
    var data = {
      novel_id: novel_id
    };
    if (novel_chapter_id != 0) {
      data.novel_chapter_id = novel_chapter_id;
    }
    request(config.api.novelDetail, data, func);
  },

  /**
   * 小说章节
   */
  novelChapter: function (novel_chapter_id, func) {
    var data = {
      novel_chapter_id: novel_chapter_id
    };
    request(config.api.novelChapter, data, func);
  },

  /**
   * 加入书架
   */
  addBook: function (novel_id, func) {
    var data = {
      novel_id: novel_id
    };
    request(config.api.addBook, data, func);
  },

  /**
   * 移出书架
   */
  delBook: function (novel_id, func) {
    var data = {
      novel_id: novel_id
    };
    request(config.api.delBook, data, func);
  },

  /**
   * 我的书架
   */
  bookshelf:function(func){
    request(config.api.bookshelf, {}, func);
  },

  /**
   * 置顶
   */
  setTop: function (bookshelf_id,func) {
    var data = {
      bookshelf_id: bookshelf_id
    };
    request(config.api.setTop, data, func);
  },

  /**
   * 小说列表（搜索）
   */
  novelList:function(data,func){
    request(config.api.novelList, data, func);
  },

  /**
   * 信息
   */
  info:function(func){
    request(config.api.info, {}, func);
  },

  /**
   * 类型
   */
  novelTypeList:function(func){
    request(config.api.novelTypeList, {}, func);
  }
}


module.exports = api