<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="cache-control" content="no-store" />
  <meta http-equiv="cache-control" content="must-revalidate" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <title>
    CBS Solution
  </title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel='stylesheet' href="{{asset('css/bootstrap.min.css')}}">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <!--<link rel='stylesheet' href="{{asset('css/flat-ui.min.css')}}">-->
  <!-- Optional theme -->
  <link rel='stylesheet' href="{{asset('assets/css/style.css')}}">
  <link rel='stylesheet' href="{{asset('assets/css/sidenav.css')}}">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      @yield('head')
    </head>
    <body>

      <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{route('broadcasterHome')}}">Broadcasters</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown {{setActive('/services')}}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Services <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  {!!getBroadcasterServicesNav($cbs_services)!!}
                </ul>
              </li>
            </ul>
            {{\Auth::user()->broadcaster->display_name|\Auth::user()->broadcaster->display_name}}
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li class="{{setActive('/profile')}}"><a href="{{route('broadcasterProfile')}}">profile</a></li>
                  <li>
                    <a href="{{route('logout')}}">logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>


      <div class="container-fluid">
              @include('broadcaster.partials.success')
<div class="row">
<div class="col-md-4 nopadding">
        <div class="nav-side-menu">
          <div class="brand">Brand Logo</div>
          <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

          <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
              <li>
                <a href="#">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                </a>
              </li>

              <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>
              </li>
              <ul class="sub-menu collapse" id="products">
                <li class="active"><a href="#">CSS3 Animation</a></li>
                <li><a href="#">General</a></li>
                <li><a href="#">Buttons</a></li>
                <li><a href="#">Tabs & Accordions</a></li>
                <li><a href="#">Typography</a></li>
                <li><a href="#">FontAwesome</a></li>
                <li><a href="#">Slider</a></li>
                <li><a href="#">Panels</a></li>
                <li><a href="#">Widgets</a></li>
                <li><a href="#">Bootstrap Model</a></li>
              </ul>


              <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
              </li>  
              <ul class="sub-menu collapse" id="service">
                <li>New Service 1</li>
                <li>New Service 2</li>
                <li>New Service 3</li>
              </ul>


              <li data-toggle="collapse" data-target="#new" class="collapsed">
                <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
              </li>
              <ul class="sub-menu collapse" id="new">
                <li>New New 1</li>
                <li>New New 2</li>
                <li>New New 3</li>
              </ul>


              <li>
                <a href="#">
                  <i class="fa fa-user fa-lg"></i> Profile
                </a>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-users fa-lg"></i> Users
                </a>
              </li>
            </ul>
          </div>
        </div>
</div>
<div class="col-md-8">
