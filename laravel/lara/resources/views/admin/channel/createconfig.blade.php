@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Config for {{$channel->name}} </h3>
<form class="form-horizontal" role="form" method="POST" action="{{route('channelConfigStore',$channel->id)}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row-fluid">
	<h3>External Api</h3>	
	<div class="form-group col-md-12">
		<label>Categories</label>
			<input type="text" class="form-control" name="config[categories]" value="{{ old('config[categories]') }}">
	</div>

	<div class="form-group col-md-12">
		<label>Single Category News</label>
			<input type="text" class="form-control" name="config[category_news]" value="{{ old('config[category_news]') }}">
	</div>
	<div class="form-group col-md-12">
		<label>Single  News</label>
			<input type="text" class="form-control" name="config[single_news]" value="{{ old('config[single_news]') }}">
	</div>	<div class="form-group col-md-12">
		<label>Epg</label>
			<input type="text" class="form-control" name="config[epg]" value="{{ old('config[epg]') }}">
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
