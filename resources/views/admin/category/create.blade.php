@extends('layouts.app')
@section('content')
    <h3 class="page-title">Category</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.category.store']]) !!}
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
                    {!! Form::label('parent_category_id', 'Parent Category*', ['class' => 'control-label']) !!}
                    {!! Form::select('parent_category_id', $categories, old('parent_category_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('parent_category_id'))
                        <p class="help-block">
                            {{ $errors->first('parent_category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_code', 'Category Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('category_code', Str::getNextAutoNumber('Category'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_code'))
                        <p class="help-block">
                            {{ $errors->first('category_code') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

