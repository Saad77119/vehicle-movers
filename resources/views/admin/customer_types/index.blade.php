@extends('admin.layouts.master')

@section('title', 'Customer Types')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Customer Types</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Setup
                            </li>
                            <li class="breadcrumb-item active">Customer Types
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
                                <th>Customer Type</th>
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
                <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Customer Type</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form" id="add_form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="type">Type</label>
                                    <input type="type" id="type" class="form-control" placeholder="Enter Customer Type..." name="type" required/>
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
            <div class="modal fade text-start" id="edit_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Customer Type</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form" id="edit_form">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="type">Type</label>
                                    <input type="text" id="edit_type" class="form-control" placeholder="Enter Customer Type..." name="type" required/>
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
    $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering : false,
                ajax: "{{ route('customer_types.index') }}",
                columns: [
                    {
                        data : 'id'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: '',
                        searchable: false
                    },
                ],
                "columnDefs": [
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        render: function (data, type, full, meta) {
                            return (
                                '<a href="javascript:;" class="item-edit" onclick=edit('+full.id+')>' +
                                feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
                                '</a>'+
                                '<a href="javascript:;" onclick="delete_types('+full.id+')">' +
                                feather.icons['trash-2'].toSvg({ class: 'font-medium-4 text-danger' }) +
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
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
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
                        text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add New',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#add_modal'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                language: {
                    paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                    }
                }
                
            });
            $('div.head-label').html('<h6 class="mb-0">List of Customer Types</h6>');

            $("#add_form").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('customer_types.store')}}",
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
                                title: 'Customer Types has been Added Successfully!'
                            })
                        }
                        
                    }
                });
            });
            $("#edit_form").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{url('customer_types')}}" + "/" + rowid,
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.errors){
                            $.each(response.errors, function ( index, value ) {
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                })
                            });
                        }
                        else if(response.error_message) {
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $("#edit_modal").modal("hide");
                            $("#dataTable").DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'Customer Types has been Updated Successfully!'
                            })
                        }
                    }
                });
            });
        });
        function edit(id) {
                rowid = id;
                $.ajax({
                    url: "{{url('customer_types')}}" + "/" + id + "/edit",
                    type: "get",
                    success: function (response) {
                        $("#edit_type").val(response.type);
                        $("#edit_modal").modal("show");
                    },
                });
            };
            function delete_types(id) {
            if(confirm("Are You sure want to Delete !")){
                $.ajax({
                    url: "customer_types/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response){
                        if(response.error_message){
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $("#dataTable").DataTable().ajax.reload();
                            Toast.fire({
                                icon: "success",
                                title: "Customer Types has been deleted Successfully !"
                            })
                        }
                    }
                });
            }
        }
</script>
@endsection