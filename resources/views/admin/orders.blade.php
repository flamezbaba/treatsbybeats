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
    </script>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header">{{ $page_title }} </small></h1>
        <!-- end page-header -->

        <div class="col-md-12">
            @include('layouts.flash')
        </div>

        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-primary mt-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Order List</h4>
                    <div class="panel-heading-btn">
                        <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- end panel-heading -->

                <!-- begin panel-body -->
                <div class="panel-body">
                    <small>
                    </small>
                    <small>
                    </small>
                    <table id="data-table-default"class="table table-striped table-bordered no-footer collapsed"
                        role="grid">
                        @php
                            $sn = 0;
                        @endphp
                        <thead>
                            <tr>
                                <th class="text-nowrap">#</th>
                                <th class="text-nowrap">Actions</th>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap">Customer</th>
                                <th class="text-nowrap">Total Amount</th>
                                <th class="text-nowrap">Order Status</th>
                                <th class="text-nowrap">Payment Status</th>
                                <th class="text-nowrap">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $r)
                                @if($r->payment_status == 1)
                                <tr class='odd gradeX' role="row" style="font-size: 16px;">
                                    @php
                                        $sn++;
                                        
                                    @endphp

                                    <td>
                                        {{ $sn }}
                                    </td>
                                    <td>

                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                style="z-index: 9999; font-size: 16px;">
                                                <a class="dropdown-item" target="_blank" href="{{ route('admin.order.view', $r->uuid) }}">View
                                                    Order</a>
                                                <a class="dropdown-item updateBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Update Status</a>

                                                <!--<a class="dropdown-item deleteBtn" href="#"-->
                                                <!--    data-all="{{ json_encode($r) }}">Delete</a>-->
                                            </div>
                                        </div>

                                    </td>

                                    <td>{{ $r->uuid }}</td>
                                    <td>{{ $r->user->fullname ?? '' }}</td>
                                    <td>$ <span class="digits">{{ $r->total_amount }}</span></td>
                                    @if ($r->order_status == 'pending')
                                        <td style="color: red;">{{$r->order_status}}</td>
                                    @else
                                        <td>{{ $r->order_status }}</td>
                                    @endif
                                    <td>{{ $r->payment_status == 0 ? 'Pending':'Confirmed' }}</td>
                                    <td>
                                        {{ $r->created_at ? date('D d M Y H:i', strtotime($r->created_at)) : '' }}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
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
@endsection
