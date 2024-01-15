@extends('layouts/admin')
@section('add_css')
@endsection

@section('add_js')
    <script type="text/javascript">
        $("* .deleteBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".deleteModal [name='c_id']").val(d.id);
                $(".deleteModal .modal-title").text("Delete Record: " + d.uuid);

                $(".deleteModal").modal('show');
            } catch (err) {
                alert(err);
            }
        });

        $("* .tggleConBtn").on("click", function(e) {
            e.preventDefault();
            try {
                var d = $(this).data('all');

                $(".tggleConModal [name='c_id']").val(d.id);
                if (d.is_confirmed == 0) {
                    $(".tggleConModal .modal-title").text("Confirm Deposit: " + d.uuid);
                } else {
                    $(".tggleConModal .modal-title").text("Un-Confirm Deposit: " + d.uuid);
                }

                $(".tggleConModal").modal('show');
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

        <!-- begin panel -->
        <div class="panel panel-primary">
            <!-- begin panel-heading -->

            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <small>
                </small>
                <small>
                </small>
                @include('layouts.flash')

                <table id="data-table-default"class="table table-striped table-bordered no-footer collapsed" role="grid">
                    @php
                        $sn = 0;
                    @endphp
                    <thead>
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">Actions</th>
                            <th class="text-nowrap">UUID</th>
                            <th class="text-nowrap">User</th>
                            <th class="text-nowrap">Amount</th>
                            <th class="text-nowrap">Method</th>
                            <th class="text-nowrap">Address</th>
                            <th class="text-nowrap">Receipt</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $r)
                            <tr class='odd gradeX' role="row">
                                @php
                                    $sn++;
                                @endphp

                                <td>
                                    {{ $sn }}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-xs deleteBtn mb-1"
                                        data-all="{{ json_encode($r) }}">Delete</button>
                                    <button class="btn btn-danger btn-xs tggleConBtn mb-1"
                                        data-all="{{ json_encode($r) }}">Toggle Confirm</button>
                                </td>
                                <td style="text-transform: uppercase;">{{ $r->uuid }}</td>
                                <td>{{ $r->user->fullname ?? '' }}</td>
                                <td>${{ $r->amount }}</td>
                                <td>{{ $r->method }}</td>
                                <td>{{ $r->address }}</td>
                                <td>
                                    @if ($r->receipt_link())
                                        <a href="{{ $r->receipt_link() }}" target="_blank">View Receipt</a>
                                    @endif

                                </td>
                                @if ($r->is_confirmed == 0)
                                    <td style="color: red;">Pending</td>
                                @else
                                    <td style="color: green;">Confirmed</td>
                                @endif
                                <td>{{ $r->created_at ? date('d M y h:i', strtotime($r->created_at)) : '' }}</td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->

    </div>
    <!-- end #content -->

    <!-- #modal-dialog -->
    <div class="modal fade deleteModal" id="modal-dialog">
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
                        <button type="submit" class="btn btn-primary" name="delete">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade tggleConModal" id="modal-dialog">
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
                        <button type="submit" class="btn btn-primary" name="toggle_confirm">Yes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
