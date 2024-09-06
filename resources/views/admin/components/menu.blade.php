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
            <li class="nav-item {{ Route::CurrentRouteNamed('client.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.dashboard') }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='home'></i>Dashboard</span></a>
            </li>
            <li class="nav-item {{ Route::CurrentRouteNamed('client.appointments.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.appointments.index') }}?type=medical">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='clock'></i>Reminder</span></a>
            </li>
            <li class="nav-item {{ Route::CurrentRouteNamed('client.access_logs.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.access_logs.index') }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='unlock'></i>Access Logs</span></a>
            </li>
            {{-- @foreach ($menu as $item)
            @php
                $isActive = request()->route('id') == $item->id && request()->route()->getName() == 'client.sections';
            @endphp
        
            <li class="nav-item {{ $isActive ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.sections', ['id' => $item->id]) }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">{{ $item->name }}</span>
                </a>
            </li>
        @endforeach --}}
            <li class="nav-item {{ Route::CurrentRouteNamed('client.contacts.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.contacts.index') }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='phone-call'></i>Contacts</span></a>
            </li>
            <li class="nav-item {{ Route::CurrentRouteNamed('client.documents') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.documents') }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='book'></i>Legal Documents</span></a>
            </li>
            <li class="nav-item {{ Route::CurrentRouteNamed('client.settings*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('client.settings.profile') }}">
                    <span class="menu-title text-truncate" data-i18n="Dashboards">
                        <i data-feather='settings'></i>Settings</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
