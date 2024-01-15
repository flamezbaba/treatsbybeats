<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title> {{ $page_title }} - {{ Config::get('settings.site_name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Users Satisfaction" name="description" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />

    <link href="{{ url('/') }}/assets/ui/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/css/default/style.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="{{ url('/') }}/assets/ui/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/bootstrap-calendar/css/bootstrap_calendar.css"
        rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/ui/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('/') }}/assets/ui/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    @yield('add_css')


</head>

<body>
    <!-- begin #page-loader -->
    {{-- <div id="page-loader" class="fade show"><span class="spinner"></span></div> --}}
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar-default">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <a href="" class="navbar-brand"><span class="navbar-logo"></span>
                    <b>Treats Admin</b></a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end navbar-header -->

            <!-- begin header-nav -->
            <ul class="navbar-nav navbar-right">

                <li style="margin-top: 10px">
                    {{-- <div id="google_translate_element"></div>
                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
                    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> --}}
                </li>

                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

                        <img src="{{ url('site/avatar.jpg') }}">

                        <span class="d-none d-md-inline">Admin </span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="">Account</a>
                        <div class="dropdown-divider"></div>
                        {{-- <a href="{{ route("admin.login") }}" class="dropdown-item">Log Out</a> --}}
                    </div>
                </li>
                <li>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end #header -->
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <a href="javascript:;" data-toggle="nav-profile">
                            <div class="cover with-shadow"></div>
                            <div class="image">

                            </div>
                            <div class="info">
                                <b class="caret pull-right"></b>

                            </div>
                        </a>
                    </li>
                    <li>
                        <ul class="nav nav-profile">
                            <li><a href=""><i class="fa fa-cog"></i> Account</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">

                    {{-- <li class="nav-header">ACCOUNTS</li>
                    <li><a href=""><i class="fa fa-th-large"></i> <span>Account Summary</span></a></li> --}}
                    <li><a href="{{ route('admin.dashboard') }}"><i class="far fa-id-card"></i> <span>
                                Dashboard</span></a></li>
                    <li><a href="{{ route('admin.user') }}"><i class="far fa-users"></i> <span>
                                    Customers</span></a></li>
                    <li><a href="{{ route('admin.products') }}"><i class="far fa-id-card"></i>
                            <span>Menu</span></a></li>
                    <li><a href="{{ route('admin.orders') }}"><i class="far fa-id-card"></i> <span>Orders</span></a>
                    </li>
                    <li><a href="{{ route('admin.contacts') }}"><i class="far fa-id-card"></i> <span>Contact
                                Settings</span></a></li>

                   
                    <li><a href="{{ route('admin.adverts') }}"><i class="far fa-id-card"></i> <span>Adverts</span></a>
                    </li>

                    <li><a href="{{ route('admin.login') }}"><i class="fa fa-power-off"></i> <span>Log Out</span></a>
                    </li>

                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        @yield('content')


        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url('/') }}/assets/ui/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url('/') }}/assets/ui/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url('/') }}/assets/ui/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <!--[if lt IE 9]>
        <script src="{{ url('/') }}/assets/ui/crossbrowserjs/html5shiv.js"></script>
        <script src="{{ url('/') }}/assets/ui/crossbrowserjs/respond.min.js"></script>
        <script src="{{ url('/') }}/assets/ui/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{ url('/') }}/assets/ui/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url('/') }}/assets/ui/plugins/js-cookie/js.cookie.js"></script>
    <script src="{{ url('/') }}/assets/ui/js/theme/default.min.js"></script>
    <script src="{{ url('/') }}/assets/ui/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ url('/') }}/assets/ui/plugins/DataTables/media/css/dataTables.bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="{{ url('/') }}/assets/ui/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"
        rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ url('/') }}/assets/ui/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="{{ url('/') }}/assets/ui/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/ui/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ url('/') }}/assets/ui/js/demo/table-manage-default.demo.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->


    <style type="text/css">
        table {
            color: #000;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
        }

        .mmarked::after {
            content: "*";
            color: red;
            margin-left: 3px;
        }
    </style>

    @yield('add_js')

    <script type="text/javascript">
        $.fn.digits = function() {
            return this.each(function() {

                var b = $(this).text();
                var a = new Number(b).toLocaleString();
                $(this).text(a);

                // $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            })
        };

        $(".digits").digits();
    </script>

    <script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
        });
    </script>

</body>

</html>
