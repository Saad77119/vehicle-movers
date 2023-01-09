@extends('admin.layouts.master')

@section('title', 'Vehicle')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Vehicles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Vehicles
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
                                <th>Make</th>
                                <th>Model</th>
                                <th>VIN No</th>
                                <th>Customer Name</th>
                                <th>Assigned Driver</th>
                                <th>Estimated Pickup Time</th>
                                <th>Estimated Dropoff Time</th>
                                <th class="not_include">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: false,
                ajax: "{{ route('vehicles.index') }}",
                columns: [
                    {
                        data: 'responsive_id',
                        orderable: false
                    },
                    {
                        data : 'id'
                    },
                    {
                        data: 'name',
                        name: 'makes.name'
                    },
                    {
                        data: 'model',
                        name: 'car_models.model'
                    },
                    {
                        data: 'vin'
                    },
                    {
                        data: 'customer_name',
                        name: 'customers.name'
                    },
                    {
                        data: 'driver_name',
                        name: 'drivers.name'
                    },
                    {
                        data: 'estimate_pickup_time',
                        render: function(data, type, row){
                            var datetime = new Date(row.estimate_pickup_time);
                            var time = datetime.toLocaleString('en-US', {hour12: true });
                            return time;  
                        }
                    },
                    {
                        data: 'estimate_delivery_time',
                        render: function(data, type, row){
                            var datetime = new Date(row.estimate_delivery_time);
                            var time = datetime.toLocaleString('en-US', {hour12: true });
                            return time;  
                        }
                    },
                    {
                        data: '',
                        searchable: false
                    },
                ],
                "columnDefs": [
                    {
						// For Responsive
						targets: 0,
						className: 'control',
                        searchable: false,
                        orderable: false
					},
                    {
                        // Actions
                        targets: -1,
                        orderable: false,
                        title: 'Actions',
                        render: function (data, type, full, meta) {
                            return (
                                '<a href="{{url("vehicles")}}'+'/'+full.id+'/edit'+'" class="item-edit">' + 
                                feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
                                '</a>'+
                                '<a href="{{url("vehicles")}}'+'/'+full.id+'" title="View Profile" class="item-edit">' +
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
                "order": [[0, 'asc']],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
                buttons: [
                  {
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                        buttons: [
                            {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: ':not(.not_include)' }
                            },
                            {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: ':not(.not_include)' }
                            },
                            {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: ':not(.not_include)' }
                            },
                            {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: ':not(.not_include)' }
                            },
                            {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: ':not(.not_include)' }
                            }
                        ],
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                            }, 50);
                        }
                    },
                    {
                        text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add Vehicle',
                        className: 'btn btn-primary',
                        action: function (e, dt, node, config)
                        {
                            window.location.href = '{{route("vehicles.create")}}';
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

            $('div.head-label').html('<h6 class="mb-0">List of Vehicles</h6>');
    });
//     function delete_vehicle(id) {
//     if (confirm("Are You sure want to Delete !")) {
//         $.ajax({
//             url: "vehicles/" + id,
//             type: "DELETE",
//             data: {
//                 _token: "{{ csrf_token() }}"
//             },
//             success: function(response) {
//                 if (response.error_message) {
//                     Toast.fire({
//                         icon: 'error',
//                         title: 'An error has been occured! Please Contact Administrator.'
//                     })
//                 } else {
//                     $("#dataTable").DataTable().ajax.reload();
//                     Toast.fire({
//                         icon: "success",
//                         title: "Vehicle has been deleted Successfully !"
//                     })
//                 }
//             }
//         });
//     }
// }
        
</script>
@endsection
