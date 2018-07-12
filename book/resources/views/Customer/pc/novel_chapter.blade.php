@extends('Customer.layouts.pc.common')

@section('title', $data['name'])

@section('html_head')
    <meta name="keywords" content="个人小时光,小说,免费小说,{{$data['name']}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/novel_chapter.css') }}">
@endsection

@section('content')
    <div class="novel_chapter">
        <p class="title">{{$data['name']}}</p>
        <div class="chapter_list">
            @foreach ($data['content'] as $content)
                <p class="chapter">{{$content}}</p>
            @endforeach
            
        </div>
    </div>
    <div class="btn_box">
        @if($data['pre_chapter']==0)
            <a href="javascript:void(0)" class="no_chapter" title="没有了" >上一章</a>
        @else
            <a href="{{ url('/novel_chapter').'?novel_chapter_id='.$data['pre_chapter']}}" >上一章</a>
        @endif

        <a href="{{ url('/novel_detail').'?novel_id='.$data['novel_id']}}" class="dir">目录</a>

        @if($data['next_chapter']==0)
            <a href="javascript:void(0)"  class="no_chapter"  title="没有了">下一章</a>
        @else
            <a href="{{ url('/novel_chapter').'?novel_chapter_id='.$data['next_chapter']}}">下一章</a>
        @endif
        
    </div>
@endsection

@section('script')
@endsection