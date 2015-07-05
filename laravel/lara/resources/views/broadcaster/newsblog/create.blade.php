@extends('broadcaster.partials.master')
@section('content')
@include('broadcaster.partials.error')
		{!!Form::open(['route' => 'newsStore','files'=>true])!!}
		<div class="row">

			<div class="col-md-12">						
				<div class="form-group">
					{!!Form::label('Title')!!}
					{!! Form::text('title',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-12">						
				<div class="form-group">
					{!!Form::label('Slug')!!}
					{!! Form::text('slug',null,['class'=>'form-control'])!!}
				</div>
			</div>			
			<div class="col-md-12">
				<div class="form-group"> 
					{!!Form::label('Body')!!}            

					{!!Form::textarea('body',null,['class'=>'form-control','rows'=>5])!!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group"> 
					{!!Form::label('Excerpt')!!}            

					{!!Form::textarea('excerpt',null,['class'=>'form-control','rows'=>2])!!}
				</div>
			</div>
			<div class="col-md-12">						
				<div class="form-group">
					<label>Image</label>
					<input type="file" name="img" class="form-control">
				</div>
			</div>	
			<div class="col-md-12">
				<div class="form-group">
					{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
					{!!Form::reset('Reset',['class'=>'btn btn-default'])!!}							
				</div>
			</div>							

		</div>				
	</div>
</form>
@stop
	
