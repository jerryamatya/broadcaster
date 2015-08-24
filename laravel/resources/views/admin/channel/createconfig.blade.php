@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Config for {{$channel->name}} </h3>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#ext_api" role="tab" data-toggle="tab">External Api</a></li>
	<li role="presentation"><a href="#notifications" role="tab" data-toggle="tab">Notifications</a></li>
</ul>
<div class="tab-content">
	<form class="form-horizontal tab-pane active" role="form" method="POST" action="{{route('channelConfigStore',$channel->id)}}" id="ext_api"> 
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
			</div>
			<div class="form-group col-md-12">
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
{!!Form::open(['route' => ['notificationsConfigStore',$channel->id,'notifications'],'id'=>'notifications',"class"=>"tab-pane"])!!}
<div class="row-fluid">
	<div class="col-md-12">
		<div class="row-fluid parseappkeys">
			<div class="col-md-4">
				<div class="form-group">
					{!!Form::label('Parse App Id')!!}
					{!! Form::text('config[parse_keys][appId]',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!!Form::label('Parse Client Id')!!}
					{!! Form::text('config[parse_keys][clientId]',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!!Form::label('Parse Rest Id')!!}
					{!! Form::text('config[parse_keys][restId]',null,['class'=>'form-control'])!!}
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
			{!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
		</div>
	</div>              

</div>        
</form>
</div>

@stop
