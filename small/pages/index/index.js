//获取应用实例
const app = getApp();
const config = app.config;
const api = app.api;

Page({
  data: {
    banner:null,
    carousel:[],
    novel_block:[],
    show_read:false,
    read_cord:null,
    read_cord_box_style:'',
  },
  
  onLoad: function () {
    var that = this;
    wx.showLoading({
      title: '加载中...',
      mask:true,
    });
    api.home(function (json) {
      wx.hideLoading();
      var banner = json.data.data.banner;
      if (banner instanceof Array) {
        banner = null;
      }
      var read_cord_box_style='';
      if (banner!=null){
        read_cord_box_style='height:550rpx';
      }
      that.setData({
        banner: banner,
        carousel: json.data.data.carousel,
        novel_block: json.data.data.novel_block,
        read_cord_box_style: read_cord_box_style,
      });
      //上次读的
      var read_cord = app.getReadCord();
      if (read_cord){
        //存在这个东西，就进行一个展示啦
        that.setData({
          show_read:true,
          read_cord: read_cord,
        });
      }
    });
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },
  showSearchPage:function(){
    //页面跳转
    wx.navigateTo({
      url: '/pages/search/search'
    })
  },
  novelDetail: function (e) {
    //页面跳转
    wx.navigateTo({
      url: '/pages/novel/novel?novel_id=' + e.currentTarget.dataset.id
    });
  },
  cancelRead:function(){
    this.setData({
      show_read:false,
    });
  },
  readNow:function(){
    this.setData({
      show_read: false,
    });
    //跳转到那个章节
    wx.navigateTo({
      url: '/pages/chapter/chapter?novel_id=' + this.data.read_cord.novel_id + '&novel_chapter_id=' + this.data.read_cord.novel_chapter_id
    })
  }
})
