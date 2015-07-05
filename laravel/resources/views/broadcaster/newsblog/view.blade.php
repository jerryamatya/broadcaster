@extends('broadcaster.partials.master')
@section('content')
@include('broadcaster.partials.error')
<table class="table">
	<tr>
		<th>Title</th>
		<td>{{$newsblog->title}}</td>
	</tr>
	<tr>
		<th>Slug</th>
		<td>{{$newsblog->slug}}</td>
	</tr>	
	<tr>
		<th>Body</th>
		<td>{{$newsblog->body}}</td>
	</tr>
	<tr>
		<th>Excerpt</th>
		<td>{{$newsblog->excerpt}}</td>
	</tr>
	<tr>
		<th>Image</th>
		<td><img src="{{asset($cbs_options['newsBlogPath'].$newsblog->img)}}" /></td>
	</tr>
</table>
@stop
	
