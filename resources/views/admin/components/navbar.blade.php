<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-language">
                    <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{-- <i class="flag-icon flag-icon-{{ session('locale') == 'en' ? 'us' : 'sa' }}"></i>
                        <span class="selected-language">{{ session('locale') == 'en' ? 'English' : 'عربي' }}</span> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                        {{-- @foreach (\App\Models\Language::get() as $language)
                            <a class="dropdown-item" href="{{ route('get.language', $language->id) }}"
                                data-language="{{ $language->id == 1 ? 'us' : 'ar' }}">
                                <i class="flag-icon flag-icon-{{ $language->id == 1 ? 'us' : 'sa' }}"></i>
                                {{ $language->name }}
                            </a>
                        @endforeach --}}
                    </div>
                </li>
                @if (auth()->user()->role_id == 2)
                    <li class="nav-item d-none d-lg-block"><a class="nav-link"> <img
                                src="{{ asset('app-assets/dummy_qr_code.png') }}" style="width: 60px; height:60px"></a>
                    </li>
                @endif
                <li class="nav-item d-none d-lg-block"><a class="nav-link"
                        href="{{ auth()->user()->role_id === \App\Helpers\Constant::USER_ROLE_ID ? route('client.chat') : route('admin.chat') }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon"
                            data-feather="message-square"></i></a></li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @php
                            try {
                                $profileImageUrl = auth()->check() ? auth()->user()->profile_image_url : null;
                                $imageSrc = $profileImageUrl ? asset($profileImageUrl) : asset('app-assets/med.jpeg');
                            } catch (\Exception $e) {
                                $imageSrc = asset('app-assets/med.jpeg');
                            }
                        @endphp
                        <div class="user-nav d-sm-flex d-none"><span
                                class="user-name fw-bolder">{{ auth()->check() ? auth()->user()->name : null }}</span><span
                                class="user-status">{{ auth()->check() && auth()->user()->role_id === \App\Helpers\Constant::ADMIN_ROLE_ID ? 'Admin' : 'User' }}</span>
                        </div><span class="avatar"><img class="round" src="{{ $imageSrc }}" alt="Avatar"
                                height="40" width="40"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a
                            class="dropdown-item"
                            href="{{ auth()->check() && auth()->user()->role_id === \App\Helpers\Constant::ADMIN_ROLE_ID ? route('admin.settings.index') : route('client.settings.profile') }}"><i
                                class="me-50" data-feather="user"></i> {{ __('general.profile') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="me-50"
                                data-feather="power"></i> {{ __('general.logout') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between"><a
                class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="me-75"
                        data-feather="alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
    <!-- END: Header-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
