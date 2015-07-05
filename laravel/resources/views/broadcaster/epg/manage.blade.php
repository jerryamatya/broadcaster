@extends('broadcaster.partials.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-clockpicker.min.css')}}">
@stop
@section('content')
@include('broadcaster.partials.error')
<div class="row">
  @if(!count($epg))
  <h1>No epg for this channel</h1>
  <a href="{{route('bchannelEpgCreate',$channelId)}}">create new</a>
  @endif
  @if (count($epg))
  {!!Form::open(['route' => ['bepgUpdate',$epg->id],'id'=>''])!!}
  <div class="col-md-12">
   <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Name</th>
        <th>Details</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
     <tr>
      <td>
        {!! Form::text('name',$epg->name,['class'=>'form-control','placeholder'=>"Name"])!!}</td>
        <td>{!! Form::textarea('details',$epg->details,['class'=>'form-control','placeholder'=>"Details","rows"=>1])!!}</td>
        <td>{!! Form::select('active', [1=>"Active",2=>'Inactive'], $epg->active, array('class' => 'form-control')) !!}
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="col-md-12">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php
    $schedule = unserialize($epg->schedule);
    $days = [1,2,3,4,5,6,7];
  ?>
    @if (true)
    @foreach($days as $i)
    {{-- Start Panel --}}
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne{{$i}}">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne{{$i}}">
            Day:{{getDay($i)}}
          </a>
        </h4>
      </div>
      <div id="collapseOne{{$i}}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne{{$i}}">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 sortable">
              <div class="row-fluid">
                <div class="col-md-12">
                  <a href="#" class="addprgm" data-day="{{$i}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> add </a>      
                </div>
              </div>
              <?php 
              if(isset($schedule[$i])):
              $program = $schedule[$i];
              ?>
              @foreach($program['names'] as $j=>$name)
              <div class="row-fluid">
               <div class="col-md-6">
                <div class="form-group">
    
                 <input type="text" name="programs[{{$i}}][names][]" value="{{$name}}" class="form-control" placeholder="Name">    
               </div>

             </div>
             <div class="col-md-3">
              <div class="form-group input-group clockpicker"  data-autoclose="true">

                <input type="text" name="programs[{{$i}}][starts][]" value="{{$program['starts'][$j]}}" class="form-control" placeholder="Start">  
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>           
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group input-group clockpicker" data-autoclose="true">


                <input type="text" name="programs[{{$i}}][ends][]" value="{{$program['ends'][$j]}}" class="form-control" placeholder="End">  
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>          
              </div>
            </div>
          </div>


          @endforeach
        <?php endif; ?>
        </div>      
      </div>
    </div>
  </div>
</div>
{{-- End Panel --}}
@endforeach
@endif
</div>
</div>
<div class="col-md-12">
  <div class="form-group">
    {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
  </div>
</div> 
{!!Form::close()!!}

@endif

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
