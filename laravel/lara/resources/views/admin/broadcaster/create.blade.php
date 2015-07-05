@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
    {!!Form::open(array('route' => 'broadcasterStore','files'=>true))!!}
  <div class="form-group">
          {!!Form::label('Name')!!}
          {!! Form::text('display_name',null,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
          {!!Form::label('Email')!!}
          {!! Form::text('email',null,['class'=>'form-control'])!!}
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Choose Logo</label>
    <input type="file" id="" name="logo" >
  </div>

              <div class="form-group">
                 <fieldset>
            <legend>Services</legend>         
                <label>Choose Services</label>
                <?php foreach($services as $id=>$name):?>
                  <input type="checkbox" class="form" value="<?php echo $id;?>" name="services[]">
                  <?php echo $name;?>
                <?php endforeach; ?>
                </fieldset> 
              </div>              
            
    {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!!Form::reset('Clear',['class'=>'btn btn-default'])!!}
    {!!Form::close()!!}
@stop
