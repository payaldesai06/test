@extends('layouts.app')
@section('content')
    <h3 class="page-title">Product</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.product.store'],'files' => true]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
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
                    {!! Form::select('category_ids[]', $categories, old('category_ids'), ['class' => 'form-control select2', 'required' => '', 'multiple' => '']) !!}
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
                    <input type="file" onchange="readURL(this);" name="image">
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                    <img id="preview" height="50" width="50" src="#" alt=" " />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product_code', 'Product Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('product_code', Str::getNextAutoNumber('Product'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product_code'))
                        <p class="help-block">
                            {{ $errors->first('product_code') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

