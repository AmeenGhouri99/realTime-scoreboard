{{-- <!-- User Pills -->
<ul class="nav nav-pills nav-pill-sm mb-2">
    <li class="nav-item">
        <a class="nav-link {{ Route::CurrentRouteNamed('admin.users.show') ? 'active' : null}}" href="{{route('admin.users.show',$user->id)}}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold" style="font-size: 10px">Emergency Contact Information</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="app-user-view-security.html">
            <i data-feather="lock" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Security</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="app-user-view-billing.html">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Billing & Plans</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="app-user-view-notifications.html">
            <i data-feather="bell" class="font-medium-3 me-50"></i><span class="fw-bold">Notifications</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="app-user-view-connections.html">
            <i data-feather="link" class="font-medium-3 me-50"></i><span class="fw-bold">Connections</span>
        </a>
    </li>
</ul>
<!--/ User Pills --> --}}