<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('img/favicon.png') }}" alt="logo" width="150px"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ route('home') }}"><i class="ti-dashboard"></i> <span>Home</span></a></li>
                    @if(Auth::user()->tipo_usuario == 'Empleado' )
                        <li>
                            <a href="{{ route('ventas.index') }}"><i class="ti-money"></i> <span>Ventas</span></a></li>
                    @endif
                    @if(Auth::user()->tipo_usuario == 'Admin' )
                        <!-- <li>
                            <a href="#"><i class="ti-user"></i> <span>Usuarios</span></a>
                        </li> -->
                        <li>
                            <a href="{{ route('empleados.index') }}"><i class="ti-truck"></i> <span>Repartidores</span></a>
                        </li>
                    @endif
                    @if(Auth::user()->tipo_usuario != 'Cliente' )
                        <li>
                            <a href="{{ route('clientes.index') }}"><i class="ti-receipt"></i> <span>Clientes</span></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->