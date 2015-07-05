<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>
		CBS Solution - Signup
	</title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel='stylesheet' href="{{asset('css/bootstrap.min.css')}}"> 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head>
  <body>
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-8 col-md-offset-2">
  				<div class="panel panel-default">
  					<div class="panel-heading">Register</div>
  					<div class="panel-body">
  						@if (count($errors) > 0)
  						<div class="alert alert-danger">
  							<strong>Whoops!</strong> There were some problems with your input.<br><br>
  							<ul>
  								@foreach ($errors->all() as $error)
  								<li>{{ $error }}</li>
  								@endforeach
  							</ul>
  						</div>
  						@endif

  						<form class="form-horizontal" role="form" method="POST" action="{{route('postRegisterBroadcaster')}}">
  							<input type="hidden" name="_token" value="{{ csrf_token() }}">
  							<fieldset>
  								<legend>Company</legend>
  								<div class="form-group">
  									<label class="col-md-4 control-label">Company Name</label>
  									<div class="col-md-6">
  										<input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">
  									</div>
  								</div>
  								<div class="form-group">
  									<label class="col-md-4 control-label">Display Name</label>
  									<div class="col-md-6">
  										<input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}">
  									</div>
  								</div>
  							</fieldset>
  							<fieldset>
  								<legend>Login</legend>

  								<div class="form-group">
  									<label class="col-md-4 control-label">E-Mail Address</label>
  									<div class="col-md-6">
  										<input type="email" class="form-control" name="email" value="{{ old('email') }}">
  									</div>
  								</div>

  								<div class="form-group">
  									<label class="col-md-4 control-label">Password</label>
  									<div class="col-md-6">
  										<input type="password" class="form-control" name="password">
  									</div>
  								</div>

  								<div class="form-group">
  									<label class="col-md-4 control-label">Confirm Password</label>
  									<div class="col-md-6">
  										<input type="password" class="form-control" name="password_confirmation">
  									</div>
  								</div>
  							</fieldset>
  							<fieldset>
  								<legend>Services</legend>
  								<div class="form-group">
  									<label class="col-md-4 control-label">Choose Services</label>
  									<div class="col-md-6">
  										<?php foreach($services as $id=>$name):?>
  											<input type="checkbox" class="form" value="<?php echo $id;?>" name="services[]">
  											<?php echo $name;?>
  										<?php endforeach; ?>
  									</div>
  								</div>							
  							</fieldset>

  							<div class="form-group">
  								<div class="col-md-6 col-md-offset-4">
  									<button type="submit" class="btn btn-primary">
  										Register
  									</button>
  								</div>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </body>
  </html>