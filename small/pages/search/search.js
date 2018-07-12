// pages/search/search.js
const app = getApp();
const config = app.config;
const api = app.api;

Page({

  /**
   * 页面的初始数据
   */
  data: {
    box_flag:1,
    keyword:"",
    novel_list:[],
    condition:{},//当前条件
    total_page:0,
    novel_type_list:[],
    selected_style:"color:#FF0000;border: 1px solid #FF0000;",
    selected_novel_type:0,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that=this;
    wx.showLoading({
      title: '加载中...',
      mask: true
    });
    api.novelTypeList(function (json) {
      that.setData({
        novel_type_list:json.data.data,
      });
      wx.hideLoading();
    });
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
    if (this.data.condition.page && this.data.condition.page > this.data.total_page){
      return false;
    }
    this.search_novel();
  },
  search:function(){
    var keyword=this.data.keyword;
    var novel_type_id = this.data.selected_novel_type;
    if (keyword != '' || novel_type_id!=0){
      var condition={};
      if (keyword != ''){
        condition['keywords'] = keyword;
      }
      if (novel_type_id!=0){
        condition['novel_type_id'] = novel_type_id;
      }
      this.setData({
        box_flag:2,
        condition: condition,
        novel_list:[],
      });
      this.search_novel();
    }
  },
  setKeyword:function(e){
    var value = e.detail.value;
    if (value===''){
      this.setData({
        keyword: value,
        box_flag: 1
      });
    }else{
      this.setData({
        keyword: value
      });
    }
  },
  /**
   * 搜索小说
   */
  search_novel:function(){
    wx.showLoading({
      title: '加载中...',
      mask: true,
    });
    var that=this;
    var condition = that.data.condition;
    api.novelList(condition,function(json){
      var novel_list = that.data.novel_list;
      novel_list.push(json.data.data.data);
      var condition = that.data.condition;
      condition['page'] = json.data.data.current_page+1;
      that.setData({
        novel_list: novel_list,
        total_page: json.data.data.total_page,
        condition: condition
      });
      wx.hideLoading();
    });
  },
  novelDetail: function (e) {
    //页面跳转
    wx.navigateTo({
      url: '/pages/novel/novel?novel_id=' + e.currentTarget.dataset.novel_id
    });
  },
  novelType:function(e){
    var novel_type_id = e.currentTarget.dataset.novel_type_id;
    this.setData({
      selected_novel_type: novel_type_id,
    });
  }
})