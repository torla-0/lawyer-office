@foreach($errors->all() as $error)
<div class="alert alert-danger position-absolute top-50 start-50 translate-middle d-flex w-auto" style="z-index:9999;" role="alert">
    <p class="m-0 p-0 d-inline-block me-4">{{ $error }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach