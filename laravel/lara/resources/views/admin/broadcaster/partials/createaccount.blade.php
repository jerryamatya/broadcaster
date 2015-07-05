@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Account for {{$broadcaster->company_name}} </h3>
<form class="form-horizontal" role="form" method="POST" action="{{route('broadcasterAccountStore',$broadcaster->id)}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row-fluid">

	<div class="form-group col-md-12">
		<label>Name</label>
			<input type="text" class="form-control" name="name" value="{{ old('name') }}">
	</div>

	<div class="form-group col-md-12">
		<label>E-Mail Address</label>
			<input type="email" class="form-control" name="email" value="{{ old('email') }}">
	</div>

	<div class="form-group col-md-12">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>

	<div class="form-group col-md-12">
		<label>Confirm Password</label>
			<input type="password" class="form-control" name="password_confirmation">
	</div>

	<div class="col-md-12">
		<div class="form-group">
			{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
			{!!Form::reset('Reset',['class'=>'btn btn-default'])!!}							
		</div>
	</div>	
	</div>
</form>
@stop
