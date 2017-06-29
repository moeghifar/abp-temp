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
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                            <i class="ion-ios7-bell"></i> <span class="badge badge-xs badge-danger">17</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg">
                            <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                            <li class="list-group">
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <i class="fa fa-diamond text-danger noti-sm-icon"></i>
                                        <div class="noti-content">
                                            <div class="media-heading">Your order is placed</div>
                                            <p class="m-0">
                                                <small>Dummy text of the printing and typesetting industry.</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <i class="fa  fa-envelope-o text-primary noti-sm-icon"></i>
                                        <div class="noti-content">
                                            <div class="media-heading">New Message received</div>
                                            <p class="m-0">
                                                <small>You have 87 unread messages</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <i class="fa fa-fighter-jet text-warning noti-sm-icon"></i>
                                    <div class="noti-content">
                                        <div class="media-heading">Your item is shipped.</div>
                                        <p class="m-0">
                                            <small>It is a long established fact that a reader will</small>
                                        </p>
                                    </div>
                                </a>
                                <!-- last list item -->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <small class="text-primary">See all notifications</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                            <img src="/assets/images/users/avatar1.jpg" alt="user-img" class="img-circle">
                            <span class="profile-username">
                                @yield('user_name') <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"> Setting</a></li>
                            <li><a href="javascript:void(0)"> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->
