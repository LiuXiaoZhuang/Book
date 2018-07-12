// pages/chapter/chapter.js
const app = getApp();
const config = app.config;
const api = app.api;

Page({
  /**
   * 页面的初始数据
   */
  data: {
    show_ctrl:false,
    bg_mode:1,//模式 1 白天，2 夜间
    mode_style:[
      {
        nav_bar_color: '#ffffff',//标题栏字体颜色
        nav_bar_bgcolor: '#3e3e3e',//标题栏背景颜色
        content_bgcolor: 'background:#262626;',//小说内容背景
        title_color: 'color:#808080;',//小说标题颜色
        content_color: 'color: #808080;',////小说内容颜色
        ctrl_box_style: 'background: #333333;color: #808080;',//控制器样式
        slider_bgcolor: '#474747',//控制器滑动条背景
        slider_color: '#808080',//控制器滑动条颜色和滑块颜色
        dir_novel_info_style: "background: #262626;color: #7b7b7b;",//小说目录，小说信息样式
        dir_novel_title_color: "color: #7b7b7b;",//小说目录，小说标题颜色
        dir_novel_author_color: "color: #7b7b7b;",//小说目录，小说作者颜色
        dir_novel_dir_style: "border-color: #4c4c4c;background: #3e3e3e;color: #808080;",//小说目录内容样式
        dir_novel_border_color:"border-color: #4c4c4c;",//边框颜色,
        selected_novel_dir_color:'color: #eb424d;',//目录被选中的颜色
      },
      {
        nav_bar_color: '#000000',
        nav_bar_bgcolor: '#FFFFFF',
        content_bgcolor: 'background:#f3f3f3;',
        title_color: 'color:#404040;',
        content_color: 'color: #3d3d3d;',
        ctrl_box_style: 'background: #FFFFFF;color: #42454d;',
        slider_bgcolor: '#e8e8e8',
        slider_color: '#3b3f48',
        dir_novel_info_style: "background: #f2f2f2;color: #3b3f47;",//小说目录，小说信息样式
        dir_novel_title_color: "color: #3b3f47;",//小说目录，小说标题颜色
        dir_novel_author_color: "color: #3b3e45;",//小说目录，小说作者颜色
        dir_novel_dir_style: "border-color: #EEEEEE;background: #FFFFFF;color: #000000;",//小说目录内容样式
        dir_novel_border_color: "border-color: #EEEEEE;",//边框颜色
        selected_novel_dir_color: 'color: #ea424e;',//目录被选中的颜色
      }
    ],
    show_dir: true,
    dirAnimation: {
      flag:false,
      animation:{},
    },
    font_settings:{
      f_28:"font-size:28rpx;line-height:40rpx;",
      f_30:"font-size:30rpx;line-height:50rpx;",
      f_32:"font-size:32rpx;line-height:60rpx;",
      f_34:"font-size:34rpx;line-height:60rpx;",
      f_36:"font-size:36rpx;line-height:60rpx;",
      f_38:"font-size:38rpx;line-height:70rpx;",
      f_40:"font-size:40rpx;line-height:75rpx;",
    },
    font_size:34,
    show_font_setting:true,

    novel_id: '',
    name: '',
    author: '',
    cover_img: 'http://pbjbi2zxc.bkt.clouddn.com/novel_default.jpg',
    introduce: '',
    update_time: 0,
    is_collection: 2,
    chapter_list: [],
    novel_chapter:{
      name:'',
      content: [],
    },
    content_scroll:0,
    scroll_id:'',
    read_novel_process:1,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (options.novel_id && options.novel_chapter_id){
      var that=this;
      wx.showLoading({
        title: '加载中...',
        mask: true
      });
      api.novelDetail(options.novel_id, options.novel_chapter_id, function (json) {
        that.setData({
          novel_id: json.data.data.novel_id,
          name: json.data.data.name,
          author: json.data.data.author,
          cover_img: json.data.data.cover_img,
          introduce: json.data.data.introduce,
          update_time: json.data.data.update_time,
          is_collection: json.data.data.is_collection,
          chapter_list: json.data.data.chapter_list,
          novel_chapter: json.data.data.novel_chapter,
        });
        wx.hideLoading();
        that.setTitle(json.data.data.novel_chapter.name);
        app.setReadCord(options.novel_id, options.novel_chapter_id);
        that.setReadProcess();
      });
    }
    this.setStyle(this.data.bg_mode);
    var animation = wx.createAnimation({
      duration: 400,
      timingFunction: 'ease-out',
    });
    this.animation = animation;
  },
  setStyle:function(mode){
    wx.setNavigationBarColor({
      frontColor: this.data.mode_style[mode].nav_bar_color,
      backgroundColor: this.data.mode_style[mode].nav_bar_bgcolor,
    });
  },
  setTitle:function(title){
    wx.setNavigationBarTitle({
      title: title
    })
  },

  setScrollID:function(){
    this.setData({
      scroll_id: 'c_' + this.data.novel_chapter.novel_chapter_id
    });
  },

  setReadProcess:function(){
    var chapter_list = this.data.chapter_list;
    for (var i = 0; i < chapter_list.length;i++){
      if (this.data.novel_chapter.novel_chapter_id == chapter_list[i].novel_chapter_id){
        this.setData({
          read_novel_process: i+1,
        });
        break;
      }
    }
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
  changeBg:function(){
    var bg_mode = this.data.bg_mode == 1 ? 0 : 1
    this.setStyle(bg_mode);
    this.setData({
      bg_mode: bg_mode
    })
  },
  show_ctrl_box:function(){
    this.setData({
      show_ctrl: true
    });
  },
  close_ctrl_box:function() {
    this.setData({
      show_ctrl: false
    });
  },
  scroll_move:function(){
    this.close_font_setting_box();
    this.close_ctrl_box();
  },
  show_dir_box: function () {
    this.setScrollID();
    this.close_ctrl_box();
    var that=this;
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
      setTimeout(this.changeShowDir, 400);
    } else {
      this.setData({
        show_dir: !this.data.show_dir
      });
      setTimeout(function(){
        that.setDirAnimation(ctrl)
      }, 50);
    }
  },
  changeShowDir: function () {
    this.setData({
      show_dir: !this.data.show_dir
    });
  },
  setDirAnimation: function (ctrl) {
    this.setData({
      dirAnimation: ctrl
    })
  },
  novelDetail: function () {
    //页面跳转
    wx.redirectTo({
      url: '/pages/novel/novel?novel_id=' + this.data.novel_id
    });
  },
  show_font_setting_box:function(){
    this.setData({
      show_font_setting:false
    });
  },
  close_font_setting_box: function () {
    this.setData({
      show_font_setting: true
    });
  },
  changeFontSize:function(e){
    if (e.detail.value!=this.data.font_size){
      this.setData({
        font_size: e.detail.value
      });
    }
  },
  getChapter: function (novel_chapter_id){
    var that=this;
    wx.showLoading({
      title: '加载中...',
      mask: true
    });
    that.setData({
      content_scroll: 0
    });
    api.novelChapter(novel_chapter_id,function(json){
      that.setData({
        novel_chapter: json.data.data
      });
      that.setTitle(json.data.data.name);
      wx.hideLoading();
      app.setReadCord(that.data.novel_id, novel_chapter_id);
    });
  },
  preChapter:function(){
    //上一章
    var chapter_list = this.data.chapter_list;
    var novel_chapter_id=0;
    for (var i = 0; i < chapter_list.length; i++){
      if (chapter_list[i].novel_chapter_id == this.data.novel_chapter.novel_chapter_id){
        if(i!=0){
          novel_chapter_id = chapter_list[i-1].novel_chapter_id;
          break;
        }
      }
    }
    if(novel_chapter_id!=0){
      this.getChapter(novel_chapter_id);
      this.setData({
        read_novel_process: this.data.read_novel_process - 1
      });
    }
  },
  nextChapter: function () {
    //下一章
    var chapter_list = this.data.chapter_list;
    var novel_chapter_id = 0;
    for (var i = 0; i < chapter_list.length; i++) {
      if (chapter_list[i].novel_chapter_id == this.data.novel_chapter.novel_chapter_id) {
        if (i != (chapter_list.length-1)) {
          novel_chapter_id = chapter_list[i + 1].novel_chapter_id;
          break;
        }
      }
    }
    if (novel_chapter_id != 0) {
      this.getChapter(novel_chapter_id);
      this.setData({
        read_novel_process: this.data.read_novel_process+1
      });
    }
  },
  toChapter:function(e){
    var novel_chapter_id = e.currentTarget.dataset.novel_chapter_id;
    if (novel_chapter_id != this.data.novel_chapter.novel_chapter_id){
      this.getChapter(novel_chapter_id);
      this.setReadProcess();
    }
  }
})