<!-- parent - row -->
<div class="row my-4">
    <div class="col-12">
        <h6 class="lead my-2 mb-4">Ensure your account is using a long password to stay secure</h6>
    </div>
    <div class="col-12">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            @method('put')

            <div class="input-group mb-3 dropend">
                <span class="input-group-text col-auto">Current Password</span>
                <input name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                <span class="input-group-text col-auto">New Password</span>
                <input name="password" type="password" class="form-control" autocomplete="new-password" required>
                <span class="input-group-text col-auto">Confirm Password</span>
                <input name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
            </div>
            <div class="input-group mb-3 justify-content-center">
                <button class="btn btn-outline-light" type="submit">Change</button>
            </div>
        </form>
    </div>
</div>