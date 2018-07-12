// pages/books/books.js
const app = getApp();
const config = app.config;
const api = app.api;

Page({

  /**
   * 页面的初始数据
   */
  data: {
    ctrlAnimation:{},
    books:[],
    banner:null,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var animation = wx.createAnimation({
      duration: 500,
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
    wx.showLoading({
      title: '加载中...',
      mask: true,
    });
    var that = this;
    api.bookshelf(function (json) {
      wx.hideLoading();
      var books=json.data.data.books;
      var animations={};
      for (var i = 0; i < books.length;i++){
        animations['n_' + books[i].novel_id] = {
          flag: true,
          animation: {}
        };
      }
      that.setData({
        books: json.data.data.books,
        banner: json.data.data.banner,
        ctrlAnimation: animations,
      });
    });
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
  showCtrl:function(e){
    var novel_id = e.currentTarget.dataset.novel_id;
    var key = 'n_' + novel_id;
    var ctrl=this.data.ctrlAnimation;
    if (ctrl[key].flag){
      this.animation.left('-320rpx').step()
    }else{
      this.animation.left('0rpx').step()
    }
    ctrl[key]={
      flag: !ctrl[key].flag,
      animation: this.animation.export()
    }
    for (var a in ctrl){
      if(a!=key){
        ctrl[a] = {
          flag: true,
          animation: this.animation.left('0rpx').step().export()
        }
      }
    }
    this.setData({
      ctrlAnimation: ctrl
    })
  },
  chapterDetail:function(e){
    var novel_id = e.currentTarget.dataset.novel_id;
    var novel_chapter_id = e.currentTarget.dataset.novel_chapter_id;
    //页面跳转
    wx.navigateTo({
      url: '/pages/chapter/chapter?novel_id=' + novel_id + '&novel_chapter_id=' + novel_chapter_id
    });
  },
  setTop:function(e){
    wx.showToast({
      title: '进来了',
      icon: 'success',
      duration: 1000
    })
    var bookshelf_id = e.currentTarget.dataset.bookshelf_id;
    var that=this;
    api.setTop(bookshelf_id,function(json){
      var books = that.data.books;
      for (var i = 0; i < books.length; i++) {
        if (bookshelf_id == books[i].bookshelf_id) {
          books[i].inner_page = books[i].inner_page==1?0:1;
        }
      }
      var ctrl = that.data.ctrlAnimation;
      for (var a in ctrl) {
          ctrl[a] = {
            flag: true,
            animation: that.animation.left('0rpx').step().export()
          }
      }
      that.setData({
        books: books,
        ctrlAnimation: ctrl
      });
    });
  },
  delBook: function (e) {
    var that = this;
    var novel_id = e.currentTarget.dataset.novel_id;
    api.delBook(novel_id, function (json) {
      var books = that.data.books;
      for (var i = 0; i < books.length;i++){
        if (novel_id == books[i].novel_id){
          //移出该元素
          books.splice(i,1);
          break;
        }
      }
      var ctrl = that.data.ctrlAnimation;
      for (var a in ctrl) {
        ctrl[a] = {
          flag: true,
          animation: that.animation.left('0rpx').step().export()
        }
      }
      that.setData({
        books: books,
        ctrlAnimation: ctrl
      });
    });
  }
})