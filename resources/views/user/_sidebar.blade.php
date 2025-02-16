<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{ url('user/dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif ">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/orders') }}" class="nav-link @if (Request::segment(2) == 'orders') active @endif">Orders</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/edit-profile') }}" class="nav-link @if (Request::segment(2) == 'edit-profile') active @endif">Edit Profile</a>
        </li>
        <li class="nav-item">
            @php
                $notificacionsCount = App\Models\NotificationModel::getUnReadNotificationsCount(Auth::user()->id);
            @endphp

            <a href="{{ url('user/notifications') }}" class="nav-link @if (Request::segment(2) == 'notifications') active @endif">Notifications ({{ $notificacionsCount }})</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/change-password') }}" class="nav-link @if (Request::segment(2) == 'change-password') active @endif">Change Password</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link ">Sign Out</a>
        </li>
    </ul>
</aside>