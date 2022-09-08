<!doctype html>
<html lang="en" dir="ltr">
<!-- This "app.blade.php" master page is used for all the pages content present in "views/livewire" except "custom" and "switcher" pages -->

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="gStudent MAnagement System">
    <meta name="author" content="SOBIZTECH PVT LTD">
    <meta name="keywords" content="Student MAnagement System, Software, Srilanka, admin dashboard, admin template, admin, bootstrap 5, laravel admin, laravel admin dashboard template, laravel ui template, laravel admin panel, admin panel, laravel admin dashboard, laravel template, admin ui dashboard">

    @include('layouts.components.styles')

</head>

<body class="ltr app sidebar-mini light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            @include('layouts.components.app-header')

            @include('layouts.components.app-sidebar')

            <!--app-content open-->
            <div class="app-content main-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        {{-- session --}}
                        @if (\Session::has('success'))
                        <div class="alert alert-success session-msg" style="width: 50%; margin:0 auto 15px auto; text-align:center;">
                            <p>{{ \Session::get('success') }}</p>
                        </div>

                        <script>
                            $(function() {
                                setTimeout(function() {
                                    $('.session-msg').slideUp();
                                }, 5000);
                            });
                        </script>
                        @endif

                        @if (\Session::has('error'))
                        <div class="alert alert-danger session-msg" style="width: 50%; margin:0 auto 15px auto; text-align:center;">
                            <p>{{ \Session::get('error') }}</p>
                        </div>

                        <script>
                            $(function() {
                                setTimeout(function() {
                                    $('.session-msg').slideUp();
                                }, 5000);
                            });
                        </script>
                        @endif
                        {{-- session end --}}

                        @yield('content')

                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>

        @include('layouts.components.modal')

        @yield('modal')

        @include('layouts.components.footer')

    </div>
    <!-- page -->

    @include('layouts.components.scripts')

    <!-- APEXCHART JS -->
    <script src="{{asset('assets/js/apexcharts.js')}}"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script>

    <!-- INTERNAL DATA-TABLES JS-->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

    <!-- INDEX JS -->
    <script src="{{asset('assets/js/index1.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>

</body>

</html>