 @include('broadcaster.partials.header')

  @yield('content')

  @include('broadcaster.partials.footer')
  <div class="hide">
    @yield('hidden')	
  </div>