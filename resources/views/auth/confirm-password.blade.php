<x-guest-layout>
    <section class="vw-100 vh-100">
    

    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btnTriggerMe">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</h1>
        
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('password-confirm') }}">
        @csrf
        <input type="password" name="password" class="form-control mb-2" value="" id="password" required autocomplete="current-password">
        <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary" >Confirm</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
</section>



<script>
    window.addEventListener("load", (event) => {
  
  document.getElementById('btnTriggerMe').click();
});
</script>
</x-guest-layout>
