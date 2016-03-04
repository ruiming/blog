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
                    <span class="glyphicon glyphicon-comment disqus-comment-count"
                          data-disqus-url="https://ruiming.me/post/{{$post->id}}">
                    </span>
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
    <script id="dsq-count-scr" src="https://ruiming.disqus.com/count.js" async></script>
@endsection
