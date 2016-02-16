@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <div class="blog">
        <h1>{{ $post->title }}</h1>
        <h5>发布于 {{ $post->created_at }},最后修改于 {{ $post->updated_at }}</h5>
        <hr>
        <p>{!! $post->content !!}</p>
        <hr>
        @include('duoshuo.duoshuo')
    </div>
@endsection
