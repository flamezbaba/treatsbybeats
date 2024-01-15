@extends('layouts.main')
@section('add_js')
@endsection
@section('content')
    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center bg-parallax tpbr">
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
                <div class="row">
                    <div class="col-md-12">
                        <p>@include('layouts.flash')</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="widget">
                            <h4 class="widget-title">Your Order</h4>
                            <p class="">Order ID: {{ $order->uuid }}</p>
                            <table class="table-bordered check-tbl">
                                <thead class="text-left">
                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $p)
                                        <tr>
                                            <td class="product-item-img"><img src="{{ $p['image_url'] }}" alt="">
                                            </td>
                                            <td class="product-item-name"> <span class="">{{ $p['name'] }}</span>
                                            </td>
                                            <td class="product-price"> $ <span class="digits">{{ $p['total_price'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="product-item-img"></td>
                                        <td class="product-item-name">Total</td>
                                        <td class="product-price">
                                            $ <span class="digits">{{ $order->total_amount }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-5">
                                @if ($order->payment_status == 0)
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit" name="checkout"
                                            class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1 submit-order-btn"><span>Pay
                                                Now
                                                <i class="fa-solid fa-credit-card"></i></span></button>
                                    </form>
                                @else
                                    
                                    <button
                                        class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1 submit-order-btn"><span><i
                                                class="fa-solid fa-check"></i> Payment
                                            Successful
                                        </span></button>
                                        
                                    @if($order->refund == 0)
                                        <button id="ssm"
                                            class="btn btn-danger d-block text-center btn-md w-100 btn-hover-1 submit-order-btn mt-2"><span>Request
                                                Refund
                                                <i class="fa-solid fa-credit-card"></i></span></button>
                                    @endif

                                    <!--<form action="" class="mt-2" method="POST" onSubmit="return confirm('Are you sure ?')">-->
                                    <!--    @csrf-->
                                    <!--    <button type="submit" name="refund"-->
                                    <!--        class="btn btn-danger d-block text-center btn-md w-100 btn-hover-1 submit-order-btn"><span>Request-->
                                    <!--            Refund-->
                                    <!--            <i class="fa-solid fa-credit-card"></i></span></button>-->
                                    <!--</form>-->
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- cart Section -->

    </div>
    
    <div class="modal modal-detail fade" id="refund-modal" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group m-b15">
                            <label class="form-label">Note</label>
                            <div class="input-group">
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group m-b15">
                            <label class="form-label">Image</label>
                            <div class="input-group">
                                <input name="receipt" type="file" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="form-group m-b15">
                            <button type="submit" name="refund"
                                            class="btn btn-danger d-block text-center btn-md w-100 btn-hover-1 submit-order-btn">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
