@php
    if (!session()->has('user_id')) {
        header('Location:' . url('forgot'));
        exit();
    }
@endphp
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
                        <!-- two steps verification basic-->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html" class="brand-logo">
                                    <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}" height="180px"
                                        width="250px">
                                </a>

                                <h2 class="card-title fw-bolder mb-1">Two Step Verification 💬</h2>
                                <p class="card-text mb-75">
                                    We sent a verification code to your mobile. Enter the code from the mobile in the
                                    field below.
                                </p>
                                <p class="card-text fw-bolder mb-2">******0789</p>

                                <form class="mt-2" action="{{ route('forgot_password_verify_otp_post') }}"
                                    method="POST">
                                    @csrf
                                    @include('flash::message')
                                    <h6>Type your 6 digit security code</h6>
                                    <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" name="input1" />

                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" name="input2" />

                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" name="input3" />

                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" name="input4" />

                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" name="input5" />
                                        <input type="text"
                                            class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1"
                                            maxlength="1" autofocus="" name="input6" />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" tabindex="4">Verify
                                        OTP</button>
                                </form>

                                <p class="text-center mt-2">
                                    <span>Didn’t get the code?</span><a
                                        href="Javascript:void(0)"><span>&nbsp;Resend</span></a>
                                    <span>or</span>
                                    <a href="Javascript:void(0)"><span>&nbsp;Call Us</span></a>
                                </p>
                            </div>
                        </div>
                        <!-- /two steps verification basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/auth-two-steps.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
