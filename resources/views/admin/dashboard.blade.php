@extends('layouts/admin')
@section('add_css')
@endsection
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header">{{ $page_title }} </small></h1>
        <!-- end page-header -->

        <div class="row">
            <div class="col-4">
                <a class="card text-center shadow" href="{{route("admin.orders")}}" style="cursor: pointer;">
                    <div class="card-header bg-info">
                        <h5 class="card-title font-weight-bold text-white">All Orders</h5>
                    </div>
                    <div class="card-body">
                        <h1 class="display-4">{{ count($orders)}}</h1>
                    </div>
                </a>
            </div>
            
            <div class="col-4">
                <a class="card text-center shadow" href="{{route("admin.orders")}}" style="cursor: pointer;">
                    <div class="card-header bg-info">
                        <h5 class="card-title font-weight-bold text-white">Pending Orders</h5>
                    </div>
                    <div class="card-body">
                        <h1 class="display-4">{{ count($orders->where('order_status', 'pending'))}}</h1>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a class="card text-center shadow" href="javascript:void(0)" style="cursor: pointer;">
                    <div class="card-header bg-info">
                        <h5 class="card-title font-weight-bold text-white">Finished Orders</h5>
                    </div>
                    <div class="card-body">
                        <h1 class="display-4">{{ count($orders->where('order_status', 'finished'))}}</h1>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- end #content -->

@endsection
