<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{config('blog.title')}}</title>
    <link href="{{ URL::asset('css/style.css?v=2') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="header-description">
        <img src="{{URL::asset('img/gravatar.jpg') }}">
        <div class="navbar navbar-my">
            <a href="/">主页</a>
            <a href="/archive">归档</a>
        </div>
    </div>
    @section('main')
        @yield('content')
</div>
</body>
</html>