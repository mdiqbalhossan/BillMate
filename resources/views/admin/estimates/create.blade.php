@extends('layouts.app')

@section('title', 'Add Estimates')

@section('content')
    <div class="container-fluid">
        @include('layouts.partials.breadcrumb')
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-Vertical card-default card-md mb-4">
                    <div class="card-header">
                        <h6>Add Estimate</h6>
                    </div>
                    <div class="card-body pb-md-30">
                        <div class="Vertical-form">
                            <form action="#">
                                <div class="row b-normal-b">
                                    <div class="form-group col-md-4">
                                        <label for="select-alerts2" class="color-dark fs-14 fw-500 align-center mb-10">Client</label>
                                        <div class="dm-select ">
                                            <select name="client_id" id="select-alerts2" class="form-control">
                                                <option>--Select Client--</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="estimate_number" class="color-dark fs-14 fw-500 align-center mb-10">Estimate Number</label>
                                        <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" value="{{ $estimateNumber }}" name="estimate_number" id="estimate_number" placeholder="Estimate Number" readonly>
                                    </div>
                                    <div class="form-group col-md-4 form-group-calender">
                                        <label for="datepicker8" class="color-dark fs-14 fw-500 align-center mb-10">Date</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control  ih-medium ip-light radius-xs b-light px-15" name="date" id="datepicker8" placeholder="01/10/2021">
                                            <a href="#"><img class="svg" src="{{ asset('img/svg/calendar.svg') }}" alt="calendar"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-md-6">
                                        <label for="select-alerts2" class="color-dark fs-14 fw-500 align-center mb-10">Choose a Product</label>
                                        <div class="dm-select ">
                                            <select name="client_id" id="product" class="form-control">
                                                <option>--Select Product--</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" style="margin-top: 33px;">Add Product</button>
                                    </div>
                                </div>
                                <div class="table4 p-25 mb-30">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr class="userDatatable-header">
                                                <th>Products</th>
                                                <th>
                                                    Quantity
                                                </th>
                                                <th>
                                                    Unit Price
                                                </th>
                                                <th>
                                                   Tax
                                                </th>
                                                <th>
                                                   Total Amount
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>ABCD</td>
                                                <td>
                                                    <!-- Start: Product Quantity -->
                                                    <div class="quantity product-cart__quantity">
                                                        <input type="button" value="-" class="qty-minus bttn bttn-left wh-36">
                                                        <input type="number" value="1" class="qty qh-36 input">
                                                        <input type="button" value="+" class="qty-plus bttn bttn-right wh-36">
                                                    </div>
                                                    <!-- End: Product Quantity -->
                                                </td>
                                                <td>
                                                    <div class="form-group" style="width: 90px">
                                                        <input type="text" class="form-control" value="125" name="estimate_number" id="estimate_number">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="dm-select ">
                                                            <select name="client_id" id="tax" class="form-control" multiple="multiple">
                                                                <option value="">N/A</option>
                                                                @foreach($taxes as $tax)
                                                                    <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$1225</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="text-danger"><i class="uil uil-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card order-summery p-sm-25 p-15 order-summery--width mt-lg-0 mt-20">
                    <div class="card-header border-bottom-0 p-0 pb-25">
                        <h5 class="fw-500">Others Information</h5>
                    </div>
                    <div class="card-body px-sm-25 px-20">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="select-alerts2" class="color-dark fs-14 fw-500 align-center mb-10">Discount Type</label>
                                <div class="dm-select ">
                                    <select name="discount_type" id="discount_type" class="form-control">
                                        <option>Choose Discount Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount" class="color-dark fs-14 fw-500 align-center mb-10">Discount</label>
                                <input type="text" class="form-control" name="discount" id="discount" readonly>
                            </div>
                            <div class="form-group form-element-textarea mb-20 col-md-12">
                                <label for="notes" class="il-gray fs-14 fw-500 align-center mb-10">Notes</label>
                                <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
                            </div>
                        </div>



                    </div>
                </div><!-- End: .order-summery-->
            </div>
            <div class="col-md-4">
                <div class="card order-summery p-sm-25 p-15 order-summery--width mt-lg-0 mt-20">
                    <div class="card-header border-bottom-0 p-0 pb-25">
                        <h5 class="fw-500">Payment Summary</h5>
                    </div>
                    <div class="card-body px-sm-25 px-20">
                        <div class="total">
                            <div class="subtotalTotal">
                                Subtotal:
                                <span>$1,690.26</span>
                            </div>
                            <div class="taxes">
                                (-)&nbsp;Discount:
                                <span>-$126.30</span>
                            </div>
                            <div class="shipping">
                                (+)&nbsp;Tax:
                                <span>$46.30</span>
                            </div>
                        </div>

                        <div class="total-money d-flex justify-content-between">
                            <h6>Total :</h6>
                            <h5>$1738.60</h5>
                        </div>
                        <a href="checkout.html" class="checkout btn-secondary content-center w-100 btn-lg mt-20"> Save <i class="las la-arrow-right"></i>
                        </a>
                    </div>
                </div><!-- End: .order-summery-->
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script !src="">
        $().ready(function () {
            $("#product").select2({
                placeholder: "Choose Product",
                dropdownCssClass: "alert2",
                allowClear: true,
            });
            $("#tax").select2({
                placeholder: "N/A",
                dropdownCssClass: "tag",
                allowClear: true,
            });
        });
    </script>
@endpush
