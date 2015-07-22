<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>
		CBS Solution - Broadcaster Login
	</title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel='stylesheet' href="{{asset('css/bootstrap.min.css')}}">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link rel='stylesheet' href="{{asset('css/blogin.css')}}">

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
  				<div class="panel panel-default login-container">
  					<div class="panel-body">
  						<p class="text-center login-label">Sign in to</p>
  						<p class="text-center lead">Broadcasters</p>
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

  						<form class="form-horizontal" role="form" method="POST" action="{{ route('postLoginBroadcaster') }}">
  							<input type="hidden" name="_token" value="{{ csrf_token() }}">

  							<div class="form-group">
  								<div class="col-md-12">
  									<input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
  								</div>
  							</div>

  							<div class="form-group pwd-group">
  								<div class="col-md-12">
  									<input type="password" class="form-control" placeholder="Password" name="password">
  								</div>
  							</div>

  							<div class="form-group">
  								<div class="col-md-11 col-md-offset-1">
  									<div class="checkbox">
  										<label>
  											<input type="checkbox" name="remember"> Remember me on this computer
  										</label>
  									</div>
  								</div>
  							</div>
  							<div class="form-group">
  								<div class="col-md-12 text-center">
  									<button type="submit" class="btn btn-primary">Login</button>

  								</div>
  							</div>
  							<div class="form-group">
  								<div class="col-md-12 text-center">
  									<p> <strong>Help:</strong>
  										<a class="reset-link" href="{{ url('/password/email') }}">Reset your password</a></p>
  									</div>
  								</div>
  							</form>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<nav class="navbar navbar-default navbar-fixed-bottom">
  			<div class="container">
  				<div class="row-fluid">
  					<div class="col-md-12">
  						<p class="text-center">
  							Don't have a account? <a href="#" class="signup-link">Sign up today</a>.
  						</p>
  					</div>
  				</div>
  			</div>
  		</nav>
  	</body>
  	</html>