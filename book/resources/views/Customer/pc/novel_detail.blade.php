@extends('Customer.layouts.pc.common')

@section('title', $data['name'])

@section('html_head')
    <meta name="keywords" content="个人小时光,小说,免费小说,{{$data['name']}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/novel_detail.css') }}">
@endsection

@section('content')
    <div class="novel_box">
        <img src="{{$data['cover_img'].'?imageView2/0/w/150/h/200'}}" class="novel_cover">
        <div class="novel_info">
            <p class="novel_name">{{$data['name']}}</p>
            <p class="novel_author">{{$data['author']}}</p>
            <p class="novel_type">类型：{{$data['novel_type']}}</p>
            <p class="novel_status">状态：{{$data['is_complete']==1?'已完结':'连载中'}}</p>
            <p class="novel_last">最新：{{$data['chapter_list'][count($data['chapter_list'])-1]['name']}}</p>
        </div>
    </div>
    <div class="introduce_box">
        <p class="title">简介说明：</p>
        <p class="introduce">{{$data['introduce']}}</p>
    </div>
    <div class="novel_catalog">
        <p class="title">章节目录：</p>
        @foreach ($data['chapter_list'] as $chapter)
            <a href="{{ url('/novel_chapter').'?novel_chapter_id='.$chapter['novel_chapter_id'] }}">{{$chapter['name']}}</a>
        @endforeach
    </div>
@endsection

@section('script')
@endsection