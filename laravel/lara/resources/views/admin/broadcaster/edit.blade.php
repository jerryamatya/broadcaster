@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
{!!Form::model($broadcaster,['route' => ['broadcasterUpdate',$broadcaster->id],'files'=>true])!!}
<div class="form-group">
  {!!Form::label('Company')!!}
  {!! Form::text('company_name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
  {!!Form::label('Display Name')!!}
  {!! Form::text('display_name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
  <label>Choose Logo</label>
  <input type="file" id="" name="logo" >
</div>
<div class="form-group">
 <fieldset>
  <legend>Services</legend>
  <?php $bservices = $broadcaster->services->lists('id');
  ?>       
  <label>Choose Services</label>
  @foreach($services as $id=>$name)
  <?php $checked = in_array($id, $bservices) ? true : false;
  ?>
  <input type="checkbox" class="form" value="<?php echo $id;?>" name="services[]" @if($checked) checked='checked' @endif>
  {{ $name }}
  @endforeach
</fieldset> 
</div>    
{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
{!!Form::reset('Clear',['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
@stop
