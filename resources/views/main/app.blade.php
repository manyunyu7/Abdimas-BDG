<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>{{config('app.name')}}</title>
    <!-- Custom CSS -->
    <link href="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="{{ URL::to('bootstrap_ui') }}/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css"
        rel="stylesheet" />

    <!-- Toggle -->
    <link href="{{ URL::to('bootstrap_ui') }}/assets/libs/toggle_switch/dist/css/component-custom-switch.min.css"
        rel="stylesheet">

    <link href="{{ url('bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/surat.css')}}">
    <link href="{{ url('bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

    @include('main.styling')

    <!-- Custom CSS -->
    <link href="{{ URL::to('bootstrap_ui') }}/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @if (Auth::guard('admin')->check())
            @include('main.components.topbar-admin')
        @endif

        @if (Auth::guard('warga')->check())
            @include('main.components.topbar-warga')
        @endif

        @if (Auth::guard('keluarga')->check())
            @include('main.components.topbar-keluarga')
        @endif

        @if (Auth::guard('erte')->check())
            @include('main.components.topbar-erte')
        @endif

        @if (Auth::guard('erwe')->check())
            @include('main.components.topbar-erwe')
        @endif

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @if (Auth::guard('admin')->check())
            @include('main.components.left-sidebar-admin')
        @endif
        @if (Auth::guard('warga')->check())
            @include('main.components.left-sidebar-warga')
        @endif
        @if (Auth::guard('keluarga')->check())
            @include('main.components.left-sidebar-keluarga')
        @endif
        @if (Auth::guard('erte')->check())
            @include('main.components.left-sidebar-erte')
        @endif
        @if (Auth::guard('erwe')->check())
        @include('main.components.left-sidebar-erwe')
        @endif
    
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                @yield('page-breadcrumb')
            </div>

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                @yield('page-wrapper')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
              Copyright @ Kelurahan Citereup
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="{{ URL::to('bootstrap_ui') }}/dist/js/app-style-switcher.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/dist/js/feather.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
    </script>
    <script src="{{ URL::to('bootstrap_ui') }}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::to('bootstrap_ui') }}/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/c3/d3.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/c3/c3.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/libs/chartist/dist/chartist.min.js"></script>
    <script
        src="{{ URL::to('bootstrap_ui') }}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
    </script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ URL::to('bootstrap_ui') }}/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js">
    </script>

    <script src="{{ url('bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <link href="{{ url('bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js') }}" rel="stylesheet">


    {{-- <script src="sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script> --}}



    @yield('app-script')

    <script>
        // document.body.style.zoom = 0.8
    </script>


</body>

</html>
