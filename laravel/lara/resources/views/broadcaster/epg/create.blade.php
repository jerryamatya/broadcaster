@extends('broadcaster.partials.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
@stop
@section('content')
@include('broadcaster.partials.error')
<div class="row">
  {!!Form::open(['route' => ['bchannelEpgStore',$channelId],'id'=>''])!!}
  <div class="col-md-12">
   <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Name</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
     <tr>
      <td>
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>"Name"])!!}</td>
        <td>{!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>"Details","rows"=>1])!!}</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="col-md-12">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php
    $days = [1,2,3,4,5,6,7];
  ?>
    @foreach($days as $day)
    {{-- Start Panel --}}
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne{{$day}}">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$day}}" aria-expanded="false" aria-controls="collapseOne{{$day}}">
            Day:{{getDay($day)}}
          </a>
        </h4>
      </div>
      <div id="collapseOne{{$day}}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne{{$day}}">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 sortable">
              <div class="row-fluid">
                <div class="col-md-12">
                  <a href="#" class="addprgm" data-day="{{$day}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add </a>      
                </div>
              </div>


        </div>      
      </div>
    </div>
  </div>
</div>
{{-- End Panel --}}
@endforeach
</div>
</div>
<div class="col-md-12">
  <div class="form-group">
    {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
  </div>
</div> 
{!!Form::close()!!}
</div>
<div class="hide">
              <div class="row-fluid prgm">
               <div class="col-md-6">
                <div class="form-group">
    
                 <input type="text"  class="name form-control" placeholder="Name">    
               </div>

             </div>
             <div class="col-md-3">
              <div class="form-group input-group clockpicker"  data-autoclose="true">

                <input type="text" class="start form-control" placeholder="Start">  
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>           
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group input-group clockpicker" data-autoclose="true">


                <input type="text" class="end form-control" placeholder="End">  
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>          
              </div>
            </div>
          </div>
</div>	
@stop
@section('foot')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $( ".sortable:first" ).sortable();
    $('.sortable').find('.clockpicker').clockpicker();

  });
</script>
  <script type="text/javascript" src="{{asset('js/manageepg.js')}}"></script>

@stop
