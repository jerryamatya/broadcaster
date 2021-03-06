@extends('broadcaster.partials.master')
@section('content')
@include('admin.partials.error')
<?php $cod = unserialize($vod->cod); ?>
{!!Form::model($vod,array('route' => ['bvodUpdate',$vod->id],'files'=>true))!!}
<div class="form-group">
  {!!Form::label('Channel Id')!!}
  {!! Form::text('cod[channel_id]',$cod['channel_id'],['class'=>'form-control'])!!}
</div>
<div class="form-group">
  {!!Form::label('Featured Playlist')!!}
  {!! Form::text('cod[feat_playlist]',$cod['feat_playlist'],['class'=>'form-control'])!!}
</div>
<div class="form-group">
  {!!Form::label('Videos Count')!!}
  <div class="clearfix"></div>
  <div class="col-md-4">
    <label for="">Latest</label>
    {!! Form::text('cod[count][latest]',$cod['count']['latest'],['class'=>'form-control','placeholder'=>'Latest'])!!}
  </div>
  <div class="col-md-4">
    <label for="">Featured</label>
    {!! Form::text('cod[count][featured]',$cod['count']['featured'],['class'=>'form-control','placeholder'=>'Featured'])!!}
  </div>
  <div class="col-md-4">
    <label for="">Popular</label>

    {!! Form::text('cod[count][popular]',$cod['count']['popular'],['class'=>'form-control','placeholder'=>'Popular'])!!}
  </div>                    
<div class="clearfix"></div>
</div>    
{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
{!!Form::reset('Clear',['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
@stop
