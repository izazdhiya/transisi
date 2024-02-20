<div class="modal fade" id="modal-company-form" tabindex="-1" role="dialog" aria-labelledby="modal-company-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title" id="modal-title">New Company</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="name">Company Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Company Name">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="company@example.com">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="logo">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo" accept="image/jpeg, image/png, image/gif">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="website">Website</label>
                        <input class="form-control" id="website" name="website" type="text" placeholder="https://example.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary ms-auto" id="btn-submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>