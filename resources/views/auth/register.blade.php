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
    <title>Register | Garments Manufacturing ERP SOFTWARE</title>

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

<body style="background-color: #e5e5e5;">
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper register-wrap" style="margin: 10px 0;">
                <div class="login-content"
                    style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                    {{-- <form action="{{ route('register') }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
                        @csrf
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="assets/img/logo.png" alt="img">
                            </div>
                            <a href="index.html" class="login-logo logo-white">
                                <img src="assets/img/logo-white.png" alt="">
                            </a>
                            <div class="login-userheading">
                                <h3>Register</h3>
                                <h4>Create New Garments ERP Account</h4>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <label>Name</label>
                                    <div class="form-addons">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control">
                                        <img src="{{ asset('assets') }}/img/icons/user-icon.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login col-md-6">
                                    <label>Email Address</label>
                                    <div class="form-addons">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') }}">
                                        <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password"
                                            value="{{ old('password') }}">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login col-md-6">
                                    <label>Confirm Passworrd</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <span class="fas toggle-passwords fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">User Role</label>
                                        <select class="select form-control" name="role_id">
                                            <option>Select User Role</option>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @empty
                                                <option>No Role Found!</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-login">
                                    <label>Upload Image</label>
                                    <input style="padding: 8px 0" type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="form-login authentication-check">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="custom-control custom-checkbox justify-content-start">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>I agree to the <a href="#"
                                                        class="hover-a">Terms &amp; Privacy</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign Up</button>
                            </div>
                            <div class="signinform">
                                <h4>Already have an account ? <a href="signin.html" class="hover-a">Sign In
                                        Instead</a></h4>
                            </div>
                        </div>
                    </form> --}}

                    <form action="{{ route('register') }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
                        @csrf
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <!-- <img src="assets/img/logo.png" alt="img"> -->
                            </div>
                            <a href="index.html" class="login-logo">
                                <img src="{{ asset('assets') }}/img/user.png}" width="100px" height="100px" alt="User Icon">
                            </a>
                            <div class="login-userheading">
                                <h3>Register</h3>
                                <h4>Create New User Account</h4>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <label>Name</label>
                                    <div class="form-addons">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        <img src="{{ asset('assets') }}/img/icons/user-icon.svg" alt="img">
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-login col-md-6">
                                    <label>Email Address</label>
                                    <div class="form-addons">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                        <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password" value="{{ old('password') }}">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-login col-md-6">
                                    <label>Confirm Passworrd</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <span class="fas toggle-passwords fa-eye-slash"></span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-login col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">User Role</label>
                                        <select class="form-select" name="role_id">
                                            <option>Select User Role</option>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @empty
                                                <option>No Role Found!</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-login">
                                    <label>Upload Image</label>
                                    <input style="padding-block: 8px" type="file" name="image" class="form-control">
                                </div>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="form-login authentication-check">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="custom-control custom-checkbox justify-content-start">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>I agree to the <a href="#"
                                                        class="hover-a">Terms &amp; Privacy</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign Up</button>
                            </div>
                            <div class="signinform text-center">
                                <h4>Already have an account ? <a href={{ route('login') }} class="hover-a">Sign In Instead</a></h4>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
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
