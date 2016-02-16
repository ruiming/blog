@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 newestPost">
            <h3><span class="glyphicon glyphicon-tasks"></span>最近文章</h3>
            <ul>
                @foreach ($posts as $key => $post)
                    <li class="post">
                        <h2 class="post-title">
                            <a href="/post/{{ $post->id }}">{{ $post->title }}</a>
                        </h2>
                        <div class="post-content">
                            <p>
                                {!! $post->content !!}
                            </p>
                        </div>
                        <div class="post-meta post-divide">
                            <span class="glyphicon glyphicon-tag">{{ $post->archive }}</span>
                            <span class="glyphicon glyphicon-eye-open">{{ $post->read }} </span>
                            <span class="glyphicon glyphicon-comment ds-thread-count"  data-thread-key="{{$post->id}}" data-count-type="comments"></span>
                            <span class="glyphicon glyphicon-time">最近修改于{{$times[$key]}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h3><span class="glyphicon glyphicon-stats"></span>最新评论</h3>
            <div class="newComment">
                @include('duoshuo.newComment')
            </div>
        </div>
    </div>
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
