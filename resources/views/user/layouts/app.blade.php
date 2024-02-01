<!DOCTYPE html>
<html class="no-js" lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    @include('user.layouts.head')
</head>

<body>

    <div class="container-scroller">

        @include('user.layouts.header')

        @yield('content')

        @include('user.layouts.footer')
    </div>

    @include('user.layouts.foot')

    @yield('toastr')
</body>

</html>
