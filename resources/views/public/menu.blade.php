@extends('layouts/main')
@section('add_js')
    <script>
        $("#clear-sss").on("click", function(e) {
            e.preventDefault();
            window.location.href = "{{ route('menu') }}";
        })
    </script>
@endsection
@section('content')
    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center bg-parallax"
            style="background-image:url('assets/images/banner/bnr1.jpg'); background-size:cover; background-position:center;">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>{{ ucwords($page_title) }}</h1>
                    <!-- Breadcrumb Row -->

                    <!-- Breadcrumb Row End -->
                </div>
            </div>
        </div>
        <!-- Banner End -->
        <!-- Search Section -->
        <section class="content-inner-1">
            <div class="container">
                <div class="row search-wraper text-center">
                    <div class="col-lg-8 m-auto">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ $request->search }}"
                                    placeholder="Search....">
                                <div class="input-group-addon">
                                    <button type="button" class="btn btn-warning btn-hover-2" id="clear-sss">
                                        <span>Clear</span><i class="icon-cross">clear</i>
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-hover-2">
                                        <span>Search</span><i class="icon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-9">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="title mb-md-3 mb-lg-4 m-b20 d-none d-lg-block">Search Results</h5>
                        </div>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <div class="open-order-modal dz-shop-card style-1" data-product="{{ json_encode($product) }}">
                                    <div class="dz-media">
                                        <img src="{{ $product->image_url }}" alt="">
                                    </div>
                                    <div class="dz-content">
                                        <div class="dz-head">
                                            <h6 class="dz-name mb-0">
                                                <div class="product-card" data-product="{{ json_encode($product) }}">
                                                    <a href="javascript:void(0);"
                                                        class="open-modal">{{ $product->name }}</a>
                                                </div>
                                            </h6>
                                            {{-- <div class="rate">
                                            <i class="fa-solid fa-star"></i> 4.5
                                        </div> --}}
                                        </div>
                                        <div class="dz-body">
                                            <ul class="dz-meta">
                                                <li>{{ $product->description }}</li>
                                            </ul>
                                            <p class="mb-0"><span
                                                    class="text-primary font-weight-500">${{ $product->price }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="dz-shop-card style-1">

                                <div class="dz-content">
                                    <div class="dz-head">
                                        <h6 class="dz-name mb-0">
                                            No Products Found
                                        </h6>
                                    </div>
                                    <div class="dz-body">

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <div class="scroltop-progress scroltop-primary">
            <svg width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </div>
@endsection
