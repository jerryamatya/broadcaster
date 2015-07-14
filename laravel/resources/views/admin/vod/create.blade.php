@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
    {!!Form::open(array('route' => 'vodStore','files'=>true))!!}
              <div class="form-group">
          {!!Form::label('Broadcaster')!!}
          {!! Form::select('broadcaster_id', [""=>"Select"]+$broadcasters, null, array('class' => 'form-control')) !!}
        </div>
  <div class="form-group">
          {!!Form::label('Channel Id')!!}
          {!! Form::text('cod[channel_id]',null,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
          {!!Form::label('Featured Playlist')!!}
          {!! Form::text('cod[feat_playlist]',null,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
          {!!Form::label('Videos Count')!!}
          {!! Form::text('cod[count][playlist]',null,['class'=>'form-control','placeholder'=>'Playlist'])!!}
          {!! Form::text('cod[count][latest]',null,['class'=>'form-control','placeholder'=>'Latest'])!!}
          {!! Form::text('cod[count][featured]',null,['class'=>'form-control','placeholder'=>'Featured'])!!}
          {!! Form::text('cod[count][popular]',null,['class'=>'form-control','placeholder'=>'Popular'])!!}
  </div>       
    {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!!Form::reset('Clear',['class'=>'btn btn-default'])!!}
    {!!Form::close()!!}
@stop
