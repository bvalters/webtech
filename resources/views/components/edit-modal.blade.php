
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-item-id="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __("modal.edit.title") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="file-name" class="col-form-label">{{ __("modal.edit.filename") }}</label>
                        <input type="text" class="form-control" id="file-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("modal.close") }}</button>
                <button type="button" class="btn btn-primary" id="modal-save">{{ __("modal.save") }}</button>
            </div>
        </div>
    </div>
</div>
