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
  <link rel='stylesheet' href="{{asset('assets/css/bstyle.css')}}">
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
             <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{route('broadcasterHome')}}">Broadcasters</a>
          </div>
        <div class="collapse navbar-collapse">
        <p class="navbar-text pull-right" style="">{{ucwords(\Auth::user()->broadcaster->display_name)|ucwords(\Auth::user()->broadcaster->display_name)}}</p>
        </div>
        </div>


      </nav>
      @include('broadcaster.partials.success')
      <div class="row menuwrapper">
        <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <!-- <div class="absolute-wrapper"> </div> -->
        <!-- Menu -->
        <div class="side-menu">

          <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
              <ul class="nav navbar-nav">

                <li class="{{setBroadcasterActive('/')}}"><a href="{{route('broadcasterHome')}}"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                <!-- Dropdown-->
                <li>
                  <a data-toggle="collapse" href="#dropdown-services">
                    <span class="glyphicon glyphicon-globe"></span> Services <span class="caret"></span>
                  </a>
                  <!-- Dropdown level 1 -->
                  <div id="dropdown-services" class="panel-collapse collapse {{getCollapse($cbs_services)}}">
                    <div class="">
                      <ul class="nav navbar-nav">
                        {!!getBroadcasterServicesNav($cbs_services)!!}  
                      </ul>
                    </div>
                  </div>
                </li>
                <li>
                  <a data-toggle="collapse" href="#dropdown-user">
                    <span class="glyphicon glyphicon-user"></span> User <span class="caret"></span>
                  </a>
                  <!-- Dropdown level 1 -->
                  <div id="dropdown-user" class="panel-collapse collapse {{setActive('/profile')?'in':''}}">
                    <div class="">
                      <ul class="nav navbar-nav">
                       <li class="{{setActive('/profile')}}"><a href="{{route('broadcasterProfile')}}">profile</a></li>
                       <li>
                        <a href="{{route('logout')}}">logout</a>
                      </li                      </ul>
                    </div>
                  </div>                  
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav>

        </div>

      </div>
      @section('foot')
      <script>
        $(function () {
          $('.navbar-toggle').click(function () {
            $('.navbar-nav').toggleClass('slide-in');
            $('.side-body').toggleClass('body-slide-in');
            $('#search').removeClass('in').addClass('collapse').slideUp(200);

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
      });

   // Remove menu for searching
   $('#search-trigger').click(function () {
    $('.navbar-nav').removeClass('slide-in');
    $('.side-body').removeClass('body-slide-in');

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').removeClass('slide-in');

      });
 });
      </script>
      @stop
      <!-- Main Content -->
      <div class="container-fluid">
        <div class="side-body">
