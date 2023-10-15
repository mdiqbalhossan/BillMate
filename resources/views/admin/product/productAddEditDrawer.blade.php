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
                        <input type="hidden" name="id" id="product_id">

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="image">Product Image <span class="text-info">(Recommended size W: 150 x H: 120)</span></label>
                                <div class="custom-file">
                                    <input class="form-control custom-file-input" type="file" name="image" id="customFile">
                                </div>
                                <span class="text-danger" id="error_image"></span>
                                <div class="image-preview my-2">
                                    <img src="{{ asset('img/no.png') }}" alt="" id="previewImage" class="img-fluid" width="128px">
                                </div>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="name">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Please Enter Your Product Name">
                                <span class="text-danger" id="error_name"></span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="code">Product Code <span class="text-danger">*</span></label>
                                <input type="number" name="code" id="code" class="form-control form-control-sm" placeholder="Please Enter Your Product Code">
                                <span class="text-danger" id="error_code"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category_id">Product Category <span class="text-danger">*</span></label>
                                <div class="dm-select ">
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger" id="error_category_id"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="price">Unit Price <span class="text-danger">*</span></label>
                                <input type="text" name="price" id="price" class="form-control form-control-sm" placeholder="Enter Your Unit Price">
                                <span class="text-danger" id="error_price"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="description">Description </label>
                                <textarea class="form-control" id="description" name="description" placeholder="Please Write your description" rows="3"></textarea>
                                <span class="text-danger" id="error_description"></span>
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
