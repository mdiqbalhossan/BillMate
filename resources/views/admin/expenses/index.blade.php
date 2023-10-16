@extends('layouts.app')

@section('title', 'Expense')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        @include('layouts.partials.breadcrumb')
        <div class="row">
            <div class="col-12 mb-30">
                <div class="support-ticket-system support-ticket-system--search">
                    <div class="breadcrumb-main m-0 breadcrumb-main--table justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center ticket__title justify-content-center me-md-25 mb-md-0 mb-20">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Expense List</h4>
                            </div>
                        </div>
                        <div class="action-btn">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary drawer-trigger" id="addBtn" data-drawer="account">
                                    <i class="uil uil-plus-circle"></i>&nbsp;
                                    Add Expense
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="userDatatable userDatatable--ticket userDatatable--ticket--2 mt-2">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless data-table" width="100%">
                                <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">Name</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Purpose</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Reference</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Amount</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Attachment</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Created</span>
                                    </th>
                                    <th>
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
    @include('admin.expenses.expenseAddEditDrawer')
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script !src="">
        $(document).ready(function () {

            //image preview
            $('#customFile').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });


            $.fn.dataTable.ext.classes.sPageButton = 'dm-pagination__link';
            /*Error Message Show Function*/
            function errorShow(id, text){
                $('#'+id).addClass('is-invalid');
                $("#error_"+id).text(text);
            }

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

            /*Parse Header Token*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*Datatable Section*/
            var table = $('.data-table').DataTable({
                language: {
                    paginate: {
                        next: '<span class="la la-angle-right"></span>',
                        previous: '<span class="la la-angle-left"></span>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.expense.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'expense_category_id', name: 'expense_category_id'},
                    {data: 'reference', name: 'reference'},
                    {data: 'amount', name: 'amount'},
                    {data: 'image', name: 'image'},
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /*Click Create Button*/
            $('#addBtn').click(function () {
                $('#submitBtn').html("Add New");
                $('#expense_id').val('');
                $('#dataForm').trigger("reset");
                $('.drawer-title').html("Add New Expense");
            });

            /*Click Edit Button*/
            $('body').on('click', '.editBtn', function () {
                var expense_id = $(this).data('id');
                $.get("{{ route('admin.expense.index') }}" +'/' + expense_id +'/edit', function (data) {
                    console.log(data);
                    $('.drawer-title').html("Edit Expense");
                    $('#submitBtn').html("Update");
                    openDrawer();
                    $('#expense_id').val(data.id);
                    $('#name').val(data.name);
                    $('#amount').val(data.amount);
                    $('#select-alerts2').val(data.expense_category_id);
                    $('#reference').val(data.reference);
                    $('#note').val(data.note);
                    $('#datepicker').val(data.date);
                    $('#previewImage').attr('src', "{{ asset('storage/expense') }}"+"/"+data.image);
                })
            });

            /*Save Btn*/
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: new FormData($("#dataForm")[0]),
                    url: "{{ route('admin.expense.store') }}",
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#dataForm').trigger("reset");
                        $('#previewImage').attr('src', "{{ asset('img/no.png') }}");
                        $('#submitBtn').html('Add New');
                        hideDrawer();
                        table.draw();
                        toastr.success("Expense Added Successfully!!");
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            const e = JSON.parse(data.responseText);
                            console.log('Error:', e);
                            if(e.errors.name){
                                errorShow('name', e.errors.name);
                            }
                            if(e.errors.amount){
                                errorShow('amount', e.errors.amount);
                            }
                            if(e.errors.date){
                                errorShow('date', e.errors.date);
                            }
                            if(e.errors.reference){
                                errorShow('reference', e.errors.reference);
                            }
                            if(e.errors.expense_category_id){
                                errorShow('expense_category_id', e.errors.expense_category_id);
                            }
                            if(e.errors.image){
                                errorShow('image', e.errors.image);
                            }
                        }
                        $('#submitBtn').html('Add New');
                    }
                });
            });

            /*Delete Data*/
            $('body').on('click', '.dltbtn', function () {
                var expense_id = $(this).data("id");
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
                                url: "{{ route('admin.expense.store') }}"+'/'+expense_id,
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
        });
    </script>
@endpush

