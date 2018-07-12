@extends('Customer.layouts.pc.common')

@section('title', '小说分类')

@section('html_head')
    <meta name="keywords" content="个人小时光,小说,免费小说,玄幻魔法,武侠修真,现代都市,言情小说,历史军事,游戏竞技,科幻灵异,耽美同人,其他小说"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/novel_list.css') }}">
@endsection

@section('content')
    <div class="novel_list">
        @foreach ($data['data'] as $novel)
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
    <div class="page_box" id="page_box">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('public/js/jquery.pagination.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#page_box").pagination({
                    currentPage: {{$data['current_page']}},
                    totalPage: {{$data['total_page']}},
                    callback: function(current){
                        window.location.href="{{ url('/novel_list').'?novel_type_id='.Request::input('novel_type_id') }}&page="+current;
                    }
                });
        });
    </script>
@endsection