@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Config for {{$broadcaster->company_name}} </h3>
<form class="form-horizontal" role="form" method="POST" action="{{route('broadcasterConfigStore',$broadcaster->id)}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row-fluid">
	<h3>Add Code</h3>	
	<div class="form-group col-md-12">
		<label>Banner Add Code Id</label>
			<input type="text" class="form-control" name="config[banneraddkey]" value="{{ old('config[banneraddkey]') }}">
	</div>

	<div class="form-group col-md-12">
		<label>Interestitial Add Code Id</label>
			<input type="text" class="form-control" name="config[interestitialaddkey]" value="{{ old('config[interestitialaddkey]') }}">
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
