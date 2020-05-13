<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from themes.startbootstrap.com/sb-admin-pro/dashboard-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Apr 2020 16:29:28 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>@yield('title')</title>
    @stack('addon-style')
    @include('includes.admin.style')
    @stack('prepend-style')
  </head>
  <body class="nav-fixed">
    @include('includes.admin.navbar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('includes.admin.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('includes.admin.footer')
        </div>
    </div>
    @stack('addon-sctipt')
    @include('includes.admin.script')
    @stack('prepend-script')
  </body>

<!-- Mirrored from themes.startbootstrap.com/sb-admin-pro/dashboard-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Apr 2020 16:29:29 GMT -->
</html>
