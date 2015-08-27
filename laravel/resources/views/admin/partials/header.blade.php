<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>
    CBS Solution
  </title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel='stylesheet' href="{{asset('css/bootstrap.min.css')}}"> 
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
  <link rel='stylesheet' href="{{asset('assets/css/style.css')}}">
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
            <a class="navbar-brand" href="{{route('adminHome')}}">Broadcasters</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class='{{setActive('/broadcaster')}}'><a href="{{route('broadcasterList')}}">Broadcasters</a></li>
              <li class="dropdown {{setActive('/services')}}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Services <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class='{{setActive('/services/channel')}}'><a href="{{route('channelList')}}">Channel</a></li>
                  <li class='{{setActive('/services/newsapp')}}'><a href="{{route('newsappList')}}">News App</a></li>
                  <li class='{{setActive('/services/vod')}}'><a href="{{route('vodList')}}">Vod</a></li>
                  <li class="divider"></li>
                </ul>
                <li class="{{setActive('/notifications')}}">
                <a href="{{route('notificationsIndex')}}">Notifications</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="{{route('logout')}}">logout</a>
                  </li>
                </ul>
              </li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </nav>


      <div class="container">
        @include('admin.partials.success')

