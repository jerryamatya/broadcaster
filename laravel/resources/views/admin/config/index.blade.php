@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Config for {{$channel->name}} </h3>
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#ext_api" role="tab" data-toggle="tab">External Api</a></li>
  <li role="presentation"><a href="#notifications" role="tab" data-toggle="tab">Notifications</a></li>
</ul>
<form class="form-horizontal" role="form" method="POST" action="{{route('channelConfigStore',$channel->id)}}"> 
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="tab-content">
    <div class="row-fluid tab-pane active" id="ext_api">
      <h3>External Api</h3>
      @foreach($apiLabels as $k=>$v)
      <div class="form-group col-md-12">
        <label>{{$v}}</label>
        <input type="text" class="form-control" name="config[channel_external_api][{{$k}}]" value="{{$apiConfig->value[$k] or null}}">
      </div>
      @endforeach;
    </div>
    <div class="row-fluid tab-pane" id="notifications">
      <h3>Notification Keys</h3> 
            @foreach($parseKeysLabels as $k=>$v)
      <div class="form-group col-md-12">
        <label>{{$v}}</label>
        <input type="text" class="form-control" name="config[channel_parse_keys][{{$k}}]" value="{{$parseKeysConfig->value[$k] or null}}">
      </div>
      @endforeach;
    </div>
    <div class="row-fluid">
      <div class="col-md-12">
        <div class="form-group">
          {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
          {!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
        </div>
      </div>
    </div>    
  </div><!--end tab body-->   
</form>
@stop