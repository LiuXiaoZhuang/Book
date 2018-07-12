<!DOCTYPE HTML>
<html>
	<head>
		<title>这是一个页面</title>
	</head>
	<body>
		<h2>小说列表（电脑页面）</h2>
		<div>
			@foreach($data['data'] as $v)
				<p>小说名称：<a href="/novel_chapter_list?noval_id={{$v['id']}}">{{$v['name']}}</a></p>
			@endforeach
		</div>
		<a href="/novel_type_list">返回</a>
	</body>
</html>