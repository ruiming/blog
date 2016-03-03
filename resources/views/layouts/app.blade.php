<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Ruiming's blog</title>
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/simplemde.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.js"></script>
    <script src="{{ URL::asset('js/simplemde.min.js') }}"></script>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="glyphicon glyphicon-dashboard"></span>Ruiming's blog
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::guest())
                    <li><a href="{{ url('/admin') }}"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                    @else
                    <li><a href="{{ url('/admin') }}"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                    <li><a href="{{ url('/admin/post') }}"><span class="glyphicon glyphicon-file"></span>Post</a></li>
                    <li><a href="{{ url('/admin/archive') }}"><span class="glyphicon glyphicon-tags"></span>Archive</a></li>
                    <li><a href="{{ url('/admin/upload') }}"><span class="glyphicon glyphicon-upload"></span>Upload</a></li>
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
