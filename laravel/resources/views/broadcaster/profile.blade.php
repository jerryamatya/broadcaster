@extends('broadcaster.partials.master')
@section('content')
@include('broadcaster.partials.error')

<form class="form-horizontal" role="form" method="POST" action="{{route('broadcasterProfileUpdate')}}" enctype="multipart/form-data">
	<div class="row-fluid">
		<div class="col-md-6">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<div class="col-md-12">
						{!!Form::label('Email')!!}
						<input type="email" class="form-control" disabled value="{{$user->email}}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						{!!Form::label('Name')!!}

						{!! Form::text('name',$user->name,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label>
							Change Password
							</label>
														<input type="checkbox" name="changepass" class="changepass" {{old('changepass')?"checked":""}}>
					</div>
				</div>
				<div class="hide" id="passwordchangeholder">
					<div class="form-group">
						<div class="col-md-12">

							<label>Current Password</label>
							<input type="password" class="form-control" name="currentpassword">
						</div>	
					</div>
					<div class="form-group">
						<div class="col-md-12">

							<label>New Password</label>
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">

							<label>Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation">
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-12">
							{!!Form::label('Company Name')!!}

							{!! Form::text('company_name',$user->broadcaster->company_name,['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							{!!Form::label('Display Name')!!}
							{!! Form::text('display_name',$user->broadcaster->display_name,['class'=>'form-control'])!!}
						</div>
					</div>
					<div class="form-group">
						<label>Logo</label>
						<input type="file" name="logo" class="form-control">
						@if($user->broadcaster->logo)
						<img style="max-width: 100%" src="{{asset($cbs_options['broadcasterLogoPath'].$user->broadcaster->logo)}}">
						@endif 
					</div>

				</div>
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