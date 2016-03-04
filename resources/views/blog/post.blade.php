@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <div class="blog">
        <h1>{{ $post->title }}</h1>
        <h5>发布于 {{ $post->created_at }}</h5>
        <hr>
        <p>{!! $post->content !!}</p>
        <hr>
        @include('disqus.disqus')
    </div>
@endsection
