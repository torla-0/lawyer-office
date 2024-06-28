<x-guest-layout>
    <div class="container w-50 d-flex flex-column bg-transparent position-absolute top-50 start-50 translate-middle position-relative" style="margin-top: -50px;">
        @include('components.success-message')
        @include('components.errors-message')
        <div class="row w-100 justify-content-center">
            <div class="col-auto p-0" style="height:60px;width:60px;">
                <span class="h-auto w-auto">
                    <a href="{{ route('home') }}" class="fs-1">@include('components.application-logo')</a>
                </span>
            </div>

        </div>
        <form method="POST" action="{{ route('login') }}" class="row border-top py-4 needs-validation" novalidate>
            @csrf
            <!-- Email -->
            <div class="input-group mb-3">
                <input name="email" type="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required placeholder="Email">
            </div>

            <!-- Password -->
            <div class="input-group mb-3">

                <input name="password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required autocomplete="-password" required placeholder="Password">
            </div>

            <div class="row justify-content-center align-items-center">

                <div class="col-auto">
                    <button class="btn btn-outline-light px-4 fs-6" type="submit">Log in</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>