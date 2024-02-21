<div class="modal fade" id="modal-import-employee" tabindex="-1" role="dialog" aria-labelledby="modal-import-employee" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title" id="modal-title">Import Employee</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('import-employee') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="contentId" name="contentId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div>
                                <label for="file_employee" class="form-label">Upload File</label>
                                <input class="form-control" type="file" id="file_employee" name="file_employee" accept=".xlsx, .xls">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-auto" id="btn-submit">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>