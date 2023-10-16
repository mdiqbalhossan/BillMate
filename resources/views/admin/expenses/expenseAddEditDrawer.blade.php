<div class="drawer-basic-wrap">
    <div class="dm-drawer drawer-account d-none">
        <div class="dm-drawer__header d-flex aling-items-center justify-content-between">
            <h6 class="drawer-title">Add Product</h6>
            <a href="#" class="btdrawer-close"><i class="la la-times"></i></a>
        </div><!-- ends: .dm-drawer__header -->
        <div class="dm-drawer__body">
            <div class="drawer-content">
                <div class="drawer-account-form form-basic">
                    <form id="dataForm">
                        <input type="hidden" name="id" id="expense_id">

                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Please Enter Expense Name">
                                <span class="text-danger" id="error_name"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="amount">Amount <span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="amount" class="form-control form-control-sm" placeholder="Please Enter amount">
                                <span class="text-danger" id="error_amount"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="reference">Reference <span class="text-danger">*</span></label>
                                <input type="number" name="reference" id="reference" class="form-control form-control-sm" placeholder="Please Enter Your reference">
                                <span class="text-danger" id="error_reference"></span>
                            </div>

                            <div class="dm-date-picker col-lg-6">
                                <div class="form-group mb-0 form-group-calender">
                                    <label for="datepicker">Date <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" name="date" class="form-control form-control-default date" id="datepicker" placeholder="January 20, 2018">
                                        <a href="#"><img class="svg" src="{{ asset('img/svg/calendar.svg') }}" alt="calendar"></a>
                                    </div>
                                    <span class="text-danger" id="error_date"></span>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="select-alerts2">Expense Purpose <span class="text-danger">*</span></label>
                                <div class="dm-select ">
                                    <select name="expense_category_id" id="select-alerts2" class="form-control form-control-default expense_category_id">
                                        <option >--Select Purpose--</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger" id="error_expense_category_id"></span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="description">Note </label>
                                <textarea class="form-control" id="description" name="description" placeholder="Please Write your note" rows="3"></textarea>
                                <span class="text-danger" id="error_description"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="image">Attachment <span class="text-info">(Allowed file types: jpeg, jpg, gif, png, pdf, zip. (Max file size is 2MB))</span></label>
                                <div class="custom-file">
                                    <input class="form-control custom-file-input" type="file" name="image" id="customFile">
                                </div>
                                <span class="text-danger" id="error_image"></span>
                                <div class="image-preview my-2">
                                    <img src="{{ asset('img/no.png') }}" alt="" id="previewImage" class="img-fluid" width="128px">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm btdrawer-close">Cancel</button>
                            <button type="submit" id="submitBtn" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- ends: .dm-drawer__body -->

    </div><!-- ends: .dm-drawer -->
</div>
