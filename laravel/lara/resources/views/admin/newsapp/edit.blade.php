@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
{!!Form::model($newsapp,['route' => ['newsappUpdate',$newsapp->id],'files'=>true])!!}
<div class="row">

	<div class="col-md-12">						
		<div class="form-group">
			{!!Form::label('Name')!!}
			{!! Form::text('name',null,['class'=>'form-control'])!!}
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{!!Form::label('Broadcaster')!!}
			{!! Form::select('broadcaster_id', [""=>"Select"]+$broadcasters, null, array('class' => 'form-control')) !!}
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
@stop

