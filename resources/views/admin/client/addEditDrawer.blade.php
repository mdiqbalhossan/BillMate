<div class="drawer-basic-wrap">
    <div class="dm-drawer drawer-account d-none">
        <div class="dm-drawer__header d-flex aling-items-center justify-content-between">
            <h6 class="drawer-title">Add Client</h6>
            <a href="#" class="btdrawer-close"><i class="la la-times"></i></a>
        </div><!-- ends: .dm-drawer__header -->
        <div class="dm-drawer__body">
            <div class="drawer-content">
                <div class="drawer-account-form form-basic">
                    <form id="dataForm">
                        <input type="hidden" name="id" id="client_id">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" placeholder="Please Enter Your First Name">
                                <span class="text-danger" id="error_first_name"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" placeholder="Please Enter Your Last Name">
                                <span class="text-danger" id="error_last_name"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">Email </label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Please Enter Your Email">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Please Enter Phone">
                                <span class="text-danger" id="error_phone"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="website">Website</label>
                                <input type="url" name="website" id="website" class="form-control form-control-sm" placeholder="Please Enter Website">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="zip_code">Zip Code <span class="text-danger">*</span></label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control form-control-sm" placeholder="Please Enter Zip Code">
                                <span class="text-danger" id="error_zip_code"></span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="country">Country <span class="text-danger">*</span></label>
                                    <select name="country" id="select-option2" class="form-control-sm country">
                                        @foreach(\App\Helpers\Helpers::getCountry() as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                <span class="text-danger" id="error_country"></span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="city">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control form-control-sm" placeholder="Please Enter City">
                                <span class="text-danger" id="error_city"></span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="state">State <span class="text-danger">*</span></label>
                                <input type="text" name="state" id="state" class="form-control form-control-sm" placeholder="Please Enter state">
                                <span class="text-danger" id="error_state"></span>
                            </div>

                            <div class="form-group col-6">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control form-control-sm" placeholder="PLease Enter Your Address"></textarea>
                            </div>
                            <div class="form-group col-6">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control form-control-sm" placeholder="PLease Enter Notes"></textarea>
                            </div>
                            <div class="form-group col-6" id="createAccountSection">
                                <input class="checkbox" type="checkbox" name="is_create_account" id="createAccount">
                                <label for="createAccount">
                                    <span class="checkbox-text">
                                       Do you want to create new account?
                                    </span>
                                </label>
                            </div>
                            <div id="password_sec" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-lg-6" id="password_div">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Please Enter password">
                                        <span class="text-danger" id="error_password"></span>
                                    </div>

                                    <div class="form-group col-lg-6" id="confirm_password_div">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" placeholder="Please Enter Confirm Password">
                                        <span class="text-danger" id="error_password_confirmation"></span>
                                    </div>
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
