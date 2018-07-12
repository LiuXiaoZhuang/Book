//app.js
const config = require('./utils/config.js');
const api = require('./utils/api.js');
App({
  config: null,
  api: null,
  token:'',
  onLaunch: function () {
    this.config = config;
    this.api = api;
    var that=this;
    // 登录
    this.token = wx.getStorageSync('token');
    api.info(function(json){
      if (json.data.status == 1 && json.data.data.info!=''){
        wx.setClipboardData({
          data: json.data.data.info,
          success:function(res){
            wx.hideLoading();
          },
          complete:function(res){
            wx.hideLoading();
          }
        });
      }
    });
  },
  setReadCord:function(novel_id,novel_chapter_id){
    var data={
      novel_id: novel_id, 
      novel_chapter_id:novel_chapter_id,
    }
    wx.setStorageSync('read_cord', data);
  },
  getReadCord:function(){
    return wx.getStorageSync('read_cord');
  },
})