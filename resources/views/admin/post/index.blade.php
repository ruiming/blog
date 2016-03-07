@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <h3>文章 <small>» 列表</small></h3>
            </div>
            <div class="col-xs-6 text-right">
                <a href="/admin/post/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新文章
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="posts-table" class="table-my table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="hidden-xs">发布时间</th>
                        <th>标题</th>
                        <th class="hidden-xs">分类</th>
                        <th data-sortable="false" style="min-width:125px !important;">管理</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="hidden-xs" data-order="{{ $post->created_at->timestamp }}">
                                {{ $post->created_at->format('Y-n-j') }}
                            </td>
                            <td>{{ $post->title }}</td>
                            <td class="hidden-xs">{{ $post->archive }}</td>
                            <td>
                                <a href="/admin/post/{{ $post->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="/post/{{ $post->id }}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-eye"></i> 查看
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
