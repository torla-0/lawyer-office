<!-- parent - row -->
<div class="row my-4">
    <div class="col-12">
        <h6 class="lead my-2 mb-4">Submit request for your personal information removal</h6>
    </div>
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete account</button>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to <span class="text-danger">delete</span> your account?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <form method="post" action="{{ route('profile.destroy') }}" class="col">
                            @csrf
                            @method('delete')
                            <div class="input-group">
                                <input type="password" name="password" value="" class="form-control border-end-0" placeholder="Enter your password" required>
                                <button type="submit" class="btn btn-outline-danger text-center">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>