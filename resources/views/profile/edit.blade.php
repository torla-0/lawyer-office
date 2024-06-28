<x-app-layout>
    <div class="container mb-5">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h6 class="display-6">Settings</h6>
            </div>
        </div>
        @include('components.success-message')
        @include('components.errors-message')

        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>



</x-app-layout>