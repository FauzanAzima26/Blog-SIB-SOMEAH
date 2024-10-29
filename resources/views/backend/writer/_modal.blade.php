<!-- Modal -->
<div class="modal fade" id="modalWriter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modalTitle" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formWriter">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="is_verified" class="form-label">Verify</label>
                        <select name="is_verified" id="is_verified" class="form-select">
                            <option value="1">Verified</option>
                            <option value="0">Unverified</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="formWriter" class="btn btn-primary btnSubmit"></button>
            </div>
        </div>
    </div>
</div>