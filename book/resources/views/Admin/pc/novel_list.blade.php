<!DOCTYPE HTML>
<html>
    <head>
        <title>这是一个页面</title>
    </head>
    <body>
        <h2>小说列表（电脑页面）</h2>
        <div>
            @foreach($data['data'] as $v)
                <div style="border: 1px solid #cecece;margin-bottom: 10px;padding:0 10px;">
                    <p>小说名称：{{$v['name']}}</p>
                    <p>作者：{{$v['author']}}</p>
                    <p>
                        @if($v['is_catch']==2)
                            <a href="/ccc?novel_id={{$v['id']}}">更新</a>
                        @else
                            已抓取
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
        <div>
            当前页:{{$data['current_page']}}
            <br>
            开始条:{{$data['from']}}
            <br>
            结束条:{{$data['to']}}
            <br>
            总页数:{{$data['total_page']}}
            <br>
            总数据数:{{$data['total_data']}}
            <br>
        </div>
        <a href="/novel_type_list">返回</a>
    </body>
</html>