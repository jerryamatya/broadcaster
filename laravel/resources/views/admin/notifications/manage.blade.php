@extends('admin.partials.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
@stop
@section('content')
@include('admin.partials.error')
<div class="row">
  {!!Form::open(['route' => ['channelNotificationSave',$channel->id],'id'=>''])!!}
  <div class="col-md-12">
    <h3>Notification for {{$channel->name}}</h3>
    <div class="panel-group noti-body">
      <a href="#" class="addnoti"><span class="glyphicon glyphicon-plus"></span>new</a><br><br>
      @if($channel->notifications->count())
      <?php $i=0;?>
      @foreach($channel->notifications as $notification)
      <div class="panel panel-default single" data-index="{{$i}}">
      <input type="hidden" name="notifications[{{$i}}][id]" value="{{$notification->id}}">
        <a href="#" class="rm-noti"><span class="glyphicon glyphicon-remove">&nbsp;</span></a>
        <div class="panel-body">
          <div class="row-fluid">
            <div class="col-md-3">
              <label for="">Message</label>
              <textarea name="notifications[{{$i}}][msg]" id="" rows="1" class="form-control">{{$notification->msg}}</textarea>
            </div>
            <div class="col-md-3">
              <label for="">Time</label>
              <div class="clockpicker" data-autoclose="true">
                <input type="text" name="notifications[{{$i}}][time]" value="{{$notification->time}}" class="form-control">        
              </div>
            </div>
            <div class="col-md-3">
              <label for="">Type</label>
              <input type="text" name="notifications[{{$i}}][type]" value="{{$notification->type}}" class="form-control">  
            </div>
            <div class="col-md-3">
              <label for="">Data</label>
              <textarea name="notifications[{{$i}}][data]" rows="1" class="form-control">{{$notification->data}}</textarea>
            </div>
          </div>
        </div>
      </div>
      <?php $i++;?>
      @endforeach
      @endif
    </div>
  </div>
  <div class="col-md-12 submit">
    <div class="form-group">
      {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
      {!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
    </div>
  </div> 
  {!!Form::close()!!}
</div>
<!--clone section-->
<div class="hide">
  <div class="row-fluid notification_clone">
   <div class="panel panel-default single">
    <input type="hidden" class="id" value="0">
    <a href="#" class="rm-noti"><span class="glyphicon glyphicon-remove">&nbsp;</span></a>
    <div class="panel-body">
      <div class="row-fluid">
        <div class="col-md-3">
          <label for="">Message</label>
          <textarea id="" rows="1" class="msg form-control"></textarea>
        </div>
        <div class="col-md-3">
          <label for="">Time</label>
          <div class="clockpicker" data-autoclose="true">
            <input type="text" value="" class="time form-control">        
          </div>
        </div>
        <div class="col-md-3">
          <label for="">Type</label>
          <input type="text" value="" class="type form-control">  
        </div>
        <div class="col-md-3">
          <label for="">Data</label>
          <textarea rows="1" class="data form-control"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
</div> <!--End clone--> 
@stop
@section('foot')
<script type="text/javascript" src="{{asset('js/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $('.clockpicker').clockpicker();
  });
</script>
<script type="text/javascript" src="{{asset('js/managenotification.js')}}"></script>
@stop