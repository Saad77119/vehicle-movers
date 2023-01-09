@extends('admin.layouts.master')

@section('title', 'Add Payment')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add Payment</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Setup
                            </li>
                            <li class="breadcrumb-item active">Add Payment
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card pb-1">
                    <table class="table px-1" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vehicle</th>
                                <th>Customer</th>
                                <th>Charges Type</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-size-lg d-inline-block">
                  <!--Add Modal -->
                  <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                            <label class="form-label" for="make">Select Vehicle</label>
                                            <select name="vehicle" id="vehicle" class="select2 form-select" required>
                                                    <option value=""></option>  
                                                    @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}">{{$vehicle->name.' '.$vehicle->model.' - '.$vehicle->vin}}</option>  
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="make">Select Customer</label>
                                            <select name="customer" id="customer" class="select2 form-select" required>
                                                    <option value=""></option> 
                                                    @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach   
                                            </select>
                                        </div>
                                    </div>
                                    <h3>Add Payments</h3>
                                    <div class="add_payments" id="add_payment">
                                        <div data-repeater-list="charges">
                                                <div data-repeater-item>
                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label">Select Charges Type</label>
                                                                <select name="charges_type" class="select2 form-select" required>
                                                                        <option value=""></option>
                                                                        @foreach($charges_type as $charges)    
                                                                        <option value="{{$charges->id}}">{{$charges->name}}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="staticprice">Amount</label>
                                                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Price Here..." />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="remarks"></label>
                                                                <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks...">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-12">
                                                            <div class="mb-1">
                                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
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
                                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
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
                  <!--Edit Modal -->
                  
                  <!--End Edit Modal -->
               </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    // form repeater jquery
    var payment = $('#add_payment');
  $('.add_payments, .repeater-default').repeater({
    show: function () {
      $(this).slideDown();
      payment.find('select').next('.select2-container').remove();
      payment.find('select').select2({
        placeholder: "Select Charges Type"
      });
      // Feather Icons
      if (feather) {
        feather.replace({ width: 14, height: 14 });
      }
    },
    hide: function (deleteElement) {    
        $(this).slideUp(deleteElement);
    }
  });

    $("#add_form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('add_payments.store')}}",
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            responsive: true,
            success: function (response) {
                console.log(response);
                if(response.errors){
                    $.each( response.errors, function( index, value ){
                        Toast.fire({
                            icon: 'error',
                            title: value
                        })
                    });
                }
                else if(response.error_message){
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })
                }
                else{
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