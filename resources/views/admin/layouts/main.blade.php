@include('admin.layouts.header')
@include('admin.components.navbar')
@if (auth()->user()->role_id === \App\Helpers\Constant::ADMIN_ROLE_ID)
    @include('admin.components.admin_menu')
@else
    @include('admin.components.menu')
@endif
@yield('main-section')
@include('admin.layouts.footer')
