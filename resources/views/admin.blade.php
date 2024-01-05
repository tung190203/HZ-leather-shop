<!doctype html>
<html lang="en">

<head>
@include('admin.layouts.header')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @if(request()->route()->getName() !== 'admin.login' && request()->route()->getName() !== 'admin.error')
        @include('admin.layouts.sidebar')
    @endif
   @yield('content')

  </div>
@include('admin.layouts.footer')
</body>

</html>