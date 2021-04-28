@extends('layouts.app')
@section('content')
    <h3 class="page-title">Category</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td field-key='name'>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Parent</th>
                            <td field-key='name'>{{ @$category->parent->name }}</td>
                        </tr>
                        <tr>
                            <th>Category Code</th>
                            <td field-key='name'>{{ $category->category_code }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <p>&nbsp;</p>
            <a href="{{ route('admin.category.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


