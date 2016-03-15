@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <div class="post">
        <h2 class="post-title">{{ $post->title }}</h2>
        <div class="post-content">
            <p>
                {!! $post->content !!}
            </p>
            <small>发布于 {{ $post->created_at }}</small>
        </div>
        @include('disqus.disqus')
    </div>
@endsection
