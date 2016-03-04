@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6">
                <h3>分类 <small>» 列表</small></h3>
            </div>
            <div class="col-xs-6 text-right">
                <a href="/admin/archive/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新分类
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('admin.partials.errors')
                @include('admin.partials.success')
                <table id="archives-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>分类</th>
                        <th>文章数</th>
                        <th class="xs-hidden">Slug</th>
                        <th>创建日期</th>
                        <th>管理</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($archives as $archive)
                        <tr>
                            <td>{{ $archive->name }}</td>
                            <td>{{ $archive->counts }}</td>
                            <td class="xs-hidden">{{ $archive->slug }}</td>
                            <td>{{ $archive->created_at->format('Y-n-j') }}</td>
                            <td>
                                <a href="/admin/archive/{{ $archive->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
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