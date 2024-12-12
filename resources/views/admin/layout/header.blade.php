<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @php
            $notificacions = App\Models\NotificationModel::getUnReadNotifications();
        @endphp

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ $notificacions->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notificacions->count() }} Notifications</span>

                @foreach ($notificacions as $notification)
                    <div class="dropdown-divider"></div>
                    <a href="{{ $notification->url }}?noti_id={{ $notification->id }}" class="dropdown-item">
                        <div>{{ $notification->message }}</div>
                        <div class="text-muted text-sm">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
                    </a>
                @endforeach

                <div class="dropdown-divider"></div>
                <a href="{{ url('admin/notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>