<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Garments Manufacturing ERP SOFTWARE" />
    <meta name="keywords"content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Sigmar&display=swap" rel="stylesheet">
    <title>Garments Manufacturing ERP SOFTWARE</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script
        src="{{asset('assets')}}/js/theme-script.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="https://dreamspos.dreamstechnologies.com/html/template/assets/img/favicon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap-datetimepicker.min.css" />

    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/animate.css" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css" />
    @yield('css')
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        @include('layout.backend.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('layout.backend.sidebar')
        <!-- /Sidebar -->
        @include('layout.backend.sidebar2')
        <!-- Sidebar -->
        <!-- /Sidebar -->

        <!-- Sidebar -->
        @include('layout.backend.horizontal_sidebar')
        <!-- /Sidebar -->

        <div class="page-wrapper">
            <div class="content">
                @yield('page_content')
            </div>
            @include('layout.backend.footer')
        </div>

        <div class="customizer-links" id="setdata">
            <ul class="sticky-sidebar">
                <li class="sidebar-icons">
                    <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                        data-bs-original-title="Theme">
                        <i data-feather="settings" class="feather-five"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script
        src="{{asset('assets')}}/js/jquery-3.7.1.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Feather Icon JS -->
    <script
        src="{{asset('assets')}}/js/feather.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Slimscroll JS -->
    <script
        src="{{asset('assets')}}/js/jquery.slimscroll.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Bootstrap Core JS -->
    <script
        src="{{asset('assets')}}/js/bootstrap.bundle.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Chart JS -->
    <script
        src="{{asset('assets')}}/js/plugins/apexchart/apexcharts.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>
    <script
        src="{{asset('assets')}}/js/plugins/apexchart/chart-data.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Sweetalert 2 -->
    <script
        src="{{asset('assets')}}/js/plugins/sweetalert/sweetalert2.all.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>
    <script
        src="{{asset('assets')}}/js/plugins/sweetalert/sweetalerts.min.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <!-- Custom JS -->

    <script
        src="{{asset('assets')}}/js/script.js"
        type="6bc737fdedebc88b41732761-text/javascript"></script>

    <script src="{{ asset('assets') }}/js/rocket-loader.min.js" data-cf-settings="6bc737fdedebc88b41732761-|49" defer>
    </script>
    <!-- SideBar JS -->
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"90e33fd83af0a475","version":"2025.1.0","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"3ca157e612a14eccbb30cf6db6691c29","b":1}'
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    @yield('script')
</body>

</html>
