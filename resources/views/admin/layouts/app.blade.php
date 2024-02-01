<!DOCTYPE html>
<html class="no-js" lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    @include('admin.layouts.head')
</head>

<body>

    <div class="container-scroller">

        @include('admin.layouts.header')

        @yield('content')

        @include('admin.layouts.footer')
    </div>

    @include('admin.layouts.foot')

    @yield('scripts')

    @yield('toastr')
</body>

</html>
