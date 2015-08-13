@extends('broadcaster.partials.master')
@section('content')
@include('broadcaster.partials.error')
{!!Form::model($channel,['route' => ['bchannelUpdate',$channel->id],'files'=>true])!!}
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">						
				<div class="form-group">
					{!!Form::label('Name')!!}
					{!! Form::text('name',null,['class'=>'form-control'])!!}
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					{!!Form::label('Sources')!!}
					{!! Form::text('local_source',null,['class'=>'form-control','placeholder'=>'local url'])!!}
					{!! Form::text('cdn_source',null,['class'=>'form-control','placeholder'=>'cdn url'])!!}
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group"> 
					{!!Form::label('Details')!!}            

					{!!Form::textarea('details',null,['class'=>'form-control','rows'=>2])!!}
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row-fluid">
			<div class="col-md-12">
				<div class="form-group">
					{!!Form::label('Country')!!}
					{!! Form::select('country_id', [""=>"Select"]+$countries, null, array('class' => 'form-control chosen-select')) !!}
			</div>
							<div class="form-group">
					{!!Form::label('Language')!!}
					{!! Form::text('language',null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					<label>Logo</label>

					<input type="file" name="logo" class="">
					@if($channel->logo)
					<img style="max-width: 100%" src="{{asset($cbs_options['channelLogoPath'].$channel->logo)}}">
					@endif 
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
@stop

