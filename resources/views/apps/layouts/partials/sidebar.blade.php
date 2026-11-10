<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('app.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ versioned_asset('assets/logo/logo-color-2.svg') }}" alt="" height="35">
            </span>
            <span class="logo-lg">
                <img src="{{ versioned_asset('assets/logo/logo-color-2.svg') }}" alt="" height="35">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('app.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ versioned_asset('assets/logo/logo-color-2.svg') }}" alt="" height="35">
            </span>
            <span class="logo-lg">
                <img src="{{ versioned_asset('assets/logo/logo-color-2.svg') }}" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-main-menu">Main Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('app.dashboard') ? 'active' : '' }}"
                        href="{{ route('app.dashboard') }}">
                        <i data-feather="home" class="icon-dual"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
