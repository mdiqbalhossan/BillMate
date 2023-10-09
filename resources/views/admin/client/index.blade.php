@extends('layouts.app')

@section('title', 'Client')

@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="dm-page-content">
        <div class="container-fluid">
            @include('layouts.partials.breadcrumb')
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="support-ticket-system support-ticket-system--search">

                        <div class="breadcrumb-main m-0 breadcrumb-main--table justify-content-sm-between ">
                            <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                                <div class="d-flex align-items-center ticket__title justify-content-center me-md-25 mb-md-0 mb-20">
                                    <h4 class="text-capitalize fw-500 breadcrumb-title">Client List</h4>
                                </div>
                            </div>
                            <div class="action-btn">
                                <div class="d-flex justify-content-between">
{{--                                    <a href="#" class="btn btn-info mx-2">--}}
{{--                                        Export--}}
{{--                                        <i class="las la-angle-down"></i>--}}
{{--                                    </a>--}}
                                    <div class="drawer-btn">
                                        <button type="button" class="btn btn-primary drawer-trigger" data-drawer="account" id="addBtn">
                                            <i class="uil uil-plus-circle"></i>&nbsp;
                                            Add Client
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @include('admin.client.addEditDrawer')
                        <div class="userDatatable userDatatable--ticket userDatatable--ticket--2 mt-2">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless data-table" width="100%">
                                    <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">ID</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Phone</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Email</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Address</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Created</span>
                                        </th>
                                        <th class="actions">
                                            <span class="userDatatable-title">Actions</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function ($) {

            $.fn.dataTable.ext.classes.sPageButton = 'dm-pagination__link';
            /*Show Password Field*/
            $("#createAccount").click(function(){
                // Check if the checkbox is checked
                if ($(this).is(":checked")) {
                    // If checked, show the div
                    $("#password_sec").show();
                } else {
                    // If not checked, hide the div
                    $("#password_sec").hide();
                }
            });

            /*Variable For Drawer*/
            const drawerBasic = document.querySelector('.drawer-basic-wrap');
            const overlay = document.querySelector('.overlay-dark');
            /*function Hide Drawer*/
            function hideDrawer(){
                drawerBasic.classList.remove('show');
                overlay.classList.remove('show');
                // areaDrawer.classList.remove('show');
            }
            /*Function Open Drawer*/
            function openDrawer(){
                drawerBasic.classList.add('account');
                drawerBasic.classList.add('show');
                overlay.classList.add('show');
            }

            /*Error Message Show Function*/
            function errorShow(id, text){
                $('#'+id).addClass('is-invalid');
                $("#error_"+id).text(text);
            }

            /*Parse Header Token*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*Render Table*/
            var table = $('.data-table').DataTable({
                language: {
                    paginate: {
                        next: '<span class="la la-angle-right"></span>',
                        previous: '<span class="la la-angle-left"></span>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.client.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /*Click Create Button*/
            $('#addBtn').click(function () {
                $('#submitBtn').html("Add New");
                $('#client_id').val('');
                $('#dataForm').trigger("reset");
                $('.drawer-title').html("Add New Client");
            });

            /*Click Edit Button*/
            $('body').on('click', '.editBtn', function () {
                var client_id = $(this).data('id');
                $.get("{{ route('admin.client.index') }}" +'/' + client_id +'/edit', function (data) {
                    console.log(data);
                    openDrawer();
                    $('.drawer-title').html("Edit Client");
                    $('#submitBtn').html("Update");
                    $("#createAccountSection").hide();
                    $("#password_sec").hide();
                    $('#client_id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#website').val(data.website);
                    $('#zip_code').val(data.zip_code);
                    $('#country').val(data.country);
                    $('#city').val(data.city);
                    $('#state').val(data.state);
                    $('#address').val(data.address);
                    $('#notes').val(data.notes);
                })
            });

            /*Save Btn*/
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#dataForm').serialize(),
                    url: "{{ route('admin.client.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataForm').trigger("reset");
                        $('#submitBtn').html('Add New');
                        hideDrawer();
                        table.draw();
                        toastr.success("Data Saved Successfully!!");
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            const e = JSON.parse(data.responseText);
                            console.log('Error:', e);
                            if(e.errors.first_name){
                                errorShow('first_name', e.errors.first_name);
                            }
                            if(e.errors.last_name){
                                errorShow('last_name', e.errors.last_name);
                            }
                            if(e.errors.phone){
                                errorShow('phone', e.errors.phone);
                            }
                            if(e.errors.state){
                                errorShow('state', e.errors.state);
                            }
                            if(e.errors.city){
                                errorShow('city', e.errors.city);
                            }
                            if(e.errors.country){
                                errorShow('country', e.errors.country);
                            }
                            if(e.errors.zip_code){
                                errorShow('zip_code', e.errors.zip_code);
                            }
                        }

                        $('#submitBtn').html('Add New');
                    }
                });

            });

            /*Delete Data*/
            $('body').on('click', '.dltbtn', function () {
                var client_id = $(this).data("id");
                swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.client.store') }}"+'/'+client_id,
                            success: function (data) {
                                table.draw();
                                toastr.success("Data Deleted Successfully!!");
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        })
    </script>
@endpush
