@extends('admin.partials.master')
@section('content')
<div class="row-fluid">
  <div class="col-md-12">
    <select name="channels" class="form-control">
      <option value="">Select Channel</option>
      @foreach($channels as $channel):
      <option value="{{route('channelNotificationManage',$channel->id)}}">{{$channel->name}}</option>
      @endforeach
    </select>
  </div>
</div>
@stop
@section('foot')
<script type="text/javascript">
$("select[name=channels]").change(function(){
  var redirect = $(this).val();
  if(redirect){
    window.location.href = redirect;;
  }
});
</script>
@stop