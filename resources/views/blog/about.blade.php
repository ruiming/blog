@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <div class="post">
        <div class="post-content">
            <p>
                {!! $post->content !!}
            </p>
        </div>
    </div>
@endsection
