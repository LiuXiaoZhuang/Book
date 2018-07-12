@extends('Customer.layouts.pc.common')

@section('title', '首页')

@section('html_head')
    <meta name="keywords" content="个人小时光,小说,免费小说,玄幻魔法,武侠修真,现代都市,言情小说,历史军事,游戏竞技,科幻灵异,耽美同人,其他小说"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/home.css') }}">
@endsection

@section('content')
    <div class="carousel_box">
        <ul class="carousel">
            @foreach ($data['carousel'] as $carousel)
                <li><img src="{{$carousel['img'].'?imageView2/0/w/1200/h/450'}}"></li>
            @endforeach
        </ul>
        <ul class="carousel_index"></ul>
        <div class="carousel_prev"><img src="{{ asset('public/images/left1.png') }}"></div>
        <div class="carousel_next"><img src="{{ asset('public/images/right1.png') }}"></div>
    </div>
    @foreach ($data['novel_block'] as $novel_block)
    <div class="novel_block">
        <p class="title">{{$novel_block['name']}}</p>
        <div class="novel_list">
            @foreach ($novel_block['novel_list'] as $novel)
            <div class="novel">
                <a href="{{ url('/novel_detail').'?novel_id='.$novel['novel_id'] }}" class="novel_cover">
                    <img src="{{$novel['cover_img'].'?imageView2/0/w/102/h/136'}}">
                </a>
                <div class="novel_info">
                    <p class="novel_name"><a href="{{ url('/novel_detail').'?novel_id='.$novel['novel_id'] }}">{{$novel['name']}}</a></p>
                    <p class="novel_author">{{$novel['author']}}</p>
                    <p class="novel_introduce">{{$novel['introduce']}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
@endsection


@section('script')
    <script type="text/javascript" src="{{ asset('public/js/slider.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".carousel_box").carousel({
                carousel : ".carousel",//轮播图容器
                indexContainer : ".carousel_index",//下标容器
                prev : ".carousel_prev",//左按钮
                next : ".carousel_next",//右按钮
                timing : 3000,//自动播放间隔
                animateTime : 700,//动画时间
                autoPlay : true,//是否自动播放 true/false
                direction : "left",//滚动方向 right/left
            });

            $(".carousel_box").hover(function(){
                $(".carousel_prev,.carousel_next").fadeIn(300);
            },function(){
                $(".carousel_prev,.carousel_next").fadeOut(300);
            });

            $(".carousel_prev").hover(function(){
                $(this).find("img").attr("src","{{ asset('public/images/left2.png') }}");
            },function(){
                $(this).find("img").attr("src","{{ asset('public/images/left1.png') }}");
            });
            $(".carousel_next").hover(function(){
                $(this).find("img").attr("src","{{ asset('public/images/right1.png') }}");
            },function(){
                $(this).find("img").attr("src","{{ asset('public/images/right2.png') }}");
            });
        });
    </script>
@endsection