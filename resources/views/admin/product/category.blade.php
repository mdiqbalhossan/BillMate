@extends('layouts.app')

@section('title', 'Category')
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
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Category List</h4>
                            </div>
                        </div>
                        <div class="action-btn">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#modal-basic">
                                    <i class="uil uil-plus-circle"></i>&nbsp;
                                    Add Category
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
                                        <span class="userDatatable-title">ID</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Name</span>
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
    @include('admin.product.categoryAddEditModal')
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script !src="">
        $(document).ready(function () {

            $.fn.dataTable.ext.classes.sPageButton = 'dm-pagination__link';
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
                ajax: "{{ route('admin.category.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
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
                $('#cat_id').val('');
                $('#dataForm').trigger("reset");
                $('.modal-title').html("Add New Category");
            });

            /*Click Edit Button*/
            $('body').on('click', '.editBtn', function () {
                var cat_id = $(this).data('id');
                $.get("{{ route('admin.category.index') }}" +'/' + cat_id +'/edit', function (data) {
                    console.log(data);
                    $('.modal-title').html("Edit Category");
                    $('#submitBtn').html("Update");
                    $('#modal-basic').modal('show');
                    $('#cat_id').val(data.id);
                    $('#name').val(data.name);
                })
            });

            /*Save Btn*/
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#dataForm').serialize(),
                    url: "{{ route('admin.category.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataForm').trigger("reset");
                        $('#submitBtn').html('Add New');
                        $('#modal-basic').modal('hide');
                        table.draw();
                        toastr.success("Category Saved Successfully!!");
                    },
                    error: function (data) {
                        if (data.status == 422) {
                            const e = JSON.parse(data.responseText);
                            console.log('Error:', e);
                            if(e.errors.name){
                                errorShow('name', e.errors.name);
                            }
                        }
                        $('#submitBtn').html('Add New');
                    }
                });
            });

            /*Delete Data*/
            $('body').on('click', '.dltbtn', function () {
                var cat_id = $(this).data("id");
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
                            url: "{{ route('admin.category.store') }}"+'/'+cat_id,
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
