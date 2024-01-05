<!DOCTYPE html>
<html lang="en">
<head>
   @include('clients.layouts.header')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

  @yield('content')
<!-- Footer Section Begin -->
<footer class="footer">
   @include('clients.layouts.footer')
</footer>
<!-- Footer Section End -->
</body>
</html>