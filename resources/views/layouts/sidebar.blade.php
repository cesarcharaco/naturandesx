<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 border-orange">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('img/naturandes.jpg') }}" alt="Naturandes"
           class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Naturandes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/default-150x150.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('perfil', \Auth::User()->id) }}" class="d-block" style="text-transform: uppercase;">{{\Auth::User()->usuario}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header"><h3 align="center">Menú</h3></li>
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p class="text">Home</p>
            </a>
          </li>
          @if(Auth::user()->tipo_usuario == 'Empleado' )
          <li class="nav-item">
            <a href="{{ route('ventas.index') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Ventas</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->tipo_usuario == 'Admin' )
          <li class="nav-item">
            <a href="{{ route('empleados.index') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Repartidores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('clientes.index') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Clientes</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->tipo_usuario == 'Admin' )
            <li class="nav-item">
              <a href="{{ route('reportes') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Reportes</p>
              </a>
            </li>
          @endif

          @if(Auth::user()->tipo_usuario == 'Cliente' )
            <li class="nav-item">
              <a href="{{ route('historial') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Historial</p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>