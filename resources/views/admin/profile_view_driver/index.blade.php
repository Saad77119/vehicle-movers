@extends('admin.layouts.master')

@section('title', 'Profile')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">{{$driver->name}}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Profile
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="page-account-settings">
            <div class="row">
                <div class="col-12 mb-2 mb-md-0">
                    <ul class="nav nav-pills">
                        <!-- detail -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-detail" data-bs-toggle="pill"
                                href="#account-vertical-detail" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 me-1"></i>
                                <span class="fw-bold">Detail</span>
                            </a>
                        </li>
                        <!-- Delivery -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-delivery" data-bs-toggle="pill"
                                href="#account-vertical-delivery" aria-expanded="false">
                                <i data-feather="info" class="font-medium-3 me-1"></i>
                                <span class="fw-bold">Deliveries</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- right content section -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Detail tab -->
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-detail"
                                    aria-labelledby="account-pill-detail" aria-expanded="true">
                                    <!-- header section -->
                                    <div class="d-flex">
                                        <img src="{{asset($driver->image)}}" id="account-upload-img"
                                            class="rounded me-50" alt="profile image" height="80" width="80" />
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-2">
                                            <h5>Name:</h5>
                                            <p>{{$driver->name}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Email:</h5>
                                            <p>{{$driver->email}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>NIC NO:</h5>
                                            <p>{{$driver->cnic}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>MOBILE NO FOR ALERTS:</h5>
                                            <p>{{$driver->contact_no}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>MOBILE NO:</h5>
                                            <p>{{$driver->phone_no}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Permanent Address:</h5>
                                            <p>{{$driver->address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Temporary Address:</h5>
                                            <p>{{$driver->temp_address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>SMS Alerts:</h5>
                                            <p>{{$driver->sms_alert}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Status:</h5>
                                            @if($driver->status == 0)
                                            <p>Active</p>
                                            @else
                                            <p>InActive</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/ header section -->
                                </div>
                                <!--/ general tab -->

                                <!-- Delivery -->
                                <div class="tab-pane fade" id="account-vertical-delivery" role="tabpanel"
                                    aria-labelledby="account-pill-delivery" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12 mb-2 mb-md-0">
                                            <ul class="nav nav-pills">
                                                <!-- inprogress -->
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="account-pill-inprogress"
                                                        data-bs-toggle="pill" href="#account-vertical-inprogress"
                                                        aria-expanded="true">
                                                        <i data-feather="user" class="font-medium-3 me-1"></i>
                                                        <span class="fw-bold">Pending</span>
                                                    </a>
                                                </li>
                                                <!-- Delivered -->
                                                <li class="nav-item">
                                                    <a class="nav-link" id="account-pill-delivered"
                                                        data-bs-toggle="pill" href="#account-vertical-delivered"
                                                        aria-expanded="false">
                                                        <i data-feather="info" class="font-medium-3 me-1"></i>
                                                        <span class="fw-bold">Delivered</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active"
                                                    id="account-vertical-inprogress"
                                                    aria-labelledby="account-pill-inprogress" aria-expanded="true">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped customer_deliveries">
                                                            <thead>
                                                                <tr>
                                                                    <th>Make</th>
                                                                    <th>Model</th>
                                                                    <th>Year Of Manufacture</th>
                                                                    <th>VIN No</th>
                                                                    <th>Customer Name</th>
                                                                    <th>Country</th>
                                                                    <th>City</th>
                                                                    <th>Port</th>
                                                                    <th>Address</th>
                                                                    <th>Location</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($driver_vehicles as $vehicle)
                                                                @if($vehicle->status == 'Pending')
                                                                    <tr>
                                                                        <td>{{$vehicle->name}}</td>
                                                                        <td>{{$vehicle->model}}</td>
                                                                        <td>{{$vehicle->year_of_manufacture}}</td>
                                                                        <td>{{$vehicle->vin}}</td>
                                                                        <td>{{$vehicle->name}}</td>
                                                                        <td>{{$vehicle->country}}</td>
                                                                        <td>{{$vehicle->city}}</td>
                                                                        <td>{{$vehicle->port}}</td>
                                                                        <td>{{$vehicle->address}}</td>
                                                                        <td>{{$vehicle->location}}</td>
                                                                    </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="account-vertical-delivered"
                                                    aria-labelledby="account-pill-delivered" aria-expanded="true">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped customer_deliveries">
                                                            <thead>
                                                                <tr>
                                                                    <th>Make</th>
                                                                    <th>Model</th>
                                                                    <th>Year Of Manufacture</th>
                                                                    <th>VIN No</th>
                                                                    <th>Customer Name</th>
                                                                    <th>Port</th>
                                                                    <th>Address</th>
                                                                    <th>Country</th>
                                                                    <th>City</th>
                                                                    <th>Port</th>
                                                                    <th>Location</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($driver_vehicles as $vehicle)
                                                                @if($vehicle->status == 'Delivered')
                                                                <tr>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>{{$vehicle->model}}</td>
                                                                    <td>{{$vehicle->year_of_manufacture}}</td>
                                                                    <td>{{$vehicle->vin}}</td>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>{{$vehicle->country}}</td>
                                                                    <td>{{$vehicle->city}}</td>
                                                                    <td>{{$vehicle->port}}</td>
                                                                    <td>{{$vehicle->address}}</td>
                                                                    <td>{{$vehicle->location}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ information -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('.customer_deliveries').DataTable();
});
</script>
@endsection