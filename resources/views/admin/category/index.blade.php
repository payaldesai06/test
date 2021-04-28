@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    <h3 class="page-title">Categories</h3>
    <p>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($categories) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>Category Code</th>
                        <th>Name</th>
                        <th>Parent(if any)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                <td field-key='category_code'>{{ $category->category_code }}</td>
                                <td field-key='name'>{{ $category->name }}</td>
                                <td field-key='parent'>{{ @$category->parent->name }}</td>
                                 <td>
                                    @if($category->deleted_at)
                                    <a href="{{ route('admin.category.restore',[$category->id]) }}" class="btn btn-xs btn-primary">Restore</a>
                                    @else
                                    <a href="{{ route('admin.category.show',[$category->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    <a href="{{ route('admin.category.edit',[$category->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.category.destroy', $category->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop