 @include('admin.partials.header')
  @yield('content')

  @include('admin.partials.footer')
  <div class="hide">
    @yield('hidden')	
  </div>
  @yield('foot')
</body>
</html>