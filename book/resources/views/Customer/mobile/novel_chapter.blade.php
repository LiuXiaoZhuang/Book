<!DOCTYPE HTML>
<html>
	<head>
		<title>这是一个页面</title>
	</head>
	<body>
		<h2>小说章节详情（电脑页面）</h2>
		<div><h3>{{$data['name']}}</h3></div>
		<div style="padding: 0 20px;">
			{!! $data['content'] !!}
		</div>
		<a href="javascript:;" onclick="history.go(-1)">返回</a>
	</body>
</html>