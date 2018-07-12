<!DOCTYPE html>
<html>
<head>
    <title>个人小时光-@yield('title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/init.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/common.css') }}">
    <script type="text/javascript" src="{{ asset('public/js/jq.js') }}"></script>
    <meta name="description" content="一个免费的小说网站,小说类型多，更新快，阅读过程不会有广告"/>

    @section('html_head')
        <!--这是放css，js，seo的东西-->
    @show
</head>
<body>
    <div class="main">
        <header class="nav_box">
            <nav class="menu">
                <div class="menu_item {{Request::path()=='/'?'active':''}}">
                    <a href="{{ url('/') }}">首页</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='1'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=1' }}">玄幻魔法</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='2'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=2' }}">武侠修真</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='3'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=3' }}">现代都市</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='4'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=4' }}">言情小说</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='5'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=5' }}">历史军事</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='6'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=6' }}">游戏竞技</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='7'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=7' }}">科幻灵异</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='8'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=8' }}">耽美同人</a>
                </div>
                <div class="menu_item {{Request::input('novel_type_id','')=='9'?'active':''}}">
                    <a href="{{ url('/novel_list').'?novel_type_id=9' }}">其他小说</a>
                </div>
            </nav>
        </header>
        <div class="main_content">
            <div class="page">
                @section('content')
                    <!--这里是内容-->
                @show
            </div>
        </div>
        <footer class="footer">
            <div class="firend_link">
                <div class="link_box">
                    <p>友情链接：</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)" target="blank">　　</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="power">
                <div class="power_box">
                    <a href="http://www.miit.gov.cn/">　　</a>
                </div>
            </div>
        </footer>
    </div>
</body>
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?72aff52c97b9a2028bad8c7b74e3e7e9";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
@section('script')
    <!--这里是脚本-->
@show
</html>