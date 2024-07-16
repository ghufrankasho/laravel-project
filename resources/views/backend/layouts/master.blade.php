<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<!-- head -->

<head>
    @include('backend.layouts.head')
</head>
<!-- head -->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('backend/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>

        @include('backend.layouts.nav')
        @include('backend.layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('backend.layouts.footer')
    </div>
    <!-- ./wrapper -->

</body>

</html>
