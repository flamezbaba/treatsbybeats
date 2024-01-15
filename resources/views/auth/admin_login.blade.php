<!DOCTYPE html>
 <html lang="en" class="ie8"><head>
    <meta charset="utf-8" />
    {{-- <base href=""> --}}
    <title>Treats Admin | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Login Page" name="description" />
    <link rel="icon" type="image/png" href="{{ url('/') }}/assets/images/favicon.png" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/css/default/style.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="{{ url("/") }}/assets/ui/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url("/") }}/assets/ui/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    

</head>
<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <div class="login-cover">
        <div class="login-cover-image" style="background-image: url({{ url("/s3/plate.png") }}); background-size: contain;" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
    </div>
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b> Admin Secure
                    <small>provide correct login details</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">

                <small>
                        
                </small>
                <small>
                                    </small>
                <small>
                                    </small>

                <form method="post" action="" style="background-color: transparent;">
                    {{ csrf_field() }}
                    
                    <h4 class="nomargin">Sign In</h4> 
                    <p class="mt5 mb20">Login to access your account.</p>

                    @include("layouts/flash")
                
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" name="email" placeholder="email" value="" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" name="login" class="btn btn-danger btn-block btn-lg">Sign me in</button>
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
        
    </div>
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ url("/") }}/assets/ui/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url("/") }}/assets/ui/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url("/") }}/assets/ui/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
   
    <script src="{{ url("/") }}/assets/ui/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url("/") }}/assets/ui/plugins/js-cookie/js.cookie.js"></script>
    <script src="{{ url("/") }}/assets/ui/js/theme/default.min.js"></script>
    <script src="{{ url("/") }}/assets/ui/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ url("/") }}/assets/ui/js/demo/login-v2.demo.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            LoginV2.init();
        });
    </script>
</body>
</html>
