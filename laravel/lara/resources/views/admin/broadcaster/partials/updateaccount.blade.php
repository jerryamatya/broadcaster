@extends('admin.partials.master')
@section('content')
@include('admin.partials.error')
<h3> Account for {{$broadcaster->company_name}} </h3>
<form class="form-horizontal" role="form" method="POST" action="{{route('broadcasterAccountUpdate',$broadcaster->user->id)}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row-fluid">
		<div class="form-group col-md-12">
			<label>E-Mail Address</label>
			<input type="email" class="form-control" disabled value="{{$broadcaster->user->email}}">
		</div>
		<div class="form-group col-md-12">
			<label>Name</label>
			<input type="text" class="form-control" name="name" value="{{$broadcaster->user->name}}">
		</div>
		<div class="form-group col-md-12">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="changepass" class="changepass" {{old('changepass')?"checked":""}}>
					Change Password
				</label>
			</div>

		</div>
		<div class="hide" id="passwordchangeholder">
			<div class="form-group col-md-12">
				<label>Old Password</label>
				<input type="password" class="form-control" name="oldpassword">
			</div>	
			<div class="form-group col-md-12">
				<label>New Password</label>
				<input type="password" class="form-control" name="password">
			</div>

			<div class="form-group col-md-12">
				<label>Confirm Password</label>
				<input type="password" class="form-control" name="password_confirmation">
			</div>
		</div>	
		<div class="col-md-12">
			<div class="form-group">
				{!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
				{!!Form::reset('Reset',['class'=>'btn btn-default'])!!}							
			</div>
		</div>	
	</div>
</form>
@stop
@section('foot')
<script type="text/javascript">
	$(function(){
		var changepass = $('.changepass'),
		holder = $("#passwordchangeholder");
		if(changepass.attr('checked')){
			holder.removeClass('hide');
		}
		changepass.on('click',function(){
			if(holder.hasClass('hide')){
				holder.removeClass('hide');
			}
			else
				holder.addClass('hide');
		});	
	});

</script>
@stop
