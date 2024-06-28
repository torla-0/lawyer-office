<x-guest-layout>
<div class="container w-50 d-flex flex-column bg-transparent position-absolute top-50 start-50 translate-middle" style="margin-top: -50px;">
    <div class="row w-100 justify-content-start align-items-end">
            <p class="p-0 m-0 lead w-auto text-start d-inline-block">Register</p>
            <a href="{{ route('home') }}" class="fs-1 w-auto d-inline-block mx-auto translate-middle-x">@include('components.application-logo')</a>
    </div>
    <form method="POST" action="{{ route('register') }}" class="row border-top py-2 needs-validation" novalidate>
        @csrf        
        <!-- Firstname -->
        <div class="input-group mb-3">
            <input name="firstname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required placeholder="Firstname">
        </div>
        <!-- Lastname -->
        <div class="input-group mb-3">
            <input name="lastname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required placeholder="Lastname">
        </div>
        <!-- Email -->
        <div class="input-group mb-3">
            <input name="email" type="email" class="form-control" aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-default" required placeholder="Email">
        </div>
        <!-- Phone number -->
        <div class="input-group mb-3">
            <input name="phone_number" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required placeholder="Phone number">
        </div>
        <!-- Address -->
        <div class="input-group mb-3">
            <input name="address" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required placeholder="Address">
        </div>
        <!-- City -->
        <div class="input-group mb-3">
            <input name="city" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required placeholder="City">
        </div>
        <!-- Password -->
        <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required autocomplete="new-password" required placeholder="Password">
        </div>
        <div class="input-group mb-3">
            <input name="confiirm-password" type="password"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
            required autocomplete="new-password" required placeholder="Confirm password">
        </div>
        <div class="input-group mb-3 justify-content-center">
            <button class="btn btn-outline-light px-4" type="submit">Register</button>
        </div>
    </form>    
</div>
</x-guest-layout>
