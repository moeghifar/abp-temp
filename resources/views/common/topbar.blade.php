<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!--<a href="index.html" class="logo"><span>Up</span>Bond</a>-->
            <!--<a href="index.html" class="logo-sm"><span>U</span></a>-->
            {{-- <a href="index.html" class="logo"><img src="/assets/images/logo.png" height="20" alt="logo"></a>
            <a href="index.html" class="logo-sm"><img src="/assets/images/logo_sm.png" height="30" alt="logo"></a> --}}
            <a href="/home" class="logo">ABP Accounting</a>
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <img src="/assets/images/users/avatar1.jpg" alt="user-img" class="img-circle">
                            <span class="profile-username">
                                @yield('user_name') <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"> Setting</a></li>
                            <li><a href="/"> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->
