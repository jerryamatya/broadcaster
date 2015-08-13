@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
{!!Form::open(['route' => 'channelStore','files'=>true])!!}
<div class="row-fluid">

  <div class="col-md-6">
        <div class="form-group">
          {!!Form::label('Broadcaster')!!}
          {!! Form::select('id', [""=>"Select"]+$broadcasters->lists('display_name','id')->all(), null, array('class' => 'form-control','id'=>'broadcasterSelect')) !!}
        </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-12">
    <div class="row-fluid parseappkeys">
      <div class="col-md-4">
      <div class="form-group">
          {!!Form::label('Parse App Id')!!}
          {!! Form::text('config[keys][appId]',null,['class'=>'form-control'])!!}
        </div>
      </div>
      <div class="col-md-4">
              <div class="form-group">
          {!!Form::label('Parse Client Id')!!}
          {!! Form::text('config[keys][clientId]',null,['class'=>'form-control'])!!}
        </div>
      </div>
      <div class="col-md-4">
              <div class="form-group">
          {!!Form::label('Parse Rest Id')!!}
          {!! Form::text('config[keys][restId]',null,['class'=>'form-control'])!!}
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
</div>
</form>
@stop

