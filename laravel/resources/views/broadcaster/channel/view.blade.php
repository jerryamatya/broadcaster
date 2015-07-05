@extends('broadcaster.partials.master')
@section('content')
@include('broadcaster.partials.error')
<table class="table">
	<tr>
		<th>Name</th>
		<td>{{$channel->name}}</td>
	</tr>
	<tr>
		<th>Broadcaster</th>
		<td>{{$channel->broadcaster->display_name}}</td>
	</tr>
	<tr>
		<th>Local Source</th>
		<td>{{$channel->local_source}}</td>
	</tr>
	<tr>
		<th>CDN Source</th>
		<td>{{$channel->cdn_source}}</td>
	</tr>
	<tr>
		<th>Logo</th>
		<td><img src="{{asset($cbs_options['channelLogoPath'].$channel->logo)}}" /></td>
	</tr>
		<tr>
		<th>Details</th>
		<td>{{$channel->details}}</td>
	</tr>
		<tr>
		<th>Country</th>
		<td>{{$channel->country->name}}</td>
	</tr>
		<tr>
		<th>Language</th>
		<td>{{$channel->language}}</td>
	</tr>
</table>
@stop
	
