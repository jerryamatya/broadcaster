@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Config for {{$broadcaster->company_name}} </h3>
<form class="form-horizontal" role="form" method="POST" action="{{route('broadcasterConfigStore',$broadcaster->id)}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row-fluid">
	<h3>Add Code</h3>	
	<div class="form-group col-md-6">
		<label>Banner Add Code Id(android)</label>
			<input type="text" class="form-control" name="config[android]['addcode'][banneraddkey]" value="{{ old('config[android]['addcode'][banneraddkey]') }}">
	</div>

	<div class="form-group col-md-6">
		<label>Interestitial Add Code Id(android)</label>
			<input type="text" class="form-control" name="config[android]['addcode'][interestitialaddkey]" value="{{ old('config[android]['addcode'][interestitialaddkey]') }}">
	</div>
	<div class="form-group col-md-6">
		<label>Banner Add Code Id(ios)</label>
			<input type="text" class="form-control" name="config[ios]['addcode'][banneraddkey]" value="{{ old('config[ios]['addcode'][banneraddkey]') }}">
	</div>

	<div class="form-group col-md-6">
		<label>Interestitial Add Code Id(ios)</label>
			<input type="text" class="form-control" name="config[ios]['addcode'][interestitialaddkey]" value="{{ old('config[android]['addcode'][interestitialaddkey]') }}">
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
