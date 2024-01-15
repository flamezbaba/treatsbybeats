@extends('layouts/admin')
@section('add_css')
@endsection

@section('add_js')
    <script type="text/javascript">
        $("* .updateBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".updateModal [name='id']").val(d.id);
                $(".updateModal [name='order_status']").val(d.order_status);
                $(".updateModal .modal-title").text("Update Order Status: " + d.uuid);
                $(".updateModal").modal('show');
            } catch (err) {
                alert(err);
            }
        });
        
         $("* .verBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".verModal [name='id']").val(d.id);
                $(".verModal").modal('show');
            } catch (err) {
                alert(err);
            }
        });
    </script>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header">{{ strtoupper($page_title) }} </small></h1>
        <!-- end page-header -->

        <div class="row">
            <div class="col-md-12">
                @include('layouts.flash')
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="z-index: 9999;">
                         <a class="dropdown-item updateBtn" href="#"
                                                    data-all="{{ json_encode($order) }}">Update Order Status</a>



                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="panel panel-inverse panel-collapse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Customer Info</h4>
                        <div class="panel-heading-btn">
                            <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" style="color: #000; font-size: 14px;">
                        <p class="">
                            Customer: {{ $order->user->fullname ?? '' }}
                            <br />
                            <br />
                            Email: {{ $order->user->email ?? '' }}
                            <br />
                            <br />
                            Phone: {{ $order->user->mobile ?? '' }}
                            <br />
                            <br />
                            Order Status: {{ $order->order_status }}
                            <br />
                            

                        </p>

                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-inverse panel-collapse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Online Payments</h4>
                        <div class="panel-heading-btn">
                            <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" style="color: #000; font-size: 14px;">
                        <table class="table table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th>Verify</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->payments as $p)
                                    <tr>
                                        <td class="">
                                            <button class="btn btn-primary verBtn" href="#"
                                                    data-all="{{ json_encode(['id' => $p->id]) }}">Re-Verify</button>
                                        </td>
                                        <td class=""> <span class="digits">{{ $p->amount }}</span>
                                        </td>
                                        <td class=""> <span class="">{{ $p->is_confirmed == 0 ? 'Pending':'Confirmed' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-inverse panel-collapse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Products</h4>
                        <div class="panel-heading-btn">
                            <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="panel-body table-responsive" style="color: #000; font-size: 14px;">
                        <table class="table table-bordered">
                            <thead class="text-left">
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $p)
                                    <tr>
                                        <td class=""><img width="70" src="{{ $p['image_url'] }}" alt="">
                                        </td>
                                        <td class=""> <span class="">{{ $p['name'] }}</span>
                                        </td>
                                        <td class=""> <span class="">{{ $p['qty'] }}</span>
                                        </td>
                                        <td class=""> $ <span class="digits">{{ $p['price'] }}</span>
                                        </td>
                                        <td class=""> $ <span class="digits">{{ $p['total_price'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class="product-item-name">Total</td>
                                    <td class="product-price">
                                        $ <span class="digits">{{ $order->total_amount }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end #content -->

    <!-- #modal-dialog -->
    <div class="modal fade updateModal" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                       <div class="form-group">
                            <label for="">Status</label>
                            <select name="order_status" class="form-control">
                                <option value="pending">pending</option>
                                <option value="cooking">cooking</option>
                                <option value="ready">ready</option>
                                <option value="completed">completed</option>
                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary" name="update_status">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade verModal" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Verify Payment</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                       <div class="form-group">
                           Are you sure?
                        </div>
                       
                        <button type="submit" class="btn btn-primary" name="verify_payment">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
