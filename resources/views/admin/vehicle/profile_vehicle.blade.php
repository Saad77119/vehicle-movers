@extends('admin.layouts.master')

@section('title', 'Vehicle Detail')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Vehicle Detail</h2>
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
                            <a class="nav-link active" data-bs-toggle="pill" href="#" aria-expanded="true">
                                <i data-feather='image'></i>
                                <span class="fw-bold">Vehicle Images</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Image section -->
                                <div class="row" id="lightgallery">
                                    @foreach(explode(',', $vehicle_data->images) as $image)
                                    <a class="col-md-3 mb-2" href="{{asset($image)}}">
                                        <img class="w-100 h-100 rounded" alt="Vehicle Image" src="{{asset($image)}}" />
                                    </a>
                                    @endforeach
                                </div>
                                <!--/ Image section -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2 mb-md-0 d-flex justify-content-between">
                    <ul class="nav nav-pills">
                        <!-- detail -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-detail" data-bs-toggle="pill"
                                href="#account-vertical-detail" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 me-1"></i>
                                <span class="fw-bold">Vehicle Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-payment" data-bs-toggle="pill"
                                href="#view-payment-details" aria-expanded="false">
                                <i data-feather="eye" class="font-medium-3 me-1"></i>
                                <span class="fw-bold">View Payment</span>
                            </a>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal"
                        data-bs-target="#add_modal"> <i data-feather="plus" class="me-50 font-small-4"></i>
                        Add Payment
                    </button>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Detail tab -->
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-detail"
                                    aria-labelledby="account-pill-detail" aria-expanded="true">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <h5>Estimated Pickup Time</h5>
                                            <p>{{$vehicle_data->estimate_pickup_time}}</p>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <h5>Estimated Delivery Time</h5>
                                            <p>{{$vehicle_data->estimate_delivery_time}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Make:</h5>
                                            <p>{{$vehicle_data->name}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Model:</h5>
                                            <p>{{$vehicle_data->model}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>VIN No:</h5>
                                            <p>{{$vehicle_data->vin}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Year of Manufacture:</h5>
                                            <p>{{$vehicle_data->year_of_manufacture}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Customer Name:</h5>
                                            <p>{{$vehicle_data->customer_name}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Driver Assigned:</h5>
                                            <p>{{$vehicle_data->driver_name}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Country:</h5>
                                            <p>{{$vehicle_data->country}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>City:</h5>
                                            <p>{{$vehicle_data->city}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Port:</h5>
                                            <p>{{$vehicle_data->port}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Port Manager:</h5>
                                            <p>{{$vehicle_data->port_manager}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Address:</h5>
                                            <p>{{$vehicle_data->address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Pickup Address:</h5>
                                            <p>{{$vehicle_data->pickup_address}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Location:</h5>
                                            <p>{{$vehicle_data->location}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Route:</h5>
                                            <p>{{$vehicle_data->route}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Contact Person No for Vehicle:</h5>
                                            <p>{{$vehicle_data->contact_person_vehicle}}</p>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Tally Sheet:</h5>
                                            <a href="{{asset($vehicle_data->tally_sheet)}}"
                                                class="btn btn-medium btn-primary" download><i
                                                    data-feather='download'></i> Tally Sheet</a>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Attachments:</h5>
                                            <a href="{{asset($vehicle_data->attachments)}}"
                                                class="btn btn-medium btn-primary" download><i
                                                    data-feather='download'></i> Attachments</a>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <h5>Status:</h5>
                                            <p>{{$vehicle_data->status}}</p>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <h5>Instruction by Customer:</h5>
                                            <p>{{$vehicle_data->instruction_by_customer}}</p>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <h5>Instruction for Driver:</h5>
                                            <p>{{$vehicle_data->instruction_for_driver}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="view-payment-details" role="tabpanel"
                                    aria-labelledby="account-pill-payment" aria-expanded="false">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped payments">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Charges Type</th>
                                                        <th>Remarks</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_charges = 0;
                                                    @endphp
                                                    @foreach($payment_details as $key=> $payment)
                                                        @php
                                                        $total_charges += $payment->amount;
                                                        @endphp
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$payment->name}}</td>
                                                        <td>{{$payment->remarks}}</td>
                                                        <td>${{$payment->amount}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <th colspan="3">Net Total</th>
                                                    <th>${{$total_charges}}</th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="payment-details">
            <!--Add Modal -->
            <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Add Payment</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form" id="add_form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <input type="hidden" name="vehicle" id="vehicle"
                                                value="{{$vehicle_data->id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <input type="hidden" name="customer" id="customer"
                                                value="{{$vehicle_data->customer_id}}">
                                        </div>
                                    </div>
                                    <div class="add_payments" id="add_payment">
                                        <div data-repeater-list="charges">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label">Select Charges Type</label>
                                                            <select name="charges_type" class="select2 form-select"
                                                                required>
                                                                <option value=""></option>
                                                                @foreach($charges_type as $charges)
                                                                <option value="{{$charges->id}}">{{$charges->name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="staticprice">Amount</label>
                                                            <input type="number" class="form-control" id="amount"
                                                                name="amount" placeholder="Enter Price Here..." />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="remarks"></label>
                                                            <input type="text" class="form-control" name="remarks"
                                                                id="remarks" placeholder="Enter Remarks...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-12">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1"
                                                                data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-icon btn-primary" type="button"
                                                    data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-outline-success">Reset</button>
                                <button type="submit" class="btn btn-primary" id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Add Modal -->
        </section>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
lightGallery(document.getElementById('lightgallery'), {
    plugins: [lgZoom, lgFullscreen, lgRotate],
    speed: 500,
    height: "100%",
    width: "100%",
    slideEndAnimatoin: true
});
</script>
<script>
$(document).ready(function() {
    $('.payments').DataTable();
    // form repeater jquery
    var payment = $('#add_payment');
    $('.add_payments, .repeater-default').repeater({
        show: function() {
            $(this).slideDown();
            payment.find('select').next('.select2-container').remove();
            payment.find('select').select2({
                placeholder: "Select Charges Type"
            });
            // Feather Icons
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        },
        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $("#add_form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('add_payments.store')}}",
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            responsive: true,
            success: function(response) {
                console.log(response);
                if (response.errors) {
                    $.each(response.errors, function(index, value) {
                        Toast.fire({
                            icon: 'error',
                            title: value
                        })
                    });
                } else if (response.error_message) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })
                } else {
                    $('#add_form')[0].reset();
                    $("#add_modal").modal("hide");
                    $('#dataTable').DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: 'Payment has been Added Successfully!'
                    })
                }

            }
        });
    });
})
</script>
@endsection