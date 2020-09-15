<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-md-4 col-sm-6 col-xs-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"> Dashboard</h4>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-2 clearfix">
            <ul class="notification-area pull-right">
                <a href="{{ route('mitestqr') }}">
                    <li class="btn">
                        <i class="fa fa-qrcode"></i>
                    </li>
                </a>
                <li class="settings-btn">
                    <i class="ti-settings"></i>
                </li>
            </ul>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-2 clearfix">
            <div class="user-profile pull-right">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->usuario }}</h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i>
                        {{ __('Cerrar sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->