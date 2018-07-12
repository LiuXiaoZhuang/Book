// pages/novel/novel.js
const app = getApp();
const config = app.config;
const api = app.api;

Page({

  /**
   * 页面的初始数据
   */
  data: {
    show_dir:true,
    dirAnimation: {
      flag:false,
      animation:{},
    },
    novel_id:'',
    name:'',
    author:'',
    cover_img: 'http://pbjbi2zxc.bkt.clouddn.com/novel_default.jpg',
    introduce: '',
    update_time:0,
    is_collection:2,
    chapter_list:[],
    novel_chapter_id:0,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (options.novel_id){
      wx.showLoading({
        title: '加载中...',
        mask: true,
      });
      var that=this;
      api.novelDetail(options.novel_id,0,function(json){
        wx.hideLoading();
        that.setData({
          novel_id:json.data.data.novel_id,
          name:json.data.data.name,
          author:json.data.data.author,
          cover_img:json.data.data.cover_img,
          introduce:json.data.data.introduce,
          update_time:json.data.data.update_time,
          is_collection:json.data.data.is_collection,
          chapter_list:json.data.data.chapter_list,
          novel_chapter_id: json.data.data.novel_chapter_id,
        });
      });
    }
    var animation = wx.createAnimation({
      duration: 400,
      timingFunction: 'ease-out',
    });
    this.animation = animation;
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
  
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  },
  backHome:function(){
    wx.switchTab({
      url: '/pages/index/index'
    });
  },
  show_dir:function(){
    var ctrl = this.data.dirAnimation;
    if (!ctrl.flag) {
      this.animation.left('0rpx').step();
    } else {
      this.animation.left('-600rpx').step();
    }
    ctrl = {
      flag: !ctrl.flag,
      animation: this.animation.export()
    }
    if (!ctrl.flag) {
      this.setDirAnimation(ctrl);
      setTimeout(this.changeShowDir,400);
    }else{
      this.setData({
        show_dir: !this.data.show_dir
      });
      var that=this;
      setTimeout(function(){
        that.setDirAnimation(ctrl)
      }, 50);
    }
  },
  changeShowDir:function(){
    this.setData({
      show_dir: !this.data.show_dir
    });
  },
  setDirAnimation:function(ctrl){
    this.setData({
      dirAnimation: ctrl
    })
  },
  //
  addBook:function(){
    var that=this;
    api.addBook(this.data.novel_id,function(json){
      that.setData({
        is_collection:1
      });
    });
  },
  delBook:function(){
    var that = this;
    api.delBook(this.data.novel_id, function (json) {
      that.setData({
        is_collection: 2,
        novel_chapter_id:0,
      });
    });
  },
  toRead:function(){
    var novel_chapter_id = this.data.chapter_list[0].novel_chapter_id;
    if (this.data.novel_chapter_id!=0){
      novel_chapter_id = this.data.novel_chapter_id
    }
    wx.navigateTo({
      url: '/pages/chapter/chapter?novel_id=' + this.data.novel_id + '&novel_chapter_id=' + novel_chapter_id
    })
  },
})