@extends('layouts.app')
@section('content')
    <h3 class="page-title">Product</h3>
    {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.product.update', $product->id],'files' => true]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_ids', 'Categories*', ['class' => 'control-label']) !!}
                    {!! Form::select('category_ids[]', $categories, $category_ids, ['class' => 'form-control select2', 'required' => '', 'multiple' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_ids'))
                        <p class="help-block">
                            {{ $errors->first('category_ids') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {{ Form::label('image', 'Select Image', ['class' => 'control-label']) }}
                    <input type="file" onchange="readURL(this);" id="image" name="image">
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                    @if($product->image)
                        <img id="preview" height="50" width="50" src="{{URL::to('/').'/'.Storage::disk('public')->url('images/'.$product->image)}}" alt=" "/>
                        <a href="javascript:void(0);" onclick="removeMedia('{{$product->id}}')" id="removebtn">
                            <img height="20" width="20" src="{{ asset('adminlte/img/delete.png') }}" alt="Delete">
                        </a>
                    @else
                        <img id="preview" height="50" width="50" src="#" alt=" " />
                    @endif
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_code', 'Product Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('product_code', $product->product_code ? $product->product_code : Str::getNextAutoNumber('Product'), ['class' => 'form-control', 'placeholder' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_code'))
                        <p class="help-block">
                            {{ $errors->first('product_code') }}
                        </p>
                    @endif
                </div>
            </div> -->
        </div>
    </div>
    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

<script type="text/javascript">
    function removeMedia(id) {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{url('admin/product/removemedia')}}",
            type : "POST",
            data : {id:id},
            success : function(response) {
                $('#removebtn').remove();
                $('#preview').attr('src','');
                $("#image").val('');
            },
            error : function() {
            }
        });
    }
</script>
@stop

