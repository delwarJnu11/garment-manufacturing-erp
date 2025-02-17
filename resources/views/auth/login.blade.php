{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ms-3">
        {{ __('Log in') }}
    </x-primary-button>
</div>
</form>


</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="Garments Manufacturing ERP SOFTWARE" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>LOGIN | Garments Manufacturing ERP SOFTWARE</title>

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
    <link rel="stylesheet" href="{{ asset('assets') }}css/select2.min.css" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/all.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
    @yield('css')
</head>

<body
    style="
    background: linear-gradient(rgba(0, 0, 0,0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets') }}/img/login-bg.jpg'), center/cover no-repeat fixed;
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
">
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="page-wrapper login-page-wrapper" style="min-height: 0 !important">
            {{-- <div class="content"> --}}
            <div class="account-content" style="background: #fff; border-radius: 5px">
                <div class="login-wrapper">
                    <div class="login-content">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="login-userset">
                                {{-- <div class="login-logo logo-normal">
                                        <img src="assets/img/logo.png" alt="img">
                                    </div> --}}
                                {{-- <a href="index.html" class="login-logo logo-white">
                                        <img src="assets/img/logo-white.png" alt="">
                                    </a> --}}
                                <div class="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4>Access the Garments ERP panel using your email and password.</h4>
                                </div>
                                <div class="form-login mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="form-addons">
                                        <input class="form- control" type="email" name="email" id="email"
                                            value="{{ old('email') }}" required autofocus autocomplete="email" />

                                        <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-login mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="pass-group">
                                        <input type="password" value="{{ old('password') }}"
                                            class="pass-input form-control" id="password" name="password" required
                                            autocomplete="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-login authentication-check">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center justify-content-between">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                    <input type="checkbox" class="form-control">
                                                    <span class="checkmarks"></span>Remember me
                                                </label>
                                            </div>
                                            <div class="text-end">
                                                <a class="forgot-link" href="forgot-password.html">Forgot
                                                    Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button type="submit" class="btn btn-login">Sign In</button>
                                </div>
                                <div class="signinform text-center">
                                    <h4>New on our platform?<a href="{{ route('register') }}" class="hover-a"> Create
                                            an
                                            account</a></h4>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
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
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"90e33fd83af0a475","version":"2025.1.0","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"3ca157e612a14eccbb30cf6db6691c29","b":1}'
        crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>