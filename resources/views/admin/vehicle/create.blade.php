@extends('admin.layouts.master')

@section('title', 'Vehicles')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add Vehicles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('vehicles.index')}}">Vehicles</a>
                            </li>
                            <li class="breadcrumb-item active">Create
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card pb-1">
            <form class="form" id="add_form">
                @csrf
                <div class="row p-2">
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="make">Make</label>
                            <select name="make" id="make" class="select2 form-select" data-placeholder="Select Make" required>
                                <option value=""></option>
                                @foreach($make as $makes)
                                <option value="{{$makes->id}}">{{$makes->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="model">Model</label>
                            <select name="model" id="model" class="select2 form-select" data-placeholder="Select Model" required disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="fp-default">Year of Manufacture</label>
                            <input type="date" id="year" name="year_of_manufacture" class="form-control" placeholder="YYYY" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="vehicle_chassis_no">VIN No</label>
                            <input type="text" id="vin" class="form-control"
                                placeholder="Enter VIN No..." name="vin" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="country">Country</label>
                            <select name="country" id="country" class="select2 form-select" data-placeholder="Select Country" required>
                                <option value=""></option>
                                @foreach($country as $countrys)
                                <option value="{{$countrys->id}}">{{$countrys->country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="city">City</label>
                            <select name="city" id="city" class="select2 form-select" data-placeholder="Select City" required disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="type">Port</label>
                            <select name="port" id="port" class="select2 form-select" data-placeholder="Select Port" required disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="port_manager">Port Manager</label>
                            <input type="text" id="port_manager" class="form-control" placeholder="Port Manager"
                                name="port_manager" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="customer">Customer</label>
                            <select name="customer_id" id="customer_id" class="select2 form-select" data-placeholder="Select Customer" required>
                                <option value=""></option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="assign_driver">Assign Driver</label>
                            <select name="driver_id" id="driver_id" class="select2 form-select" data-placeholder="Select Driver" required>
                                <option value=""></option>
                                @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="route">Route</label>
                            <input type="text" id="route" class="form-control" placeholder="Enter Route..." name="route"
                                required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="contact_person_vehicle">Contact Person for Vehicle</label>
                            <input type="text" id="contact_person_vehicle" class="form-control"
                                placeholder="Enter Number..." name="contact_person_vehicle" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="estimate_pickup_time">Estimate Pickup Time</label>
                            <input type="datetime-local" id="estimate_pickup_time" class="form-control" name="estimate_pickup_time" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="estimate_delivery_time">Estimate Delivery Time</label>
                            <input type="datetime-local" id="estimate_delivery_time" class="form-control" name="estimate_delivery_time" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="images" name="images[]" accept="image/x-png, image/gif, image/jpeg" multiple/>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Attachment</label>
                            <input class="form-control" type="file" id="attachments" name="attachments" accept="application/pdf,.doc,.docx" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Tally Sheet</label>
                            <input class="form-control" type="file" id="tally_sheet" name="tally_sheet" accept="image/x-png, image/gif, image/jpeg,application/pdf,.doc,.docx" />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" cols="20" rows="1"
                                placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="pickup_address">Pickup Address</label>
                            <textarea class="form-control" name="pickup_address" id="pickup_address" cols="20" rows="1"
                                placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="location">Location</label>
                            <textarea class="form-control" name="location" id="location" cols="20" rows="1"
                                placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="enroute">Instruction by Customer</label>
                            <textarea class="form-control" name="instruction_by_customer" id="instruction_by_customer"
                                cols="20" rows="1" placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="enroute">Instruction for Driver</label>
                            <textarea class="form-control" name="instruction_for_driver" id="instruction_for_driver"
                                cols="20" rows="1" placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="reset" class="btn btn-outline-success">Reset</button>
                        <button type="submit" class="btn btn-primary" id="save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#make').on('change', function() {
        var make_id = this.value;
        $('#model').html('');
        $.ajax({
            url: "{{url('get_models')}}" + "/" + make_id,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $('#model').attr('disabled', false);
                $('#model').html('<option value="">Select Model</option>'); 
                $.each(result, function(key, value) {
                    $("#model").append('<option value="' + value.id +
                        '">' + value.model + '</option>');
                });
            }
        });
    });
    //Country,City
    $('#country').on('change', function(){
        var country_id = this.value;
        $('#city').html('');
        $('#port').html('');
        $.ajax({
            url: "{{url('get_city')}}" + "/" + country_id,
            type: "GET",
            dataType: 'JSON',
            success: function(result) {
                $('#city').attr('disabled', false);
                $('#city').html('<option value="">Select City</option>'); 
                $.each(result, function(key, value) {
                    $("#city").append('<option value="' + value.id + '">' + value.city + '</option>');
                });
            }
        });
    })
    //City,Port
    $('#city').on('change', function(){
        var port_id = this.value;
        $('#port').html('');
        $.ajax({
            url: "{{url('get_port')}}" + "/" + port_id,
            type: "GET",
            dataType: 'JSON',
            success: function(result) {
                $('#port').attr('disabled', false);
                $('#port').html('<option value="">Select Port</option>'); 
                $.each(result, function(key, value) {
                    $("#port").append('<option value="' + value.id + '">' + value.port + '</option>');
                });
            }
        });
    })
    //ADD FORM
    $("#add_form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('vehicles.store')}}",
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
                    Toast.fire({
                        icon: 'success',
                        title: 'Vehicle has been Added Successfully!'
                    })
                    window.location.href = '{{route("vehicles.index")}}';
                }

            }
        });
    });
});
</script>
@endsection