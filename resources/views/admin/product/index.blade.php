@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
    <h3 class="page-title">Products</h3>
    <p>
        <a href="{{ route('admin.product.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($products) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td field-key='product_code'>{{ $product->product_code }}</td>
                                <td field-key='name'>{{ $product->name }}</td>
                                <td field-key='parent'>{{ @$product->categories }}</td>
                                <td>@if($product->image)<img height="50" width="50" src="{{URL::to('/').'/'.Storage::disk('public')->url('images/'.$product->image)}}">@endif</td>
                                 <td>
                                    @if($product->deleted_at)
                                    <a href="{{ route('admin.product.restore',[$product->id]) }}" class="btn btn-xs btn-primary">Restore</a>
                                    @else
                                    <a href="{{ route('admin.product.show',[$product->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    <a href="{{ route('admin.product.edit',[$product->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.product.destroy', $product->id])) !!}
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