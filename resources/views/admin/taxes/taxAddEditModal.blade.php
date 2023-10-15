<div class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-bg-white ">
            <div class="modal-header">
                <h6 class="modal-title">Basic title</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('img/svg/x.svg') }}" alt="x" class="svg">
                </button>
            </div>
            <form id="dataForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="tax_id">
                    <div class="form-group">
                        <label for="name">Tax Name <span class="text-danger">(*)</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        <span class="text-danger" id="error_name"></span>
                    </div>
                    <div class="form-group">
                        <label for="rate">Tax Rate <span class="text-info">(Must be % value)</span></label>
                        <input type="text" name="rate" class="form-control" id="rate" placeholder="Enter rate">
                        <span class="text-danger" id="error_rate"></span>
                    </div>
                    <div class="form-group">
                        <label for="rate">Is Default</label>
                        <div class="radio-theme-default custom-radio ">
                            <input class="radio" type="radio" name="is_default" value="1" id="yes" checked>
                            <label for="yes">
                                <span class="radio-text">Yes</span>
                            </label>
                        </div>
                        <div class="radio-theme-default custom-radio ">
                            <input class="radio" type="radio" name="is_default" value="0" id="no" checked>
                            <label for="no">
                                <span class="radio-text">No</span>
                            </label>
                        </div>
                        <span class="text-danger" id="error_rate"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="submitBtn">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ends: .modal-Basic -->
