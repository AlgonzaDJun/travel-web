<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    {{-- description --}}
    <meta name="description" content="Explore The Beautiful World
    As Easy One Click" />
    <meta name="keywords" content="travel web, yuk travel, paket travel">
    <meta name="author" content="Algonza Arjunantyo">
    <link rel="shortcut icon" href="{{ url('frontend/images/worldwide.png') }}" type="image/x-icon">

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

  </head>
  <body>
    <!-- navbar -->
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')

    
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    @include('sweetalert::alert')

    
  </body>
</html>
