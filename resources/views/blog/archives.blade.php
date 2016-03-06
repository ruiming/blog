@extends('blog.layout')
@section('title', 'Page Title')
@section('content')
    <ul class="archive">
        <p><span class="glyphicon glyphicon-list-alt"></span>分类</p>
        @foreach ($categorys as $category)
            <li class="archive">
                <div class="archive-name">
                    <a href="/archive/{{ $category["slug"] }}">{{ $category["name"] }}</a>
                    <span class="badge ng-binding">{{ $category["counts"] }}</span>
                </div>
            </li>
        @endforeach
        <div class="clearfix fix"></div>
        <p><span class="glyphicon glyphicon-calendar"></span>时间</p>
        @foreach ($dates as $date)
            <li class="archive">
                <div class="archive-name">
                    <a href="/date/{{ substr($date,0,4) }}/{{ substr($date,4,2) }}">{{ TimetoDate($date) }}</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
