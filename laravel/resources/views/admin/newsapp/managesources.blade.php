@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<div class="row">
<div class="col-md-12">
	@if (count($newsapp->sources))
	<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Name</th>
              <th>Value</th>
              <th>Details</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
	@foreach($newsapp->sources as $source)
	<tr>
		<td>{{$source->name}}</td>
		<td>{{$source->value}}</td>
		<td>{{$source->details}}</td>
		<td><a class="editsource" href="javascript:void(0)" data-id="{{$source->id}}">edit</a></td>
	</tr>
	@endforeach
	</tbody>
	</table>
	@endif
	</div>
	<div class="col-md-12">
		<a href="#" id="newsource">new</a>
	</div>
	<div class="col-md-12">
		{!!Form::open(['route' => ['newsappSaveSources',$newsapp->id],'id'=>'managesourceform'])!!}
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		@if (count($newsapp->sources))
			@foreach($newsapp->sources as $source)
{{-- Start Panel --}}
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne{{$source->id}}">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$source->id}}" aria-expanded="false" aria-controls="collapseOne{{$source->id}}">
          Source:{{$source->name}}
        </a>
      </h4>
    </div>
    <div id="collapseOne{{$source->id}}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne{{$source->id}}">
      <div class="panel-body">
      <div class="row">
            {!!Form::hidden('sources[id][]',$source->id)!!}
            {!!Form::hidden('sources[delete][]','no')!!}
      	<div class="col-md-4">
      	{!! Form::text('sources[name][]',$source->name,['class'=>'form-control','placeholder'=>"Name"])!!}
		</div>			
      	<div class="col-md-4">
      	{!! Form::text('sources[value][]',$source->value,['class'=>'form-control','placeholder'=>"Value"])!!}
		</div>
      	<div class="col-md-4">
      	{!! Form::textarea('sources[details][]',$source->details,['class'=>'form-control','placeholder'=>"Details",'rows'=>1])!!}
		</div>
		</div>
      </div>
    </div>
  </div>
{{-- End Panel --}}
			@endforeach
		@endif
		</div>
          <div class="col-md-12">
        <div class="form-group">
          {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
          {!!Form::reset('Reset',['class'=>'btn btn-default'])!!}             
        </div>
      </div>  
		{!!Form::close()!!}
	</div>
	</div>
<div class="hide" id="newsourcepanel">
	{{-- Start Panel --}}
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="a">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false" aria-controls="">
          Source:new
        </a>
      </h4>
    </div>
    <div class="panel-collapse collapse in" role="tabpanel" aria-labelledby="a">
      <div class="panel-body">
      <div class="row">
      {!!Form::hidden('sources[id][]',0)!!}
      {!!Form::hidden('sources[delete][]','no')!!}
      	<div class="col-md-4">
      	{!! Form::text('sources[name][]',null,['class'=>'form-control','placeholder'=>"Name"])!!}
		</div>			
      	<div class="col-md-4">
      	{!! Form::text('sources[value][]',null,['class'=>'form-control','placeholder'=>"Value"])!!}
		</div>
      	<div class="col-md-4">
      	{!! Form::textarea('sources[details][]',null,['class'=>'form-control','placeholder'=>"Details",'rows'=>1])!!}
		</div>
		</div>
      </div>
    </div>

  </div>
{{-- End Panel --}}
</div>	
@stop
@section('foot')
  <script type="text/javascript" src="{{asset('js/managesource.js')}}"></script> 
@stop