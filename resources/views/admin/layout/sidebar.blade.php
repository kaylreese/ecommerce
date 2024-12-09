<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link" style="text-align: center;">
        <span class="brand-text">Ecommerce</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ url ('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2">
            </div>
            <div class="info">
            <a class="d-block"> {{ Auth::user()->name }} </a>
            </div>
        </div>

       {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link @if( Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/admin') }}" class="nav-link @if( Request::segment(2) == 'admin') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Admin</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ url('admin/customers') }}" class="nav-link @if( Request::segment(2) == 'customers') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/orders') }}" class="nav-link @if( Request::segment(2) == 'orders') active @endif">
                    <i class="nav-icon fas fa fa-list-alt"></i>
                    <p>Orders</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ url('admin/category') }}" class="nav-link @if( Request::segment(2) == 'category') active @endif">
                    <i class="nav-icon fas fa fa-list-alt"></i>
                    <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/subcategory') }}" class="nav-link @if( Request::segment(2) == 'subcategory') active @endif">
                    <i class="nav-icon fas fa fa-list-alt"></i>
                    <p>Sub Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/product') }}" class="nav-link @if( Request::segment(2) == 'product') active @endif">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/brand') }}" class="nav-link @if( Request::segment(2) == 'brand') active @endif">
                    <i class="nav-icon fas fa fa-columns"></i>
                    <p>Brands</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/color') }}" class="nav-link @if( Request::segment(2) == 'color') active @endif">
                    <i class="nav-icon fas fa-regular fa-cookie-bite"></i>
                    <p>Colors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/discountcode') }}" class="nav-link @if( Request::segment(2) == 'discountcode') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Discount Code</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/shippingcharge') }}" class="nav-link @if( Request::segment(2) == 'shippingcharge') active @endif">
                    <i class="nav-icon fas fa-table"></i>
                    <p>Shipping Charge</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/page') }}" class="nav-link @if( Request::segment(2) == 'page') active @endif">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/contactus') }}" class="nav-link @if( Request::segment(2) == 'contactus') active @endif">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>Contact Us</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/settings') }}" class="nav-link @if( Request::segment(2) == 'settings') active @endif">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>