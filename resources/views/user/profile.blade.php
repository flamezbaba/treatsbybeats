@extends('layouts.main')

@section('content')
    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center bg-parallax"
            style="background-image:url('assets/images/banner/bnr3.jpg'); background-size:cover; background-position:center;">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>{{ $page_title }}</h1>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Cart Section -->
        <section class="content-inner">
            <div class="container">
                <div class="col-md-12">
                    @include('layouts.flash')
                </div>
                <form class="shop-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget">
                                <h4 class="widget-title">Personal Details</h4>

                                <div class="form-group m-b20">
                                    <input name="fullname" value="{{ $user->fullname ?? '' }}" required type="text"
                                        class="form-control" placeholder="Company Name">
                                </div>
                                <div class="form-group m-b20">
                                    <input name="email" value="{{ $user->email ?? '' }}" required type="text"
                                        class="form-control" placeholder="Address">
                                </div>
                                <div class="form-group m-b20">
                                    <input name="phone" value="{{ $user->mobile ?? '' }}" required type="text"
                                        class="form-control dz-number" placeholder="Phone">
                                </div>


                                <button class="btn btn-gray mb-3" type="submit" name="update">Submit</button>

                            </div>
                        </div>
                        
                    </div>
                </form>
                <div class="dz-divider bg-gray-dark icon-center my-5">
                    <i class="fa fa-circle bg-white text-primary"></i>
                </div>

            </div>
        </section>
        <!-- cart Section -->

    </div>
@endsection
