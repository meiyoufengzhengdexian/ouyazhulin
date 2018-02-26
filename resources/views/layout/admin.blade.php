
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>欧亚出行 | 租赁</title>

    <!-- Bootstrap -->
    <link href="{{ asset('public/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('public/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- fileinput -->
    <link href="{{ asset('public/vendors/bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet">
    {{--<script src="{{ asset('public/vendors/jquery/dist/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <link href="{{ asset('public/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ asset('public/vendors/layui/dist/css/layui.css') }}">
    @stack('addcss')
    <link href="{{ asset('public/build/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendors/pnotify/pnotify.custom.min.css') }}" rel="stylesheet"/>
    <!-- jQuery -->
    <style>
        .upload_img {
            max-height: 250px;
            border: 1px solid #ddd;
            margin: 5px;
        }
        [v-cloak] {
            display: none;
        }
    </style>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                </div>

                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ asset('public/images/img.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>管理员</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>功能列表</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-users"></i> 人员 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/user') }}">管理员列表</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-home"></i> 门店 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/store') }}">门店列表</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-car"></i> 车辆 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/car') }}">车辆列表</a></li>
                                    <li><a href="{{ url('admin/car_patt') }}">车型</a></li>
                                    <li><a href="{{ url('admin/car_patt/create') }}">添加车型</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-reorder"></i> 订单 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/order') }}">订单列表</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-archive"></i> 仓库 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/warehouse') }}">仓库列表</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-cny"></i> 价格管理 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('admin/price') }}">价格列表</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('public/images/img.jpg') }}" alt="">管理员
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('public/images/img.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('public/images/img.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('public/images/img.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{ asset('public/images/img.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('right_col')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>


<!-- Bootstrap -->
<script src="{{ asset('public/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/vendors/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('public/vendors/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('public/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('public/vendors/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('public/vendors/pnotify/pnotify.custom.min.js') }}"></script>
<!-- jQuery custom content scroller -->
<script src="{{ asset('public/vendors/layui/dist/layui.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('public/build/js/custom.js') }}"></script>
<script src="{{ asset('public/js/jquery-laravel-ajax.js') }}"></script>

<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                NProgress.configure({ minimum: 0.6 });
                NProgress.start();
            },
            complete:function(){
                NProgress.done();
            }
        });
        $('body').on('click', '.return', function(){
            window.history.go(-1);
        });
    })

</script>

@stack('addjs')
</body>
</html>