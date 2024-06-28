@if(session('message'))
<div class="alert alert-info position-absolute top-50 start-50 translate-middle d-flex w-auto" style="z-index:9999;" role="alert">
    <p class="m-0 p-0 d-inline-block me-4">{{ session('message') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif