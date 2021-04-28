@extends('layouts.app')
@section('content')
<h3 class="page-title">Update Profile</h3>
	@if(session('success'))
		<div class="row">
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		</div>
	@endif
		<form method="post" action="{{ url('admin/updateprofile') }}">
		{{ csrf_field() }}
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 form-group">
						<label class="control-label">Name</label>
						<p class="help-block"></p>
						<input type="text" class="form-control" name="name" value="{{ $user->name }}">
						@if($errors->has('name'))
							<p class="help-block">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 form-group">
						<label class="control-label">Email</label>
						<input type="email" class="form-control" name="email" value="{{ $user->email }}">
						<p class="help-block"></p>
						@if($errors->has('email'))
							<p class="help-block">
								{{ $errors->first('email') }}
							</p>
						@endif
					</div>
				</div>				
			</div>
		</div>
		<button type="submit"
				class="btn btn-primary"
				style="margin-right: 15px;">
			Update
		</button>
		</form>
	<h3 class="page-title">@lang('quickadmin.qa_change_password')</h3>
		{!! Form::open(['method' => 'PATCH', 'route' => ['admin.auth.change_password']]) !!}
		<!-- If no success message in flash session show change password form  -->
		<div class="panel panel-default">
			<div class="panel-heading">
				@lang('quickadmin.qa_edit')
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 form-group">
						{!! Form::label('current_password', trans('quickadmin.qa_current_password'), ['class' => 'control-label']) !!}
						{!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('current_password'))
							<p class="help-block">
								{{ $errors->first('current_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 form-group">
						{!! Form::label('new_password', trans('quickadmin.qa_new_password'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('new_password'))
							<p class="help-block">
								{{ $errors->first('new_password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 form-group">
						{!! Form::label('new_password_confirmation', trans('quickadmin.qa_password_confirm'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('new_password_confirmation'))
							<p class="help-block">
								{{ $errors->first('new_password_confirmation') }}
							</p>
						@endif
					</div>
				</div>
			</div>
		</div>

		{!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
		{!! Form::close() !!}
@stop

