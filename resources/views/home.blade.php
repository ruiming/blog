@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <ul>
        @foreach ($posts as $key => $post)
            <li class="post">
                <h2 class="post-title">
                    <a href="/post/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <div class="post-content">
                    <p>{!! $post->content !!}</p>
                </div>
                <div class="post-meta post-divide">
                    <span class="glyphicon glyphicon-tag">分类:{{ $post->archive }}</span>
                    <span class="glyphicon glyphicon-eye-open">阅读:{{ $post->read }} </span>
                    <span class="glyphicon glyphicon-comment">
                        <a href="//ruiming.me/post/{{ $post->id }}"></a>
                    </span>
                    <span class="glyphicon glyphicon-time">最近修改于{{$times[$key]}}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<script id="dsq-count-scr" src="https://ruiming.disqus.com/count.js" async></script>
@stop
