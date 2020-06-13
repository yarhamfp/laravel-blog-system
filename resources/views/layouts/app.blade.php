<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

@stack('addon-style')
@include('includes.style')
@stack('prepend-style')

</head>

<body>

  <!-- Navigation -->
  @include('includes.navbar')

  @yield('content')

  <!-- Footer -->
  <!-- Footer -->
  @include('includes.footer')
  <!-- Footer -->
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
@stack('addon-script')
@include('includes.script')
@stack('prepend-script')

</body>

</html>