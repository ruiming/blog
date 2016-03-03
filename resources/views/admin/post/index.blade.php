@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <h3>Posts <small>» Listing</small></h3>
            </div>
            <div class="col-xs-6 text-right">
                <a href="/admin/post/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> New Post
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
                        <th>Published</th>
                        <th>Title</th>
                        <th class="hidden-xs">Archive</th>
                        <th data-sortable="false" style="min-width:135px !important;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td data-order="{{ $post->created_at->timestamp }}">
                                {{ $post->created_at->format('Y-n-j') }}
                            </td>
                            <td>{{ $post->title }}</td>
                            <td class="hidden-xs">{{ $post->archive }}</td>
                            <td>
                                <a href="/admin/post/{{ $post->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="/post/{{ $post->id }}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-eye"></i> View
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
