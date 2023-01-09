@extends('admin.layouts.master')

@section('title', 'Profile')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">{{$customers->name}}</h2>
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
                                        <a href="#" class="me-25">
                                            <img src="{{asset($customers->image)}}" id="account-upload-img"
                                                class="rounded me-50" alt="profile image" height="80" width="80" />
                                        </a>
                                    </div>
                                    <!--/ header section -->
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-2">
                                            <h5>Name:</h5>
                                            <p class="card-text">{{$customers->name}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Email:</h5>
                                            <p>{{$customers->email}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>NIC NO:</h5>
                                            <p>{{$customers->cnic}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>TYPE OF CUSTOMER:</h5>
                                            <p>{{$customers->type}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>MOBILE NO FOR ALERTS:</h5>
                                            <p>{{$customers->contact_no}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>MOBILE NO:</h5>
                                            <p>{{$customers->phone_no}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>LandLine No:</h5>
                                            <p>{{$customers->landline_no}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Permanent Address:</h5>
                                            <p>{{$customers->address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Temporary Address:</h5>
                                            <p>{{$customers->temp_address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>SMS Alerts:</h5>
                                            <p>{{$customers->sms_alert}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Status:</h5>
                                            @if($customers->status == 0)
                                            <p>Active</p>
                                            @else
                                            <p>InActive</p>
                                            @endif
                                        </div>
                                    </div>
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
                                                                    <th>Sr. No</th>
                                                                    <th>Make</th>
                                                                    <th>Model</th>
                                                                    <th>Year Of Manufacture</th>
                                                                    <th>VIN No</th>
                                                                    <th>Assigned Driver</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($customer_vehicles as $key => $vehicle)
                                                                @if($vehicle->status == 'Pending')
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>{{$vehicle->model}}</td>
                                                                    <td>{{$vehicle->year_of_manufacture}}</td>
                                                                    <td>{{$vehicle->vin}}</td>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>
                                                                        <a href="{{url('vehicles', ['id' => $vehicle->id])}}" title="Vehicle Detail"><i data-feather='eye'></i> Detail</a>
                                                                    </td>
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
                                                                    <th>Assigned Driver</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($customer_vehicles as $key=> $vehicle)
                                                                @if($vehicle->status == 'Delivered')
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>{{$vehicle->model}}</td>
                                                                    <td>{{$vehicle->year_of_manufacture}}</td>
                                                                    <td>{{$vehicle->vin}}</td>
                                                                    <td>{{$vehicle->name}}</td>
                                                                    <td>
                                                                        <a href="{{url('vehicles', ['id' => $vehicle->id])}}" title="Vehicle Detail"><i data-feather='eye'></i> Detail</a>
                                                                    </td>
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