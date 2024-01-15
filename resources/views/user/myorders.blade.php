@extends('layouts.main')

@section('content')
    <div class="page-content bg-white">
        <div class="dz-bnr-inr style-1 text-center bg-parallax tpbr">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>{{ ucwords($page_title) }}</h1>
                </div>
            </div>
        </div>

        <!-- Wishlist Section -->
        <section class="content-inner-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12s">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Amount</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->orders as $r)
                                        <tr>
                                            <td class="product-item-name">{{ $r->uuid }}</td>
                                            <td class="product-item-price">$ <span
                                                    class="digits">{{ $r->total_amount }}</span></td>
                                            @if ($r->order_status == 'pending')
                                                <td style="color: red;">{{ $r->order_status }}</td>
                                            @else
                                                <td style="color: green;">{{ $r->order_status}}</td>
                                            @endif
                                            <td class="product-item-name">{{ $r->payment_status == 0 ? 'Pending':'Confirmed' }}</td>
                                            <td class="">
                                                <a href="{{ route("user.checkout", $r->uuid) }}">View Order</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Wishlist Section -->

    </div>
@endsection
