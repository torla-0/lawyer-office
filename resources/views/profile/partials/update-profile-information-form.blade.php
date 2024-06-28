<div class="row">
    <div class="col-12">
        <h6 class="lead my-2 mb-4">Update Profile Information</h6>
    </div>


    <div class="col-12">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @method('patch')
            <?php $x = 1 ?>
            <input type="hidden" name="id" value="{{ $user->id }}">
            <!-- Firstname -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">Firstname</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->firstname }}</span>
                <input name="firstname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->firstname }}">
            </div>

            <!-- Lastname -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ++$x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">Lastname</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->lastname }}</span>
                <input name="lastname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->lastname }}">
            </div>
            <!-- Email -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ++$x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">Email</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->email }}</span>
                <input name="email" type="email" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->email }}">
            </div>
            <!-- Phone number -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ++$x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">Phone number</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->phone_number }}</span>
                <input name="phone_number" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->phone_number }}">
            </div>
            <!-- Address -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ++$x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">Address</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->address }}</span>
                <input name="address" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->address }}">
            </div>
            <!-- City -->
            <div class="input-group mb-3 dropend">
                <button class="input-group-text col-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ ++$x }}" aria-expanded="false" aria-controls="collapse{{ $x }}">City</button>

                <span class="input-group-text col-auto collapse collapse-horizontal" id="collapse{{ $x }}">{{ $user->city }}</span>
                <input name="city" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="collapse{{ $x }}" required value="{{ $user->city }}">
            </div>
            <div class="input-group mb-3 justify-content-center">

                <button class="btn btn-outline-light" type="submit" id="button-addon2">Update</button>
            </div>

        </form>

    </div>
</div>