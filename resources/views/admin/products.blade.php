@extends('layouts/admin')

@section('add_js')
    <script type="text/javascript">
        $("* .deleteBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".deleteModal [name='c_id']").val(d.id);
                $(".deleteModal .modal-title").text("Delete Record: " + d.fullname);

                $(".deleteModal").modal('show');
            } catch (err) {
                alert(err);
            }
        });
        $("* .editBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".editModal [name='id']").val(d.id);
                $(".editModal [name='name']").val(d.name);
                $(".editModal [name='price']").val(d.price);
                $(".editModal [name='desc']").val(d.description);
                $(".editModal [name='categories']").val(d.category);
                $(".editModal .modal-title").text("Edit Record: " + d.name);

                $(".editModal").modal('show');
            } catch (err) {
                alert(err);
            }
        });
        
         $("* .actBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".actModal [name='c_id']").val(d.id);
                if (d.is_active == 0) {
                    $(".actModal .modal-title").text("Change Status to Available");
                } else {
                    $(".actModal .modal-title").text("Change Status to Unavailable");
                }
                $(".actModal").modal('show');
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

        <div class="container-fluid">
            <div class="col-md-8">
                <!-- begin panel -->
                <div class="panel panel-primary">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Menu</h4>
                        <div class="panel-heading-btn">
                            <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Product Name</label>
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Product Price</label>
                                                        <input type="text" name="price" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Categories</label>
                                                <input type="text" name="categories" class="form-control">
                                                <p class="">Seperated By Comma</p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Poduct Description</label>
                                                <textarea type="text" name="desc" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Image</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"
                                                    name="create_product">Create</button>
                                            </div>
                                        </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->

            </div>
        </div>

        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-primary mt-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Menu List</h4>
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
                        role="grid" style="font-size: 16px;">
                        @php
                            $sn = 0;
                        @endphp
                        <thead>
                            <tr>
                                <th class="text-nowrap">#</th>
                                <th class="text-nowrap">Actions</th>
                                <th class="text-nowrap">Product Name</th>
                                <th class="text-nowrap">Product Description</th>
                                <th class="text-nowrap">Product Price</th>
                                <th class="text-nowrap">Available</th>
                                <th class="text-nowrap">Categories</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $r)
                                <tr class='odd gradeX' role="row" style="font-size: 16px;">
                                    @php
                                        $sn++;
                                        
                                    @endphp

                                    <td>
                                        <img src="{{ $r->image_url }}" width="50">
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
                                                <a class="dropdown-item editBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Edit Product</a>
                                                    
                                                 <a class="dropdown-item actBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Change Menu Status</a>

                                                <a class="dropdown-item deleteBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Delete</a>
                                            </div>
                                        </div>

                                    </td>

                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->description }}</td>
                                    <td>$<span class="digits">{{ $r->price }}</span></td>
                                    <td>{{ $r->is_active == 1 ? 'YES' : 'NO' }}</td>
                                    <td>{!! $r->category !!}</td>
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
    <div class="modal fade deleteModal " id="modal-dialog">
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
                        <input type="hidden" name="c_id" value="">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="delete_product">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade actModal" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Toggle Confirm</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        Are you sure?
                        <input type="hidden" name="c_id" value="">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="toggle_status">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade editModal " id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Record</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="text" name="price" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Categories</label>
                            <input type="text" name="categories" value="" class="form-control">
                            <p class="">Seperated By Comma</p>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea type="text" name="desc" value="" class="form-control"></textarea>
                            <input type="hidden" name="id" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" name="image" value="" class="form-control">
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary" name="edit_product">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
