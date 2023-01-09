@extends('admin.layouts.master')

@section('title', 'Vehicles')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Vehicles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('vehicles.index')}}">Vehicles</a>
                            </li>
                            <li class="breadcrumb-item active">Edit
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card pb-1">
            <form class="form" id="edit_form">
                @csrf
                @method('PUT')
                <div class="row p-2">
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="make">Make</label>
                            <select name="make" id="edit_make" class="select2 form-select" data-placeholder="Select Make" required>
                                <option value=""></option>
                                @foreach($makes as $make)
                                <option value="{{$make->id}}" {{$make->id == $data->make ? 'selected' : ''}}>{{$make->company}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="model">Model</label>
                            <select name="model" id="edit_model" class="select2 form-select" data-placeholder="Select Model" required>
                                <option value=""></option>
                                @foreach($carModels as $model)
                                    <option value="{{$model->id}}" {{$model->id == $data->model ? 'selected' : ''}}>{{$model->model}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="fp-default">Year of Manufacture</label>
                            <input type="date" id="edit_year" name="year_of_manufacture" class="form-control" placeholder="YYYY" value="{{$data->year_of_manufacture}}"/>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="vehicle_chassis_no">VIN No</label>
                            <input type="text" id="edit_vin_no" class="form-control"
                                placeholder="Enter VIN No..." name="vin" value="{{$data->vin}}" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="country">Country</label>
                            <select name="country" id="edit_country" class="select2 form-select" data-placeholder="Select Country" required>
                                <option value=""></option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$country->id == $data->country ? 'selected' : ''}}>{{$country->country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="city">City</label>
                            <select name="city" id="edit_city" class="select2 form-select" data-placeholder="Select City" required>
                                <option value=""></option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$city->id == $data->city ? 'selected' : ''}}>{{$city->city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="type">Port</label>
                            <select name="port" id="edit_port" class="select2 form-select" data-placeholder="Select Port" required>
                                <option value=""></option>
                                @foreach($ports as $port)
                                <option value="{{$port->id}}" {{$port->id == $data->port ? 'selected' : ''}}>{{$port->port}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="port_manager">Port Manager</label>
                            <input type="text" id="edit_port_manager" class="form-control" placeholder="Port Manager" name="port_manager" value="{{$data->port_manager}}" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="customer">Customer</label>
                            <select name="customer_id" id="edit_customer_id" class="select2 form-select" data-placeholder="Select Customer" required>
                                <option value=""></option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}"{{$customer->id == $data->customer_id ? 'selected' : ''}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="assign_driver">Assign Driver</label>
                            <select name="driver_id" id="edit_driver_id" class="select2 form-select" data-placeholder="Select Driver" required>
                                <option value=""></option>
                                @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" {{$driver->id == $data->driver_id ? 'selected' : ''}}>{{$driver->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="route">Route</label>
                            <input type="text" id="edit_route" class="form-control" placeholder="Enter Route..." name="route" value="{{$data->route}}"
                                required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="contact_person_vehicle">Contact Person for Vehicle</label>
                            <input type="text" id="edit_contact_person_vehicle" class="form-control"
                                placeholder="Enter Number..." name="contact_person_vehicle" value="{{$data->contact_person_vehicle}}" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="estimate_pickup_time">Estimate Pickup Time</label>
                            <input type="datetime-local" id="estimate_pickup_time" class="form-control" name="estimate_pickup_time" value="{{$data->estimate_pickup_time}}" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="estimate_delivery_time">Estimate Delivery Time</label>
                            <input type="datetime-local" id="estimate_delivery_time" class="form-control" name="estimate_delivery_time" value="{{$data->estimate_delivery_time}}" required />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="edit_images" name="images[]" accept="image/x-png, image/gif, image/jpeg" multiple/>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Attachment</label>
                            <input class="form-control" type="file" id="edit_attachments" name="attachments" value="{{$data->attachments}}" accept="application/pdf,.doc,.docx" />
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-1">
                            <label for="formFile" class="form-label">Tally Sheet</label>
                            <input class="form-control" type="file" id="edit_tally_sheet" name="tally_sheet" value="{{$data->tally_sheet}}" accept="image/x-png, image/gif, image/jpeg,application/pdf,.doc,.docx"  />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="address">Address</label>
                            <textarea class="form-control" name="address" id="edit_address" cols="20" rows="1"
                                placeholder="Type here..." required>{{$data->address}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="pickup_address">Pickup Address</label>
                            <textarea class="form-control" name="pickup_address" id="edit_pickup_address" cols="20" rows="1"
                                placeholder="Type here..." required>{{$data->pickup_address}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="location">Location</label>
                            <textarea class="form-control" name="location" id="edit_location" cols="20" rows="1"
                                placeholder="Type here..." required>{{$data->location}}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="enroute">Instruction by Customer</label>
                            <textarea class="form-control" name="instruction_by_customer" id="edit_instruction_by_customer"
                                cols="20" rows="1" placeholder="Type here..." required>{{$data->instruction_by_customer}}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="enroute">Instruction for Driver</label>
                            <textarea class="form-control" name="instruction_for_driver" id="edit_instruction_for_driver"
                                cols="20" rows="1" placeholder="Type here..." required>{{$data->instruction_for_driver}}</textarea>
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
    $('#edit_make').on('change', function() {
        var make_id = this.value;
        $('#edit_model').html('');
        $.ajax({
            url: "{{url('get_models')}}" + "/" + make_id,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $('#edit_model').attr('disabled', false);
                $('#edit_model').html('<option value="">Select Model</option>'); 
                $.each(result, function(key, value) {
                    $("#edit_model").append('<option value="' + value.id +
                        '">' + value.model + '</option>');
                });
            }
        });
    });
    //Country,City
    $('#edit_country').on('change', function(){
        var country_id = this.value;
        $('#edit_city').html('');
        $('#edit_port').html('');
        $.ajax({
            url: "{{url('get_city')}}" + "/" + country_id,
            type: "GET",
            dataType: 'JSON',
            success: function(result) {
                $('#edit_city').attr('disabled', false);
                $('#edit_city').html('<option value="">Select City</option>'); 
                $.each(result, function(key, value) {
                    $("#edit_city").append('<option value="' + value.id + '">' + value.city + '</option>');
                });
            }
        });
    })
    //City,Port
    $('#edit_city').on('change', function(){
        var port_id = this.value;
        $('#edit_port').html('');
        $.ajax({
            url: "{{url('get_port')}}" + "/" + port_id,
            type: "GET",
            dataType: 'JSON',
            success: function(result) {
                $('#edit_port').attr('disabled', false);
                $('#edit_port').html('<option value="">Select Port</option>'); 
                $.each(result, function(key, value) {
                    $("#edit_port").append('<option value="' + value.id + '">' + value.port + '</option>');
                });
            }
        });
    })
    //EDIT FORM
    $("#edit_form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{url('vehicles')}}" + "/" + {{$data->id}},
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
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
                    Toast.fire({
                        icon: 'success',
                        title: 'Vehicle has been Updated Successfully!'
                    })
                    window.location.href = '{{route("vehicles.index")}}';
                }
            }
        });
    });
});
</script>
@endsection