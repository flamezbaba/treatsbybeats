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
                $(".updateModal .modal-title").text("Update Record: " + d.product_name);
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
                    <h4 class="panel-title"></h4>
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
                                {{-- <th class="text-nowrap">Actions</th> --}}
                                <th class="text-nowrap">Fullname</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $r)
                                <tr class='odd gradeX' role="row">
                                    @php
                                        $sn++;
                                        
                                    @endphp

                                    <td>
                                        {{ $sn }}
                                    </td>
                                    {{-- <td>

                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                style="z-index: 9999;">
                                                <a class="dropdown-item" href="{{ route('admin.order.view', $r->uuid) }}">View
                                                    Order</a>
                                                <a class="dropdown-item updateBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Toggle Delivered</a>

                                                <a class="dropdown-item deleteBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Delete</a>
                                            </div>
                                        </div>

                                    </td> --}}

                                    <td>{{ $r->fullname }}</td>
                                    <td>{{ $r->email }}</td>
                                    <td>{{ $r->mobile }}</td>

                                </tr>
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
                    <h4 class="modal-title">Delete Record</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        Are you sure?
                        <input type="hidden" name="id" value="">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="delivered">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade viewModal" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        Are you sure?
                        <input type="hidden" name="id" value="">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="delivered">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
