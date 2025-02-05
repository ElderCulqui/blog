<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.') }}" 
               class="nav-link {{ request()->is('admin') ? 'active' : '' }}"
            >
              <i class="fas fa-home nav-icon"></i>
              <p>Inicio</p>
            </a>
          </li>
          
          <li class="nav-item has-treeview {{ request()->is('admin/posts*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}" 
                   class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}"
                >
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Todos los posts</p>
                </a>
              </li>
              <li class="nav-item">
                @if (request()->is('admin/posts/*'))
                  <a href="{{ route('admin.posts.index', '#create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear un post</p>
                  </a>
                @else
                  <a href="#" data-toggle="modal" data-target="#myModal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear un post</p>
                  </a>
                @endif
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>