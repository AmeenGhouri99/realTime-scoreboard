<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mx-auto ">
                <a class="navbar-brand d-flex flex-column justify-content-center" href="{{ route('client.dashboard') }}">
                    <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}" alt="Med Legal Safe Keep"
                        class="rounded-circle " style="width: 130px; height: 80px;">
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>

    <div class="main-menu-content mt-3">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!--DashBoard Menu START-->
            <li class=" nav-item {{ Route::CurrentRouteNamed('admin.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">{{ __('general.Dashboard') }}</span></a>
            </li>
            {{-- <li class=" nav-item {{(Route::CurrentRouteNamed('admin.live-bidding')) ? 'active' : ''}}">
                <a class="d-flex align-items-center" href="{{route('admin.live-bidding')}}">
                    <i data-feather="heart"></i><span class="menu-title text-truncate" data-i18n="Live Bidding">{{
                        __('general.Live Bidding')}}</span></a>
            </li> --}}
            <!--DashBoard Menu END-->

            <!--Roles Menu START-->
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="tool">
                    </i><span class="menu-title text-truncate" data-i18n="Menu Levels">Roles (Under
                        Development)</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{route('admin.roles.index')}}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Second Level">View All</span></a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{route('admin.roles.create')}}"><i
                                data-feather="plus"></i>
                            <span class="menu-item text-truncate" data-i18n="Second Level">New Role</span></a>
                    </li>
                </ul>
            </li> --}}
            <!--Roles Menu END-->

            <!--Orders Menu END-->
            <li class="nav-item {{ Route::CurrentRouteNamed('admin.users*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.users.index') }}">
                    <i data-feather="users"></i><span class="menu-item text-truncate"
                        data-i18n="Users">{{ __('general.Users') }}</span></a>
            </li>

            <li class="nav-item {{ Route::CurrentRouteNamed('admin.settings*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.settings.index') }}">
                    <i data-feather="settings"></i><span class="menu-item text-truncate"
                        data-i18n="eCommerce">{{ __('general.Settings') }}</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
