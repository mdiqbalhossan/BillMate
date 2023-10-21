@extends('layouts.app')

@section('title', 'Estimates')
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
                                <h4 class="text-capitalize fw-500 breadcrumb-title">Estimates List</h4>
                            </div>
                        </div>
                        <div class="action-btn">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.estimate.create') }}" class="btn btn-primary">
                                    <i class="uil uil-plus-circle"></i>&nbsp;
                                    Add Estimates
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="userDatatable userDatatable--ticket userDatatable--ticket--2 mt-2">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless data-table" width="100%">
                                <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <span class="userDatatable-title">Estimate Number</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Status</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Client</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Issue Date</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">Total</span>
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
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script !src="">
        $(document).ready(function () {


            $.fn.dataTable.ext.classes.sPageButton = 'dm-pagination__link';

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
                ajax: "{{ route('admin.estimate.index') }}",
                columns: [
                    {data: 'estimate_number', name: 'estimate_number'},
                    {data: 'status', name: 'status'},
                    {data: 'client', name: 'client'},
                    {data: 'date', name: 'date'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
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

