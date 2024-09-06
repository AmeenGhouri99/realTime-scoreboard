<link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/css/intlTelInput.css" />

@include('admin.layouts.header')

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Register basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('/') }}" class="brand-logo">
                                    <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}" height="180px"
                                        width="250px">
                                    {{-- <h2 class="brand-text text-primary ms-1">Auction 11</h2> --}}
                                </a>

                                <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
                                <p class="card-text mb-2">Make your app management easy and fun!</p>

                                <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    @include('flash::message')
                                    <div class="mb-1">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="Enter First Name" aria-describedby="register-first Name"
                                            tabindex="1" autofocus />
                                    </div>
                                    <div class="mb-1">
                                        <label for="last_name" class="form-label">LastName</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="johndoe" aria-describedby="last_name" tabindex="1"
                                            autofocus />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-email" class="form-label">Phone</label>
                                        </div>
                                        <input type="hidden" value="+" id="phone_country_code"
                                            name="phone_country_code">
                                        <input name="phone" type="text" id="phone" class="form-control">
                                    </div>
                                    <div class="mb-1">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="john@example.com" aria-describedby="email" tabindex="2" />
                                    </div>
                                    <div class="mb-1">
                                        <label for="password" class="form-label">Password</label>

                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="password" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" tabindex="3" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password_confirmation" tabindex="3" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="register-privacy-policy"
                                                tabindex="4" />
                                            <label class="form-check-label" for="register-privacy-policy">
                                                I agree to <a href="#">privacy policy & terms</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
                                </form>

                                <p class="text-center mt-2">
                                    <span>Already have an account?</span>
                                    <a href="{{ route('login') }}">
                                        <span>Sign in instead</span>
                                    </a>
                                </p>

                                <div class="divider my-2">
                                    <div class="divider-text">or</div>
                                </div>

                                <div class="auth-footer-btn d-flex justify-content-center">
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
                                </div>
                            </div>
                        </div>
                        <!-- /Register basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('admin.layouts.footer')
    <script src="{{ asset('app-assets/js/intlTelInput.min.js') }}"></script>
    <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            separateDialCode: true
        });
        // Function to handle country code change
        function handleCountryCodeChange() {
            var countryData = iti.getSelectedCountryData();
            console.log(countryData.dialCode)
            $('#phone_country_code').val('+' + countryData.dialCode);
        }
        var initialCountryData = iti.getSelectedCountryData();
        $('#phone_country_code').val('+' + initialCountryData.dialCode);
        input.addEventListener("countrychange", handleCountryCodeChange);
    </script>
