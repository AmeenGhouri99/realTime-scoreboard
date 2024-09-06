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
                        <!-- Forgot Password basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html" class="brand-logo">
                                    <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}" height="180px"
                                        width="250px">
                                </a>

                                <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
                                <p class="card-text mb-2">Enter your Phone Number Detail and we'll send you OTP(One Time
                                    Password)

                                </p>

                                <form class="auth-forgot-password-form mt-2" action="{{ route('forgot_post') }}"
                                    method="POST">
                                    @csrf
                                    @include('flash::message')
                                    <div class="mb-1">
                                        <label for="forgot-password-email" class="form-label">Phone</label>
                                        <input type="hidden" value="+" id="phone_country_code"
                                            name="phone_country_code">
                                        <input name="phone" type="text" id="phone" class="form-control">
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="2">Send Otp</button>
                                </form>

                                <p class="text-center mt-2">
                                    <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Back to login
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Forgot Password basic -->
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
