<html lang="en">
@include('partials._head')
<body class="sidebar-mini layout-fixed" style="height: auto;">

<style>
    .separator {
        display: flex;
        align-items: center;
        text-align: center;
    }

    thead {
        background-color:#800000 !important;
        color:#FFFFFF;
    }

    td {
    text-align: center !important;
    vertical-align: middle !important;
    }

    .separator::before,
    .separator::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }

    .separator:not(:empty)::before {
        margin-right: .25em;
    }

    .separator:not(:empty)::after {
        margin-left: .25em;
    }
</style>

<!-- Site wrapper -->
@include('partials._nav')
@include('partials._sidebar')
<div class="wrapper" style="width: auto; height: auto;">
        <div class="content-wrapper">
            @yield('content')
        </div>
   @include('partials._footer')

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
</div>
@include('partials._javascript')
@yield('scripts')
</body>
</html>
