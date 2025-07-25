<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('template_admin/img/websenja.png') }}" alt="" class="rounded" width="45px">
        </div>
        <div class="sidebar-brand-text mx-3">Web Senja </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/master-head*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.master-head') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Master Head</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.category') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Category</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/service*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.service') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Services</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/portfolio*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.portfolio') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Portfolio</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/about*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.about') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>About</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />
    <li class="nav-item {{ Request::is('admin/contact*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.contact') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Contact</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
