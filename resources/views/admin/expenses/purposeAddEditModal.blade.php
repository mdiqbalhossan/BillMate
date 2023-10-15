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
                    <input type="hidden" name="id" id="purpose_id">
                    <div class="form-group">
                        <label for="name">Purpose Name <span class="text-danger">(*)</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                        <span class="text-danger" id="error_name"></span>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="description">Description </label>
                        <textarea class="form-control" id="description" name="description" placeholder="Please Write your description" rows="3"></textarea>
                        <span class="text-danger" id="error_description"></span>
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
