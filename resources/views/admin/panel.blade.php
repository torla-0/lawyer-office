<?php

use App\Models\CaseType;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

$caseTypes = Cache::get('caseTypes');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-black-op {
            background-color: rgb(0, 0, 0, 0.7);
        }
    </style>
</head>

<body class="container mt-5 position-relative">
    @include('components.success-message')
    @include('components.errors-message')
    <div class="row m-0 my-4 justify-content-between align-items-center border-bottom">
        <div class="col-auto">
            <h6 class="display-6">Admin panel</h6>
        </div>
        <div class="col-auto flex-grow-1">
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="btn btn-sm btn-outline-light border-start-0 border-top-0 border-end-0" type="submit">Logout</button>
            </form>
        </div>
        <div class="col-auto">
            <form class="input-group col flex-shrink-1" action="{{ route('user.search') }}" method="get">

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary rounded-end-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                    <input type="hidden" readonly name="f" value="">
                    <ul class="dropdown-menu text-center" id="idSearchParent">
                        <li><a class="dropdown-item" value="firstname">First name</a></li>
                        <li><a class="dropdown-item" value="lastname">Last name</a></li>
                        <li><a class="dropdown-item" value="email">Email</a></li>
                        <li><a class="dropdown-item" value="phone_number">Phone number</a></li>
                        <li><a class="dropdown-item" value="address">Address</a></li>
                        <li><a class="dropdown-item" value="city">City</a></li>
                    </ul>
                </div>
                <input type="text" class="form-control col" aria-label="Search" placeholder="Search" name="i" value="">
                <button class="btn btn-outline-primary " type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>



    <div class="row bg-black-op position-relative py-3 rounded" style="box-shadow: 0 5px 15px #6c757d;">
        <!-- user block -->
        <div class=" col-auto" id="addOptions">

            <div class="col-12 mb-4">

                <div class="nav-item btn-group" role="group" aria-label="Default button group">
                    <div class="dropdown btn-group">
                        <button class="btn btn-outline-primary border-end-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Show by Role
                        </button>
                        <ul class="dropdown-menu text-center">
                            @foreach($roles as $role)
                            <li>
                                <form class="" action="{{ route('user.search') }}" method="get">

                                    <input type="hidden" name="f" value="role">
                                    <input type="hidden" name="i" value="{{ $role->id }}">
                                    <button class="dropdown-item" type="submit">{{ $role->name }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('user.search') }}" method="get">

                        <button type="submit" class="btn btn-outline-primary rounded-start-0">All Clients
                            <input type="hidden" name="f" value="all">
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-12 mb-4" id="">
                <div class="btn-group" role="group" aria-label="Form & role group">
                    <span class="input-group-text rounded-end-0 bg-transparent border-primary border-top-0 border-bottom-0">Add</span>
                    <button type="button" class="btn btn-outline-primary" data-bs-target="#addUserByForm" data-bs-toggle="modal" aria-expanded="false" aria-controls="addUserByForm" data-bs-parent="#addParent">User by Form</button>
                </div>
            </div>
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="Role & id group">
                    <span class="input-group-text rounded-end-0 bg-transparent border-primary border-top-0 border-bottom-0">Add</span>
                    <button type="button" class="btn btn-outline-primary" data-bs-target="#addLawyerById" data-bs-toggle="modal" aria-expanded="false" aria-controls="addLawyerById" data-bs-parent="#addParent">Lawyer-role by ID</button>
                </div>
                <div class="btn-group" role="group" aria-label="Form & role group">
                    <button type="button" class="btn btn-outline-primary" data-bs-target="#editUserById" data-bs-toggle="modal" aria-expanded="false" aria-controls="#editUserById" data-bs-parent="#addParent">Edit User by ID</button>
                </div>

                <button type="button" class="btn btn-outline-primary" data-bs-target="#deleteUserById" data-bs-toggle="modal" aria-expanded="false" aria-controls="#deleteUserById" data-bs-parent="#addParent">Delete User by ID</button>
            </div>

        </div>
        <!-- Legal case buttons  -->
        <!--
        -->
        <div class="col-auto  position-absolute top-0 start-50 translate-middle-x py-3" id="displayLegalCase">

            <div class="nav-item btn-group col-auto" role="group" aria-label="Default button group">
                <div class="dropdown btn-group">
                    <button class="btn btn-outline-success border-end-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Status
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('status', ['param' => 'Open']) }}">Open</a></li>
                        <li><a class="dropdown-item" href="{{ route('status', ['param' => 'Closed']) }}">Closed</a></li>
                        <li><a class="dropdown-item" href="{{ route('status', ['param' => 'Pending']) }}">Pending</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-outline-success"><a href="{{ route('caseall', ['param' => 'all']) }}" style="text-decoration:none;" class="text-success">All Cases</a></button>
                <div class="dropdown btn-group">
                    <button class="btn btn-outline-success rounded-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Type
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end w-100">
                        @foreach($caseTypes as $caseType)
                        <li><a class="dropdown-item" href="{{ route('type', ['param' => $caseType->id]) }}">{{ $caseType->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Admin -->
        <div class=" col-auto ms-auto text-end" id="displayAdmin">
            <div class="col-12 mb-4">

                <div class="btn-group" role="group" aria-label="Admin buttons group">
                    <button type="button" class="btn btn-outline-danger" data-bs-target="#addAdminByForm" data-bs-toggle="modal" aria-expanded="false" aria-controls="#addAdminByForm">Add Admin by Form</button>
                </div>
            </div>

            <div class="col-12 mb-4">
                <button type="button" class="btn btn-outline-danger" data-bs-target="#m" data-bs-toggle="modal" aria-expanded="false" aria-controls="" data-bs-parent="#" disabled>Show All Changes</button>
            </div>
        </div>
    </div>
    <?php // Modals 
    ?>
    <?php // Add User Form         
    ?>

    <div class="modal fade" tabindex="-1" id="addUserByForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-header justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-outline-primary" type="submit">Register user</button>
                    </div>
                    <div class="modal-body">
                        <!-- Firstname -->
                        <div class="input-group mb-3">
                            <input name="firstname" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="firstname" placeholder="Firstname" required>
                        </div>
                        <!-- Lastname -->
                        <div class="input-group mb-3">
                            <input name="lastname" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="lastname" placeholder="Lastname" required>
                        </div>
                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input name="email" type="email" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="email" placeholder="Email" required>
                        </div>
                        <!-- Phone number -->
                        <div class="input-group mb-3">
                            <input name="phone_number" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="phone_number" placeholder="Phone_number" required>
                        </div>
                        <!-- Address -->
                        <div class="input-group mb-3">
                            <input name="address" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="address" placeholder="Address" required>
                        </div>
                        <!-- City -->
                        <div class="input-group mb-3">
                            <input name="city" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="city" placeholder="City" required>
                        </div>
                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input name="password" type="password" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="new-password" placeholder="Password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input name="confirm-password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="new-password" placeholder="Confirm password" required>
                        </div>
                        <!-- Role -->
                        <div class="input-group mb-3 justify-content-center">
                            <span class="input-group-text rounded-end-0 bg-transparent border-primary border-top-0 border-bottom-0 border-end-0">Role</span>
                            <div class="btn-group" role="group" aria-label="Role radio toggle group" id="idRadioBtnGroup">
                                <input name="role_id" value="1" type="hidden" readonly class="form-control" required>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary rounded-start-0" for="btnradio1" id="1">Client</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2" id="2">Staff</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">

                                <label class="btn btn-outline-primary" for="btnradio3" id="3" data-bs-target="#idLawyerFields" aria-controls="#idLawyerFields" aria-expanded="false" data-bs-toggle="collapse" role="button">Lawyer</label>

                            </div>

                        </div>
                        <!-- Lawyer fields -->
                        @if($role->name == 'Lawyer')@endif
                        <div class="collapse" id="idLawyerFields">
                            <div class="input-group mb-3">
                                <input name="specialization" value="" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="specialization" placeholder="Specialization" required>
                            </div>
                            <div class="input-group mb-3">
                                <input name="years_exp" value="" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="years_exp" placeholder="Years of exp" required>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Add Admin Form -->
    <div class="modal fade" tabindex="-1" id="addAdminByForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-header justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-outline-danger" type="submit">Register Admin</button>
                    </div>
                    <div class="modal-body">
                        <!-- Firstname -->
                        <div class="input-group mb-3">
                            <input name="firstname" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="firstname" placeholder="Firstname" required>
                        </div>
                        <!-- Lastname -->
                        <div class="input-group mb-3">
                            <input name="lastname" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="lastname" placeholder="Lastname" required>
                        </div>
                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input name="email" type="email" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="email" placeholder="Email" required>
                        </div>
                        <!-- Phone number -->
                        <div class="input-group mb-3">
                            <input name="phone_number" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="phone_number" placeholder="Phone_number" required>
                        </div>
                        <!-- Address -->
                        <div class="input-group mb-3">
                            <input name="address" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="address" placeholder="Address" required>
                        </div>
                        <!-- City -->
                        <div class="input-group mb-3">
                            <input name="city" type="text" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="city" placeholder="City" required>
                        </div>
                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input name="password" type="password" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input name="confirm-password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Confirm password" required>
                        </div>
                        <!-- Phrase -->
                        <div class="input-group mb-3">
                            <input name="pass_phrase" value="" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Admin: Pass phrase" required>
                        </div>
                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input name="password" type="password" value="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Admin: Password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input name="confirm-password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Admin: Confirm password" required>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @foreach($roles as $role)
    @if($role->name !== 'Client')
    <!-- Lawyer By Id -->
    <div class="modal fade" id="add{{ $role->name }}ById" tabindex="-1" aria-labelledby="add{{ $role->name }}ByIdLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('admin.update') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <button type="button" class="btn-close me-auto ms-0 " data-bs-dismiss="modal" aria-label="Close"></button>
                        <button class="btn btn-outline-primary">Add {{ $role->name }}</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Add user ID to apply role Lawyer">
                        <input type="text" class="form-control my-2" placeholder="Lawyer specialization" name="specialization" value="">
                        <input type="text" class="form-control" placeholder="Years of exp" name="yearsOfExp" value="">
                        <input type="hidden" class="form-control" placeholder="" readonly name="role_id" value="{{  $role->id }}">

                    </div>

                </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    <div class="modal fade d-none" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Lawyer-role by ID</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="User id">
                    <input type="text" class="form-control" placeholder="Lawyer id">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-outline-primary">Add Lawyer</button>
                </div>
            </div>
        </div>
    </div>

    <?php // Edit - odvoji komponentu user form pa je po potrebi ukljucuj  
    ?>
    <div class="row">
        <div class="col-12">
            <div class="modal fade" id="editUserById" tabindex="-1" aria-labelledby="editUserByIdLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            @csrf
                            @method('patch')
                            <div class="modal-header">
                                <button type="button" class="btn-close me-auto ms-0 " data-bs-dismiss="modal" aria-label="Close"></button>
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control" placeholder="User ID">
                                <small class="text-center d-block">In order to edit user data, first search</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php // Delete  
    ?>
    <div class="row">
        <div class="col-12">
            <div class="modal fade" id="deleteUserById" tabindex="-1" aria-labelledby="deleteUserByIdLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            @csrf
                            @method('patch')
                            <div class="modal-header">
                                <button type="button" class="btn-close me-auto ms-0 " data-bs-dismiss="modal" aria-label="Close"></button>
                                <button class="btn btn-outline-danger">Delete</button>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control" placeholder="User ID">
                                <small class="text-center d-block text-danger">Delete action is final, proceed with caution</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php // Search  
    ?>

    <script>
        // Collapse lawyer fields when other role button is clicked and  role_id value
        const radioBtnGroupParent = document.getElementById('idRadioBtnGroup');
        const radioButtons = radioBtnGroupParent.getElementsByTagName('label')
        for (var i = 0; i < radioButtons.length; i++) {
            radioButtons[i].addEventListener('click', function(e) {
                const lawyerFields = document.getElementById('idLawyerFields');
                if (lawyerFields.classList.contains('show') && e.target.textContent != 'Lawyer') {
                    radioBtnGroupParent.lastElementChild.click();
                }
                e.target.parentElement.firstElementChild.value = e.target.getAttribute('id');
            });
        }

        // Search fillter updating value for filter and input
        const parentSearch = document.getElementById('idSearchParent');
        const elemSearch = parentSearch.getElementsByTagName('li');
        for (let i = 0; i < elemSearch.length; i++) {

            elemSearch[i].addEventListener('click', function(e) {
                parentSearch.previousElementSibling.value = e.target.getAttribute('value')
                parentSearch.previousElementSibling.previousElementSibling.textContent = e.target.text;
            });
        }
    </script>
</body>

</html>