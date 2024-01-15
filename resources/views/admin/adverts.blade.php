@extends('layouts.admin')
@section('add_js')
    <script type="text/javascript">
        $("* .deleteBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".deleteModal [name='c_id']").val(d.id);
                $(".deleteModal .modal-title").text("Delete Record: " + d.title);

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
                $(".editModal [name='title']").val(d.title);
                $(".editModal [name='position']").val(d.position);
                $(".editModal [name='url']").val(d.url);
                $(".editModal .modal-title").text("Edit Record: " + d.title);

                $(".editModal").modal('show');
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
            {{-- <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-primary">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Add an Advert</h4>
                        <div class="panel-heading-btn">
                            <button class="btn btn-xs btn-icon btn-default" data-click="panel-collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-body">
                                <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Advert Title</label>
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>First Position</label>
                                                        <select name="position" id="" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Goto Link</label>
                                                    <input type="url" name="url" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"
                                                    name="create_ads">Create</button>
                                            </div>
                                        </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->

            </div> --}}
        </div>

        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-primary mt-5">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List</h4>
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
                                <th class="text-nowrap">Title</th>
                                <th class="text-nowrap">Link</th>
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap">Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adverts as $r)
                                <tr class='odd gradeX' role="row">
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
                                                style="z-index: 9999;">
                                                <a class="dropdown-item editBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Edit Ads</a>

                                                {{-- <a class="dropdown-item deleteBtn" href="#"
                                                    data-all="{{ json_encode($r) }}">Delete</a> --}}
                                            </div>
                                        </div>

                                    </td>

                                    <td>{{ $r->title }}</td>
                                    <td>{{ $r->url }}</td>
                                    <td class="">
                                        <a href="{{ $r->image_url }}" target="_blank">
                                            <img src="{{ $r->image_url }}" alt="" width="70">
                                        </a>
                                    </td>
                                    <td>{{ $r->position }}</td>
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
                        <button type="submit" class="btn btn-primary" name="delete_ads">Yes</button>
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
                            <label for="">Title</label>
                            <input type="text" name="title" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <input type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <label for="">Goto Link</label>
                            <input type="url" name="url" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Third Position</label>
                            <select name="position" id="" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" name="edit_ads">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
