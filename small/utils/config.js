var _token = '';
module.exports = {
  appName: "个人小时光",
  domain: "https://book.laihuiying.top",
  api: {
    login: "/api/login",//登录
    novelTypeList:'/api/novel_type_list',//小说类型
    novelList:'/api/novel_list',//小说列表
    novelDetail:'/api/novel_detail',//小说详情
    novelChapter:'/api/novel_chapter',//小说章节
    home:'/api/home',//首页
    bookshelf:'/api/bookshelf',//我的书架
    addBook:'/api/add_book',//加入书架
    delBook:'/api/del_book',//移出书架
    setTop: '/api/set_top',//置顶设置
    info: '/api/info',//信息
  },
  setToken: function (token) {
    wx.setStorage({
      key: "token",
      data: token
    });
    _token = token;
  },
  getToken: function () {
    return _token;
  },
};