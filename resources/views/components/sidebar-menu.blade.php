<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('main') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Food gate</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('intranet') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('main') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Main</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('viewAny', App\Models\Restaurant::class)
        <li class="nav-item">
            <a class="nav-link" href="/intranet/restaurants">
                <i class="fas fa-landmark"></i>
                <span>Restaurants</span>
            </a>
        </li>
    @endcan
    @can('viewAny', App\Models\Order::class)
        <li class="nav-item">
            <a class="nav-link" href="/intranet/orders">
                <i class="fas fa-fw fa-cog"></i>
                <span>Orders</span>
            </a>
        </li>
    @endcan
    @can('viewAny', App\Models\Category::class)
        <li class="nav-item">
            <a class="nav-link" href="/intranet/categories">
                <i class="fas fa-fw fa-cog"></i>
                <span>Categories</span>
            </a>
        </li>
    @endcan
    @can('viewAny', App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link" href="/intranet/clients">
                <i class="fas fa-fw fa-cog"></i>
                <span>Clients</span>
            </a>
        </li>
    @endcan
    @can('viewAny', App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link" href="/intranet/deliverymen">
                <i class="fas fa-fw fa-cog"></i>
                <span>Delivery men</span>
            </a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
