<!-- HTML Document -->
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui" />
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="PIXINVENT" />
    <title>Login Page</title>
    <link rel="apple-touch-icon" href="{{ asset('newdata/iub.jpg') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('newdata/iub.jpg') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet" />

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}" />
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}" />

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}" />
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <!-- END: Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="row justify-content-center"> <!-- Centering the content -->
                            <div class="col-md-4"> <!-- Adjust the width as needed -->
                                <div class="card mb-0">
                                    <div class="card-body text-center">
                                        <a href="index.html" class="brand-logo">
                                            <img src="{{ asset('app-assets/images/uni.png') }}" alt="LOGO"
                                                style="height: 130px; width:130px;">
                                            <h2 class="brand-text text-primary ms-1">MNS-UET MULTAN</h2>
                                        </a>
                                        <h6 class="card-title mb-1">LOGIN</h6>
                                        <p class="card-text mb-2">Please sign-in to your account and start the adventure
                                        </p>
                                        @include('flash::message')
                                        <form class="auth-login-form mt-2" action="{{ route('login') }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label for="login-email" class="form-label">CNIC/B-form Number <span
                                                            class="text-danger">(without Dashes (-))</span></label>
                                                </div>

                                                <input type="text" class="form-control" id="login-email"
                                                    name="cnic/b-form" placeholder="3220324198595"
                                                    aria-describedby="login-email" tabindex="1" autofocus />
                                            </div>

                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="login-password">Password</label>
                                                    <a href="auth-forgot-password-basic.html">
                                                        <small>Forgot Password?</small>
                                                    </a>
                                                </div>
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input type="password" class="form-control form-control-merge"
                                                        id="login-password" name="password" tabindex="2"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="login-password" />
                                                    <span class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="remember-me" tabindex="3" />
                                                        <label class="form-check-label" for="remember-me"> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                                        </form>

                                        <p class="text-center mt-2">
                                            <span>New on our platform?</span>
                                            @if (Route::currentRouteName() === 'login')
                                                <a href="{{ route('register') }}">
                                                    <button class="btn btn-secondary">Create an account</button>
                                                </a>
                                            @endif
                                        </p>

                                        <div class="divider my-2">
                                            <div class="divider-text">or</div>
                                        </div>

                                        {{-- <div class="auth-footer-btn d-flex justify-content-center">
                                            <a href="#" class="btn btn-facebook">
                                                <i data-feather="facebook"></i>
                                            </a>
                                            <a href="#" class="btn btn-twitter white">
                                                <i data-feather="twitter"></i>
                                            </a>
                                            <a href="#" class="btn btn-google">
                                                <i data-feather="mail"></i>
                                            </a>
                                            <a href="#" class="btn btn-github">
                                                <i data-feather="github"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on("load", function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14,
                });
            }
        });
    </script>
</body>

</html>
