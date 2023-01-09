@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body row">
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card card-statistics" style="height:175px;">
                <div class="card-header">
                    <h4 class="card-title">Driver Registered</h4>
                </div>
                <div class="card-body statistics-body" style="margin-top: 21px;">
                    <div class="row">
                        <div class="">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                    <div class="avatar-content">
                                        <a href="{{route('drivers.index')}}" style="color: #00cfe8 !important;"><i data-feather="user" class="avatar-icon"></i></a>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$drivers}}</h4>
                                    <p class="card-text font-small-3 mb-0">Drivers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card card-statistics" style="height:175px;">
                <div class="card-header">
                    <h4 class="card-title">Total Customers</h4>
                </div>
                <div class="card-body statistics-body" style="margin-top: 21px;">
                    <div class="row">
                        <div class="">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                    <div class="avatar-content">
                                        <a href="{{route('customers.index')}}" style="color: #00cfe8 !important;"><i data-feather="user" class="avatar-icon"></i></a>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$customers}}</h4>
                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card card-statistics" style="height:175px;">
                <div class="card-header">
                    <h4 class="card-title">Total Vehicles Registered</h4>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                    <div class="avatar-content">
                                        <a href="{{route('vehicles.index')}}" style="color: #00cfe8 !important;"><i data-feather="user" class="avatar-icon"></i></a>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$vehicles}}</h4>
                                    <p class="card-text font-small-3 mb-0">Vehicles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card card-statistics" style="height:175px;">
                <div class="card-header">
                    <h4 class="card-title">Total Vehicles Delivered</h4>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$delivered_vehicles}}</h4>
                                    <p class="card-text font-small-3 mb-0">Vehicles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Striped rows start -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped vehicles">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>VIN No</th>
                                        <th>Customer Name</th>
                                        <th>Assigned Driver</th>
                                        <th>Estimated Pickup Time</th>
                                        <th>Estimated Dropoff Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $vehicle)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$vehicle->name}}</td>
                                        <td>{{$vehicle->model}}</td>
                                        <td>{{$vehicle->vin}}</td>
                                        <td>{{$vehicle->customer_name}}</td>
                                        <td>{{$vehicle->driver_name}}</td>
                                        <td>{{$vehicle->estimate_pickup_time}}</td>
                                        <td>{{$vehicle->estimate_delivery_time}}</td>
                                        <td>{{$vehicle->status}}</td>
                                        <td>
                                            <a href="{{url('vehicles', ['id' => $vehicle->id])}}"
                                                title="Vehicle Detail"><i data-feather='eye'></i> Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Striped rows end -->
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('.vehicles').DataTable();
});
setTimeout(function() {
    toastr['success'](
        'You have successfully logged in to Vehicle Dashboard.',
        '👋 Welcome {{Auth::user()->name}}!', {
            closeButton: true,
            tapToDismiss: false
        }
    );
}, 2000);
</script>
@endsection