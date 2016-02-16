@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Posts <small>» Edit New Post</small></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.post.update', $id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    @include('admin.post._form')
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-8 edit_action">
                                <button type="submit" class="btn btn-success btn-lg" name="action" value="finished">
                                    <i class="fa fa-floppy-o"></i>
                                    保存
                                </button>
                                <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-times-circle"></i>
                                    删除
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>

        {{-- 确认删除 --}}
        <div class="modal fade" id="modal-delete" tabIndex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">Please Confirm</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            Are you sure you want to delete this post?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.post.destroy', $id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop