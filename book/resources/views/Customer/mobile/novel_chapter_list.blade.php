<!DOCTYPE HTML>
<html>
	<head>
		<title>这是一个页面</title>
	</head>
	<body>
		<h2>小说章节列表（电脑页面）</h2>
		<div>
			@foreach($data as $v)
				<p>章节名称：<a href="/novel_chapter?novel_chapter_id={{$v['id']}}">{{$v['name']}}</a></p>
			@endforeach
		</div>
		<a href="javascript:;" onclick="history.go(-1)">返回</a>
	</body>
</html>