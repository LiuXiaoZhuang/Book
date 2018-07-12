<!DOCTYPE HTML>
<html>
	<head>
		<title>这是一个页面</title>
	</head>
	<body>
		<h2>小说类型（电脑页面）</h2>
		<div>
			@foreach($data as $v)
				<p>类型名称：<a href="/novel_list?novel_type_id={{$v['novel_type_id']}}">{{$v['name']}}</a></p>
			@endforeach
		</div>
	</body>
</html>