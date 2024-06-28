<?php
$count = 0;

?>

<x-app-layout>
    <div class="container">
        <div class="row my-2 py-2">
            <div class="col-12 d-flex ">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back</a>
                <p class="lead p-0 m-0 d-inline-block mx-auto" style="transform:translateX(-50%);">Searched by <strong>{{ ucfirst($filter) }}</strong></p>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">{{ $users->appends(['f' => $filter, 'i' => $input])->links() }}</div>
            </div>
        </div>
        @if(session('message'))
        <div class="alert alert-info position-absolute top-50 start-50 translate-middle w-auto" style="z-index:9999;" role="alert">
            <p class="m-0 p-0 d-inline-block me-4">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row my-4">
            <div class="accordion accordion-flush border-bottom border-start py-2 rounded" id="accordionFlushParent">
                @foreach($users as $user)
                <div class="accordion-item border-0">
                    <h2 class="accordion-header border-top">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $user->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $user->id }}">
                            <p class="p-0 m-0 lead">Name: {{ $user->getFullname() }}</p>
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $user->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushParent">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="card px-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <p class="p-0 m-0 d-inline-block">ID: {{ $user->id }}</p>
                                        <p class="p-0 m-0">First name: {{ $user->firstname }}</p>
                                        <p class="p-0 m-0">Last name: {{ $user->lastname }}</p>
                                        <p class="p-0 m-0">Email: {{ $user->email }}</p>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="p-0 m-0 d-inline-block">Ph num: {{ $user->phone_number }}</p>
                                            <p class="p-0 m-0 d-inline-block">Address: {{ $user->address }}</p>
                                            <p class="p-0 m-0 d-inline-block">City: {{ $user->city }}</p>
                                            <p class="p-0 m-0 d-inline-block">Date: {{ $user->created_at->format('d-m-Y') }}</p>
                                        </div>
                                        @if(Auth::user()->isAdmin())
                                        <div class="border-top mt-2">
                                            <p class="p-0 m-0 d-inline-block">Role: {{ $user->role->name }}</p>
                                            <span class="mx-2"></span>
                                            <p class="p-0 m-0 d-inline-block">Remember token: {{ $user->remember_token }}</p>
                                            <p class="card-text my-2"><strong>Password: </strong>{{ $user->password }}</p>
                                            <div class="mt-2 text-end">
                                                <button type="button" class="btn btn-small btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}">Edit</button>
                                                <button type="button" class="btn btn-small btn-outline-danger ms-4" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}">Delete</button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin())
                    <!-- Modal for editing -->
                    <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    <div class="modal-header justify-content-between">
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- ID -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">ID</span>
                                            <input name="id" type="text" value="{{ $user->id }}" class="form-control border-start-0 text-end" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="ID" required readonly>
                                        </div>
                                        <!-- Firstname -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Firstname</span>
                                            <input name="firstname" type="text" value="{{ $user->firstname }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Firstname" required>
                                        </div>
                                        <!-- Lastname -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Lastname</span>
                                            <input name="lastname" type="text" value="{{ $user->lastname }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Lastname" required>
                                        </div>
                                        <!-- Email -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Email</span>
                                            <input name="email" type="email" value="{{ $user->email }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Email" required>
                                        </div>
                                        <!-- Phone number -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Phone number</span>
                                            <input name="phone_number" type="text" value="{{ $user->phone_number }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Phone number" required>
                                        </div>
                                        <!-- Address -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Address</span>
                                            <input name="address" type="text" value="{{ $user->address }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Address" required>
                                        </div>
                                        <!-- City -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">City</span>
                                            <input name="city" type="text" value="{{ $user->city }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="City" required>
                                        </div>
                                        <!-- Password -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent border-end-0" id="inputGroup-sizing-default">Password</span>
                                            <input name="password" type="text" value="{{ $user->password }}" class="form-control border-start-0 text-end selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Password" autocomplete="password" required>
                                        </div>

                                        <!-- Role -->
                                        <div class="input-group mb-3 justify-content-center">
                                            <span class="input-group-text rounded-end-0 bg-transparent border-primary border-top-0 border-bottom-0 border-end-0">Role</span>

                                            <div class="btn-group" role="group" aria-label="Role radio toggle group" id="radioBtnGroupParent{{ $count }}">
                                                <input name="role_id" value="{{ $user->role->id }}" type="hidden" readonly class="form-control" required>

                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1-{{ $count }}" {{ $user->isClient()?'checked': '' ;}}>
                                                <label class="btn btn-outline-primary rounded-start-0" for="btnradio1-{{ $count }}" id="1">Client</label>

                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2-{{ $count }}" {{ $user->isStaff()?'checked': '' ;}}>
                                                <label class="btn btn-outline-primary" for="btnradio2-{{ $count }}" id="2">Staff</label>

                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3-{{ $count }}" {{ $user->isLawyer()?'checked': '' ;}}>

                                                <label class="btn btn-outline-primary" for="btnradio3-{{ $count }}" id="3" data-bs-target="#idLawyerFields" aria-controls="#idLawyerFields" aria-expanded="false" data-bs-toggle="collapse" role="button">Lawyer</label>

                                            </div>
                                            <?php $count++ ?>
                                        </div>
                                        <!-- Lawyer fields -->
                                        <div class="collapse" id="idLawyerFields">
                                            <div class="input-group mb-3">
                                                <input name="specialization" value="{{ $user->lawyer?->specialization }}" type="text" class="form-control selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="specialization" placeholder="Specialization">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input name="years_exp" value="{{ $user->lawyer?->years_of_exp }}" type="text" class="form-control selectTextClass" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="years_exp" placeholder="Years of exp">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete modal -->
                    <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserModal{{$user->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header justify-content-between">
                                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <span class="bg-transparent border-end-0 input-group-text">ID:</span>
                                            <input type="text" class="form-control border-start-0 text-center" placeholder="User ID" name="user_id" value="{{ $user->id }}" readonly>
                                        </div>
                                        <div class="input-group my-2">
                                            <span class="bg-transparent border-end-0 input-group-text">Name:</span>
                                            <input type="text" class="form-control border-start-0 text-center" placeholder="User name" name="fullname" value="{{ $user->getFullName() }}" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="bg-transparent border-end-0 input-group-text">Email:</span>
                                            <input type="text" class="form-control border-start-0 text-center" placeholder="Email" name="email" value="{{ $user->email }}" readonly>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <small class="text-center d-block text-danger">Delete action is final, proceed with caution</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

</x-app-layout>


<script>
    //  
    // Collapse lawyer fields when other role button is clicked and  role_id value - pagination value is 10

    for (let j = 0; j < 10; j++) {
        let radioBtnGroupParent = document.getElementById('radioBtnGroupParent' + j);
        let radioButtons = radioBtnGroupParent.getElementsByTagName('label')
        for (var i = 0; i < radioButtons.length; i++) {
            radioButtons[i].addEventListener('click', function(e) {
                const lawyerFields = document.getElementById('idLawyerFields');
                if (lawyerFields.classList.contains('show') && e.target.textContent != 'Lawyer') {
                    radioBtnGroupParent.lastElementChild.click();
                }
                e.target.parentElement.firstElementChild.value = e.target.getAttribute('id');
            });
        }
    }
    // Select text on edit input field
    let editUserInputFields = document.getElementsByClassName('selectTextClass');
    for (let i = 0; i < editUserInputFields.length; i++) {
        editUserInputFields[i].addEventListener('click', function(e) {
            e.target.select();
        });
        try {
            editUserInputFields[i].addEventListener('focus', function(e) {
                e.target.select();
            });
        } catch (Exception) {
            console.log(Exception);
        }
    }
</script>