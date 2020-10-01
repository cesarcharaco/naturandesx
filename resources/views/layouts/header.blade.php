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
      @if(status() == 'Activo')
      <li class="nav-item">
        <a href="#" class="nav-link" style="border-radius: 30px !important;" data-slide="false" role="button">
            <span class="text-success"> Activo </span>  <i class="fas fa-check-circle text-success"></i>
        </a>
      </li>
      @elseif(status() == 'Inactivo')

      <li class="nav-item">
        <a href="#" class="nav-link" style="border-radius: 30px !important;" data-slide="false" role="button">
            <span class="text-danger"> Inactivo </span>  <i class="fas fa-minus-circle text-danger"></i>
        </a>
      </li>
      @elseif(status() == 'Sin Aprobar')
      <li class="nav-item">
        <a href="#" class="nav-link" style="border-radius: 30px !important;" data-slide="false" role="button">
            <span class="text-warning"> Sin Aprobar </span>  <i class="fas fa-exclamation-circle text-warning"></i>
        </a>
      </li>
      @endif
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('img/naturandes.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{\Auth::User()->usuario}}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{\Auth::User()->email}}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('perfil', \Auth::User()->id) }}" class="dropdown-item mb-2 mt-2">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <i class="far fa-user"></i> Mi Perfil
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer mb-2 mt-2">Mi cuenta</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-slide="false" role="button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off text-danger"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->