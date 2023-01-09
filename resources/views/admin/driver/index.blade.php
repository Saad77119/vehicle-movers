@extends('admin.layouts.master')

@section('title', 'Driver')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Drivers</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Drivers
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
                                <th class="not_include"></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Status</th>
                                <th class="not_include">Action</th>
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
            <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Add Drivers</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form" id="add_form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="title">Customer Name</label>
                                            <input type="text" id="name" class="form-control" placeholder="Name"
                                                name="name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="cnic">NIC No</label>
                                            <input type="text" id="cnic" class="form-control" placeholder="Enter No..."
                                                name="cnic" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="contact">Mobile No for Alerts</label>
                                            <input type="text" id="contact_no" class="form-control"
                                                placeholder="Enter No..." name="contact_no" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="phone">Mobile No 2 * (optional)</label>
                                            <input type="number" id="phone_no" class="form-control"
                                                placeholder="Enter No..." name="phone_no" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="license">License No</label>
                                            <input type="number" id="license" class="form-control"
                                                placeholder="Enter No..." name="license" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" class="form-control"
                                                placeholder="Enter Email..." name="email" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="image" name="image" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="sms_alert">SMS Alerts</label>
                                            <select name="sms_alert" id="sms_alert" class="select2 form-select"
                                                required>
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="address">Permanent Address</label>
                                            <textarea class="form-control" name="address" id="address" cols="20"
                                                rows="1" placeholder="Type here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="temp_address">Temporary Address *
                                                (Optional)</label>
                                            <textarea class="form-control" name="temp_address" id="address" cols="20"
                                                rows="1" placeholder="Type here..." required></textarea>
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
            <div class="modal fade text-start" id="edit_modal" tabindex="-1" aria-labelledby="myModalLabel17"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Edit Customers</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form" id="edit_form">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="title">Customer Name</label>
                                            <input type="text" id="edit_name" class="form-control" placeholder="Name"
                                                name="name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="cnic">NIC No</label>
                                            <input type="text" id="edit_cnic" class="form-control"
                                                placeholder="Enter No..." name="cnic" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="contact">Mobile No for Alerts</label>
                                            <input type="number" id="edit_contact_no" class="form-control"
                                                placeholder="Enter No..." name="contact_no" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="phone">Mobile No 2 * (optional)</label>
                                            <input type="number" id="edit_phone_no" class="form-control"
                                                placeholder="Enter No..." name="phone_no" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="license">License No</label>
                                            <input type="number" id="edit_license" class="form-control"
                                                placeholder="Enter No..." name="license" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="edit_email" class="form-control"
                                                placeholder="Enter Email.." name="email" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="edit_image" name="image" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="sms_alert">SMS Alerts</label>
                                            <select name="sms_alert" id="edit_sms_alert" class="select2 form-select"
                                                required>
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="address">Permanent Address</label>
                                            <textarea class="form-control" name="address" id="edit_address" cols="20"
                                                rows="1" placeholder="Type here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="temp_address">Temporary Address *
                                                (Optional)</label>
                                            <textarea class="form-control" name="temp_address" id="edit_temp_address"
                                                cols="20" rows="1" placeholder="Type here..." required></textarea>
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
            <!--End Edit Modal -->
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    new Cleave($('#cnic'), {
        delimiter: '-',
        blocks: [5, 7, 1],
        numericOnly: true
    });
    new Cleave($('#edit_cnic'), {
        delimiter: '-',
        blocks: [5, 7, 1],
        numericOnly: true
    });
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ordering: false,
        ajax: "{{ route('drivers.index') }}",
        columns: [{
                data: 'responsive_id',
                orderable: false
            },
            {
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'contact_no'
            },
            {
                data: 'status'
            },
            {
                data: '',
                searchable: false
            },
        ],
        "columnDefs": [{
                // For Responsive
                targets: 0,
                className: 'control'
            },
            {
                // Status
                targets: -2,
                title: 'Status',
                render: function(data, type, full, meta) {
                    // console.log(data);
                    if (data == 0) {
                        return (
                            '<input  type="checkbox" data-id="' + full.id +
                            '" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="small" data-on="Active" data-off="Disable" checked>'
                        );
                    } else {
                        return (
                            '<input  type="checkbox" data-id="' + full.id +
                            '" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="small" data-on="Active" data-off="Disable">'
                        );
                    }
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                render: function(data, type, full, meta) {
                    return (
                        '<a href="javascript:;" class="item-edit" onclick=edit(' + full.id +
                        ')>' +
                        feather.icons['edit'].toSvg({
                            class: 'font-medium-4'
                        }) +
                        '</a>' +
                        '<a href="{{url("drivers")}}' + '/' + full.id +
                        '" title="View Profile" class="item-edit">' +
                        feather.icons['eye'].toSvg({
                            class: 'font-medium-4 text-success'
                        }) +
                        '</a>'
                    );
                }
            },
            {
                "defaultContent": "-",
                "targets": "_all"
            }
        ],
        "order": [
            [0, 'asc']
        ],
        "drawCallback": function() {
                    $('.toggle-class').bootstrapToggle();
                    status();
                },
        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        buttons: [{
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle me-2',
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Export',
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: ':not(.not_include)'
                        }
                    },
                    {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: ':not(.not_include)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: ':not(.not_include)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: ':not(.not_include)'
                        }
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: ':not(.not_include)'
                        }
                    }
                ],
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function() {
                        $(node).closest('.dt-buttons').removeClass('btn-group')
                            .addClass('d-inline-flex');
                    }, 50);
                }
            },
            {
                text: feather.icons['plus'].toSvg({
                    class: 'me-50 font-small-4'
                }) + 'Add New',
                className: 'create-new btn btn-primary',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#add_modal'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: 'column',
            }
        },
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }

    });

    $('div.head-label').html('<h6 class="mb-0">List of Drivers</h6>');

    $("#add_form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('drivers.store')}}",
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
                        title: 'Driver has been Added Successfully!'
                    })
                }

            }
        });
    });
    $("#edit_form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{url('drivers')}}" + "/" + rowid,
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
                    $("#edit_modal").modal("hide");
                    $("#dataTable").DataTable().ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: 'Driver has been Updated Successfully!'
                    })
                }
            }
        });
    });
});

