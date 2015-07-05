@extends('broadcaster.partials.master')
@section('content')
<h2>
  Services : Overview
</h2>
@foreach($cbs_services as $service)
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{$service->name}}</h3>
  </div>
  <div class="panel-body">
    @if($data[$service->id]->count())
    @include('broadcaster.partials.dashboardservices', ['servicename' => $service->name,'serviceid'=>$service->id])
    @else
      <p>No active services</p>
    @endif
  </div>
</div>
@endforeach
@stop