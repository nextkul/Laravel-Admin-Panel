<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.get.dashboard') }}" class="brand-link">
      <img src="{{ asset('admin/dist/img/nk-admin.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('settings.site.app.appname') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">⚡{{ Auth::user()->name }}⚡</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('admin.get.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/users*') ? 'menu-is-opening menu-open' : '' }}" >
            <a href="#" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Users<i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="{{ route('user.get.index') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>All User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">SINGLE PAGES</li>
          <li class="nav-item menu-open">
            <a href="{{ route('single-page') }}" class="nav-link {{ Request::is('admin/single-page') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Single Page </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>