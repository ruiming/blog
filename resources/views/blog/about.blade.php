@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <div class="post" style="margin-bottom: 20px;">
        <div class="post-content">
            <p>
                {!! $post->content !!}
            </p>
        </div>
    </div>
@endsection
