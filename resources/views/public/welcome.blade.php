@extends('layouts/main')

@section('add_js')
@endsection
@section('content')
    <div class="page-content bg-white">
        <!-- Banner -->
        <div class="main-bnr-two">
            <div class="main-slider-2">
                <div class="banner-inner">
                    <div class="primary-box"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-7 col-md-7">
                                <div class="banner-content">
                                    <p class="title wow fadeInUp text-primary" data-wow-delay="0.2s" style="font-size: 4rem; line-height: 1">
                                        <span class="" style="font-weight: bold;">Food has a new name </span><span class="" style="font-weight: bold;">"BEATS</span>
                                    </p>
                                    <p class="wow fadeInUp" data-wow-delay="0.4s">
                                        At BEATS we've mastered the
                                        art of crafting mouthwatering small bites that packs big flavors. Our journey began
                                        with a simple idea: to elevate the enjoyment of every gathering, from casual
                                        get-togethers to elegant soirées.

                                    </p>

                                    <div class="banner-btn d-flex align-items-center wow fadeInUp" data-wow-delay="0.6s">
                                            <a href="{{ route('menu') }}"
                                                class="btn btn-primary btn-md shadow-primary m-r30 btn-hover-3"><span
                                                    class="btn-text" data-text="Pick Up">Pick Up</span></a>
                                            <a href="" class="btn btn-outline-primary btn-md shadow-primary btn-hover-3" id="ddm"><span
                                                    class="btn-text" data-text="Delivery">Delivery</span></a>

                                    </div>
                                </div>
                                <div class="main-thumb2-area">
                                    <a href="{{ route('menu') }}" class="food-card wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon">
                                            <i class="flaticon-juice"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('menu') }}" class="food-card wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="icon">
                                            <i class="flaticon-hamburger"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('menu') }}" class="food-card wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon">
                                            <i class="flaticon-pizza"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('menu') }}" class="food-card wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="icon">
                                            <i class="flaticon-cake-slice"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('menu') }}" class="food-card wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon">
                                            <i class="flaticon-room-service"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5">
                                <div class="banner-media">
                                    <img src="{{ url('/') }}/assets/images/main-slider/slider3/bg.png" class="item-bg"
                                        alt="" style="opacity: 0.98" />
                                    <div class="item-media wow fadeInRight dz-move-down" data-wow-delay="1s"
                                        data-speed-x="-2" data-speed-scale="-1" style="bottom: 220px;">
                                        <img src="{{ url('/') }}/assets/images/main-slider/slider3/offer.png"
                                            class="offer dz-move" alt="" />

                                        <img src="{{ url('/assets') }}/meal.png" class="img2" alt="/" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="primary-box style-1"></div>
                </div>
            </div>
        </div>
        <!--Banner-->

        <style>
            .impd {
                border-radius: 13px;
            }

            .impd:hover {
                transform: scale(1.1);
                transition: all 1s ease;
            }
        </style>

        <!-- Advertisement Box -->
        <section class="content-inner overflow-hidden pb-0">
            <div class="container">
                <div class="row" style="padding-bottom: 50px;">
                    @foreach ($ads as $a)
                        <div class="col-md-4 m-b30 wow fadeInUp" data-wow-delay="0.2s">
                            @if ($a->url)
                                <a href="{{ $a->url }}">
                                @else
                                    <a href="{{ route('menu') }}">
                            @endif
                            <img src="{{ $a->image_url }}" class="impd" />
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
        <!-- Advertisement Box -->

        <!-- Are Menu-->
        <section class="content-inner p-b40" style="background-color: rgba(125,166,64,.1); padding-bottom: 100px;">
            <div class="container inner-section-wrapper">
                <div class="section-head text-center">
                    <h2 class="title wow flipInX" data-wow-delay="0.2s">
                        From Our Menu
                    </h2>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-lg-9 col-md-12 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="site-filters style-1 clearfix">
                            <ul class="filters" data-bs-toggle="buttons">
                                <li data-filter=".All" class="btn active">
                                    <a href="javascript:void(0);"><i class="flaticon-room-service"></i>ALL</a>
                                </li>
                                <li data-filter=".drink" class="btn">
                                    <a href="javascript:void(0);"><i class="flaticon-room-service"></i>COLD DRINK</a>
                                </li>
                                <li data-filter=".pizza" class="btn">
                                    <a href="javascript:void(0);"><i class="flaticon-room-service"></i>PIZZA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-12 text-lg-end d-lg-block d-none wow fadeInUp"
                        data-wow-delay="0.4s">
                        <a href="our-menu-1.html" class="btn btn-outline-primary btn-hover-3"><span class="btn-text"
                                data-text="View All">View All</span></a>
                    </div>
                </div>
                <div class="clearfix">
                    <ul id="masonry" class="row dlab-gallery-listing gallery">
                        @foreach ($products as $product)
                            <li class="open-order-modal card-container col-md-3 m-b30 All drink pizza burger wow fadeInUp"
                                data-product="{{ json_encode($product) }}" data-wow-delay="0.2s">
                                <div class="dz-img-box style-7">
                                    <div class="dz-media" style="height: 280px;">
                                        <img src="{{ $product->image_url }}" alt="/" />
                                        {{-- <div class="dz-meta">
                                            <ul>
                                                <li class="seller">Top Seller</li>

                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="dz-content">
                                        <h5 class="title">
                                            <a href="javascript::;">{{ $product->name }}</a>
                                        </h5>
                                        <p>
                                            {{ $product->description }}
                                        </p>
                                        <span class="price">${{ $product->price }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </section>
        <!-- Are Menu-->

        <!-- Service Section -->
        <section class="section-wrapper-4 content-inner overflow-hidden bg-parallax"
            style="
            background-image: url('assets/images/background/pic10.png');
            background-attachment: fixed; margin-top: 100px; margin-bottom: 100px;
          ">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title wow flipInX" data-wow-delay="0.2s">
                        Why Choose Us ?
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-bx-wraper style-4">
                            <div class="icon-bx">
                                <div class="icon-cell">
                                    <i class="flaticon-fast-delivery"></i>
                                </div>
                            </div>
                            <div class="icon-content">
                                <p>24/7 Free Delivery</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-bx-wraper style-4">
                            <div class="icon-bx">
                                <div class="icon-cell">
                                    <i class="flaticon-clock-1"></i>
                                </div>
                            </div>
                            <div class="icon-content">
                                <p>Our Restaurant is Open Around the Clock</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-bx-wraper style-4">
                            <div class="icon-bx">
                                <div class="icon-cell">
                                    <i class="flaticon-chef"></i>
                                </div>
                            </div>
                            <div class="icon-content">
                                <p>Best Chef</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="icon-bx-wraper style-4">
                            <div class="icon-bx">
                                <div class="icon-cell">
                                    <i class="flaticon-cuisine"></i>
                                </div>
                            </div>
                            <div class="icon-content">
                                <p>We Have The Freshest Product</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Service Section -->



        {{-- modal --}}
        <div class="modal modal-detail fade" id="delivery-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 300px!important;">
            <div class="modal-content">
                <div class="modal-body pxxp">
                    <div class="detail-info">
                        <center>
                        <a href="https://www.doordash.com/store/beats-(carnegie-avenue)-cleveland-26201187/?event_type=autocomplete&pickup=false" target="_blank" class="w-100">
                             <img class="" src="{{ url('/') }}/s3/doordash.png" alt="" width="100"  />
                        </a>
                        </center>
                        <p class="" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">OR</p>
                        <center>
                        <a href="" target="_blank" class="w-100">
                            <img class="" src="{{ url('/') }}/s3/uber.png" alt="" width="100"  />
                        </a>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
