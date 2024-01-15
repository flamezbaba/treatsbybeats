<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>
        Treats By Beats
    </title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="restaurant" />
    <meta name="description" content="Treats By Beats" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Treats By Beats" />
    <meta property="og:description" content="Treats By Beats" />
    <meta property="og:url" content="https://treatsbybeats.com/" />
    <meta property="og:site_name" content="Treats By Beats" />
    <meta property="og:image" content="https://treatsbybeat.com/logo.png" />
    <meta property="og:image:type" content="image/png" />



    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ url('/') }}/assets/images/favicon.png" />

    <!-- Stylesheet -->
    <link href="{{ url('/') }}/assets/vendor/animate/animate.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/vendor/magnific-popup/magnific-popup.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/vendor/tempus-dominus/css/tempus-dominus.min.css" rel="stylesheet" />

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/rangeslider/rangeslider.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/switcher/switcher.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css" />
    <link class="skin" rel="stylesheet" href="{{ url('/') }}/assets/css/skin/skin-1.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Lobster&amp;family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet" /> --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight&amp;family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet" />
    <style>
        .tpbr {
            background-image: url("{{ url('/') }}/assets/images/banner/bnr4.jpg");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body id="bg">
    <div id="loading-area" class="loading-page-3">
	<img src="{{ url('/') }}/assets/images/loading.gif" alt="">
</div>
    <div class="page-wraper">
        <!-- Header -->

        <header class="site-header mo-left header header-transparent transparent-white style-1">
            <!-- Main Header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix">
                    <div class="container clearfix">
                        <!-- Website Logo -->
                        <div class="logo-header mostion">
                            <a href="{{ route('welcome') }}" class=""><img
                                    src="{{ url('/') }}/assets/images/logo.png" alt="" /></a>
                        </div>

                        <!-- Nav Toggle Button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <!-- EXTRA NAV -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <ul>
                                    <li>
                                        @auth
                                            <a class="btn btn-white btn-square btn-shadow" href="{{ route('user.login') }}"
                                                role="button" aria-controls="offcanvasLogin">
                                                <i class="flaticon-logout">➔</i>
                                            </a>
                                        @endauth
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-white btn-square btn-shadow cart-btn">
                                            <i class="flaticon-shopping-bag-1"></i>
                                            <span class="badge">
                                                <p id="cartNumber">0</p>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu cart-list">
                                            <div class="" id="top-cart-item">

                                            </div>
                                            <li class="cart-item text-center d-flex justify-content-between">
                                                <h6 class="text-primary mb-0">Total:</h6>
                                                <h6 class="text-primary mb-0">$ <span id="ttp">0</span></h6>
                                            </li>
                                            <li class="text-center d-flex">
                                                <a href="{{ route('carts') }}"
                                                    class="btn btn-primary me-2 w-100 d-block btn-hover-1"><span>View
                                                        Cart</span></a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-outline-primary w-100 d-block btn-hover-1 clear-all-cart"><span>Clear
                                                        All</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- EXTRA NAV -->

                        <!-- Header Nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                            <div class="logo-header">
                                <a href="{{ route('welcome') }}" class=""><img
                                        src="{{ url('/') }}/assets/images/logo.png" alt="/" /></a>
                            </div>

                            @if ($page_title == 'welcome')
                                <ul class="nav navbar-nav navbar ms-lg-4">
                                @else
                                    <ul class="nav navbar-nav navbar white">
                            @endif
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li><a href="{{ route('menu') }}">Menu</a></li>
                            <li><a href="{{ route('carts') }}">Cart</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            
                            {{-- <li><a href="{{ route('contact') }}">Contact Us</a></li> --}}
                            
                            @guest
                                <li><a href="{{ route('user.login') }}">Login</a></li>
                                <li><a href="{{ route('user.register') }}">Register</a></li>
                            @endguest
                            @auth
                                <li><a href="{{ route('user.order') }}">My orders</a></li>
                                <li><a href="{{ route('user.profile') }}">Profile</a></li>
                                <li><a href="{{ route('user.login') }}">Log Out</a></li>
                            @endauth
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Header End -->
        </header>
        <!-- Header -->
        @yield('content')

        <!--Footer-->
        <footer class="site-footer style-3" id="footer">
            <div class="footer-bg-wrapper">
                <div class="container">
                    <div class="footer-top">

                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-6 text-md-start">
                                <h5 class="footer-title wow fadeInUp" data-wow-delay="0.2s">
                                    OUR LINKS
                                </h5>
                                <div class="footer-menu wow fadeInUp" data-wow-delay="0.4s">
                                    <ul>
                                        <li><a href="{{ route('welcome') }}">Home</a></li>
                                        <li><a href="{{ route('carts') }}">Cart</a></li>
                                        <li><a href="{{ route('menu') }}">Menu</a></li>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-6 text-md-end">
                                <h5 class="footer-title wow fadeInUp" data-wow-delay="0.2s">
                                    Hot Line
                                </h5>
                                <div class="footer-menu wow fadeInUp" data-wow-delay="0.4s">
                                    <ul>
                                        <li><a href="">+12162982999</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom Part -->
                <div class="container">
                    <div class="footer-bottom">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 text-md-start">
                                <p>Copyright {{ date('Y') }} All rights reserved.</p>
                            </div>
                            <div class="col-xl-6 col-md-6 text-md-end">
                                <span class="copyright-text">Designed by
                                    <a href="https://shridetech.com" target="_blank">ShrideTech</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg1 dz-move" src="{{ url('/') }}/assets/images/background/pic5.png" alt="/" />
            <img class="bg2 dz-move" src="{{ url('/') }}/assets/images/background/pic6.png" alt="/" />
        </footer>

        <div class="scroltop-progress scroltop-primary">
            <svg width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </div>

    <div class="modal modal-detail fade" id="product-modal" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body product-detail">
                    <div class="detail-media">
                        <img id="product-image" src="" alt="/">
                    </div>
                    <div class="detail-info">
                        <div class="dz-head">
                            <h4 class="title" id="product-name"></h4>
                        </div>
                        <p class="text" id="product-desc"></p>
                        <ul class="detail-list">
                            <li>Price <span class="text-primary m-t5">$<span id="product-price"></span></span></li>
                            <li>Quantity
                                <div class="btn-quantity style-1 m-t5">
                                    <input id="product-quantity" type="number" value="1" min="1"
                                        name="quantity" style="width: 100px;">
                                </div>
                            </li>
                        </ul>
                        <ul class="modal-btn-group">
                            <li>Total Price: <span class="text-primary">$ <span id="product-total"></span></span></li>
                        </ul>
                        <ul class="modal-btn-group" style="margin-top: 20px;">

                            <li><a href="javascript:void(0);"
                                    class="btn btn-primary btn-hover-1 add-to-cart"><span>Add To Cart <i
                                            class="flaticon-shopping-bag-1 m-l10"></i></span></a></li>

                            <li><a href="{{ route('carts') }}" class="btn btn-secondary btn-hover-2"><span>View
                                        Cart</span></a></li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
    <!-- JAVASCRIPT FILES ========================================= -->

    <script type="text/javascript" src="{{ url('/') }}/assets/js/jquery.min.js"></script>
    <!-- JQUERY.MIN JS -->
    <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- BOOTSTRAP.MIN JS -->
    <script src="{{ url('/') }}/assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <!-- BOOTSTRAP SELEECT -->
    <script src="{{ url('/') }}/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <!-- MAGNIFIC POPUP JS -->
    <script src="{{ url('/') }}/assets/vendor/masonry/masonry-4.2.2.js"></script>
    <!-- MASONRY -->
    <script src="{{ url('/') }}/assets/vendor/masonry/isotope.pkgd.min.js"></script>
    <!-- ISOTOPE -->
    <script src="{{ url('/') }}/assets/vendor/imagesloaded/imagesloaded.js"></script>
    <!-- IMAGESLOADED -->
    <script src="{{ url('/') }}/assets/vendor/counter/waypoints-min.js"></script>
    <!-- WAYPOINTS JS -->
    <script src="{{ url('/') }}/assets/vendor/wow/wow.js"></script>
    <!-- WOW JS -->
    <script src="{{ url('/') }}/assets/vendor/counter/counterup.min.js"></script>
    <!-- COUNTERUP JS -->
    <script src="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- OWL-CAROUSEL -->
    <script src="{{ url('/') }}/assets/vendor/popper/popper.js"></script>
    <!-- Popper -->
    <script src="{{ url('/') }}/assets/vendor/tempus-dominus/js/tempus-dominus.min.js"></script>
    <!-- Tempus Dominus -->
    <script src="{{ url('/') }}/assets/js/dz.carousel.min.js"></script>
    <!-- OWL-CAROUSEL -->
    <script src="{{ url('/') }}/assets/js/dz.ajax.js"></script>
    <!-- AJAX -->
    <script src="{{ url('/') }}/assets/js/custom.min.js"></script>
    <!-- CUSTOM JS -->
    <script src="{{ url('/') }}/assets/vendor/rangeslider/rangeslider.js"></script>
    <!-- CUSTOM JS -->

    @yield('add_js')

    <!-- Main js for cart option and more -->
    <script src="{{ url('/') }}/assets/js/main.js"></script>


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

</body>

</html>
