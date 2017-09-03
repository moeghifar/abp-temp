<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ABP - @yield('title')</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="/assets/images/favicon.ico">
        @include('common.css')
        @stack('custom_css')
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            @include('common.topbar')
            @include('common.sidebar')
            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="">
                        <div class="page-header-title">
                            <h4 class="page-title">@yield('page_title')</h4>
                        </div>
                    </div>
                    <div class="page-content-wrapper ">
                        <div class="container">
                            @yield('content')
                        </div><!-- container -->
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
                <footer class="footer">
                    © <?php echo date('Y') ?> - ABP Accounting
                </footer>
            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->
        {{-- include required common js --}}
        @include('common.js')
        {{-- custom javascript stack --}}
        @stack('custom_js')
    </body>
</html>