@extends('layouts/admin')
@section('add_css')
@endsection

@section('add_js')
    <script type="text/javascript">
        $("* .updateBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".updateModal [name='c_id']").val(d.id);
                $(".updateModal [name='email']").val(d.email);
                $(".updateModal [name='mobile1']").val(d.mobile_1);
                $(".updateModal [name='mobile2']").val(d.mobile_2);
                $(".updateModal [name='address']").val(d.address);
                $(".updateModal .modal-title").text("Update Record");

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
                    <h4 class="panel-title">Ordes List</h4>
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
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">First Mobile</th>
                                <th class="text-nowrap">Second Moobile</th>
                                <th class="text-nowrap">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $r)
                                <tr class='odd gradeX' role="row">
                                    @php
                                        $sn++;

                                    @endphp

                                    <td>
                                       {{ $sn}}
                                    </td>
                                    <td>

                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                style="z-index: 9999;">
                                                <a class="dropdown-item updateBtn" href="#"
                                                        data-all="{{ json_encode($r) }}">Edit</a>
                                            </div>
                                        </div>

                                    </td>
                                   
                                    <td>{{ $r->email }}</td>
                                    <td>{{ $r->mobile_1 }}</td>
                                    <td>{{ $r->mobile_2 }}</td>
                                    <td>{{ $r->address }}</td>
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
    <div class="modal fade updateModal " id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Record</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">First Mobile</label>
                            <input type="text" name="mobile1" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Second Mobile</label>
                            <input type="text" name="mobile2" value="" class="form-control">
                            <input type="hidden" name="c_id" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="" class="form-control">
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="update_contact">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
