@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <ul>
        @foreach ($posts as $post)
            <li class="post">
                <h2 class="post-title">
                    <a href="/post/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <div class="post-content">
                    <p>
                        {!! $post->content !!}
                    </p>
                </div>
                <div class="post-meta">
                    <span class="glyphicon glyphicon-tag">分类:{{ $post->archive }}</span>
                    <span class="glyphicon glyphicon-comment ds-thread-count"  data-thread-key="{{$post->id}}"
                          data-count-type="comments"></span>
                    <span class="glyphicon glyphicon-eye-open">阅读:{{ $post->read }} </span>
                    <span class="glyphicon glyphicon-time">时间:{{ $post->created_at->format('Y-n-j') }}</span>
                    <a class="btn-design btn btn-primary" href="/post/{{$post->id}}">阅读全文</a>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="page">
        {!! $posts->render() !!}
    </div>
    <!-- 多说js加载开始，一个页面只需要加载一次 -->
    <script type="text/javascript">
        var duoshuoQuery = {short_name:"ruiming"};
        (function() {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';ds.async = true;
            ds.src = 'https://static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>
    <!-- 多说js加载结束，一个页面只需要加载一次 -->
@endsection