function edit(id) {
    rowid = id;
    $.ajax({
        url: "{{url('drivers')}}" + "/" + id + "/edit",
        type: "get",
        success: function(response) {
            $("#edit_name").val(response.name);
            $("#edit_type").val(response.type).select2();
            $("#edit_contact_no").val(response.contact_no);
            $("#edit_phone_no").val(response.phone_no);
            $("#edit_license").val(response.license);
            $("#edit_email").val(response.email);
            $("#edit_sms_alert").val(response.sms_alert).select2();
            $("#edit_address").val(response.address);
            $("#edit_temp_address").val(response.temp_address);
            $("#edit_modal").modal("show");
        },
    });
}
function status(){
        $(".toggle-class").change(function (event) {
            event.preventDefault();
                var status = $(this).prop('checked') == true ? 0 : 1;
                // alert(status);
                var driver_id = $(this).data('id');
                $.ajax({
                    type:"GET",
                    datatype:"json",
                    url: "{{url('driver_status')}}" + "/" + driver_id,
                    data: {
                        status : status,
                        id : driver_id
                    },
                    success:function (data) {
                        console.log(data.success);
                    }
                });
        });
    }

function delete_customer(id) {
    if (confirm("Are You sure want to Delete !")) {
        $.ajax({
            url: "drivers/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.error_message) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })
                } else {
                    $("#dataTable").DataTable().ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: "Driver has been deleted Successfully !"
                    })
                }
            }
        });
    }
}
</script>
@endsection