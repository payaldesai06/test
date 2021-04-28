@extends('layouts.app')
@section('content')
    <h3 class="page-title">Product</h3>
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
                            <td field-key='name'>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Categories</th>
                            <td field-key='name'>{{ @$product->categories }}</td>
                        </tr>
                        <tr>
                            <th>Product Code</th>
                            <td field-key='name'>{{ $product->product_code }}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>@if($product->image)<img height="50" width="50" src="{{URL::to('/').'/'.Storage::disk('public')->url('images/'.$product->image)}}">@endif</td>
                        </tr>
                    </table>
                </div>
            </div>
            <p>&nbsp;</p>
            <a href="{{ route('admin.product.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


