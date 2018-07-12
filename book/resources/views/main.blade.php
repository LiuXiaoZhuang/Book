<!DOCTYPE html>
<html>
<head>
    <title>Element copy Admui</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/init.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/ele-my.css')}}">
    <style type="text/css">
        @font-face{
            font-family:element-icons;
            src:url({{ asset('public/fonts/element-icons.woff')}}) format("woff"),
                url({{ asset('public/fonts/element-icons.ttf')}}) format("truetype");
            font-weight:400;
            font-style:normal;
        }
    </style>
</head>
<body>
    <div id="app"></div>
</body>
<script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
</html>