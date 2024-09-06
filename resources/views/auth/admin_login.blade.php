@include('admin.layouts.header')

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{-- {{ dd(session('locale')) }} --}}
            <div class="content-header w-100 d-flex justify-content-end" style="float: right">
                {{-- @foreach (\App\Models\Language::get() as $language) --}}
                <?php
                // if ($language->id == 1) {
                //     $locale = 'us';
                // } elseif ($language->id == 2) {
                //     $locale = 'sa';
                // } else {
                //     $locale = 'pk';
                // }
                ?>
                {{-- <a class="dropdown-item w-auto " href="{{ route('get.language', $language->id) }}"
                    data-language="{{ $locale }}">
                    <i class="flag-icon flag-icon-{{ $locale }}"></i>
                    {{ $language->name }}
                </a>
                @endforeach --}}
                {{-- <div class="dropdown">
                    <a class="btn btn-flat-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="flag-icon flag-icon-{{ session('locale') == 'en' ? 'us' : 'sa' }}"></i>
                        <span class="selected-language">{{ session('locale') == 'en' ? 'English' : 'Arabic' }}</span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                            @foreach (\App\Models\Language::get() as $language)
                            <?php
                            // if ($language->id == 1) {
                            //     $locale = 'us';
                            // } elseif ($language->id == 2) {
                            //     $locale = 'sa';
                            // } else {
                            //     $locale = 'pk';
                            // }
                            ?>
                            <a class="dropdown-item" href="{{ route('get.language', $language->id) }}"
                                data-language="{{ $locale }}">
                                <i class="flag-icon flag-icon-{{ $locale }}"></i>
                                {{ $language->name }}
                            </a>
                            @endforeach
                        </li>
                    </ul>
                </div> --}}
            </div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html" class="brand-logo">
                                    <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}" height="180px"
                                        width="250px">
                                    {{-- <h2 class="brand-text text-primary ms-1">Auction 11</h2> --}}
                                </a>

                                <form class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    @include('flash::message')
                                    <div class="mb-1">

                                        <label for="login-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="login-email" name="email"
                                            placeholder="john@example.com" aria-describedby="login-email" tabindex="1"
                                            autofocus />
                                    </div>

                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label"
                                                for="login-password">{{ __('general.password') }}</label>
                                            <a href="auth-forgot-password-basic.html">
                                                <small>{{ __('general.forgot_password') }}</small>
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-me"
                                                tabindex="3" />
                                            <label class="form-check-label" for="remember-me">
                                                {{ __('general.remember_me') }} </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100"
                                        tabindex="4">{{ __('general.sign_in') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
