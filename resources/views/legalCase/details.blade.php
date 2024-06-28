<x-app-layout>

    <section class="container mt-3 mb-1 shadow-lg px-4 mb-5 bg-body-tertiary rounded">
        <div class="row align-items-center my-2 py-2 border-bottom">
            <div class="col-auto">
                <a class="btn btn-outline-primary" href="{{route('dashboard') }}">Back</a>
            </div>
            <div class="col-auto flex-grow-1 text-center">
                <h6 class="display-6">Case Overview </h6>
            </div>
            @if($selectedCase->status === 'open')
            <div class="col-auto">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">Add note</button>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('add') }}" method="post">
                            @csrf
                            <div class="modal-header justify-content-between">
                                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                <button type="submit" class="btn btn-outline-info">Add</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="legal_case_id" value="{{ $selectedCase->id }}">
                                <input type="text" aria-label="Title" placeholder="Title" name="title" class="form-control mb-2">
                                <textarea class="form-control" aria-label="Add note textarea" name="content" placeholder="..."></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ---------------------------------------------------------------- -->
            @if(Auth::user()->isLawyer())
            <div class="col-auto">
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#closeCaseModal">Close case</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="closeCaseModal" tabindex="-1" aria-labelledby="closeCaseModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('add') }}" method="post">
                            @csrf
                            <div class="modal-header justify-content-between">
                                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                <a href="{{ route('decline', ['id' => $selectedCase->id])}}" class="btn btn-outline-danger">Close case</a>
                            </div>
                            <div class="modal-body">
                                <p class="lead p-0 m-2">Are you sure you want to close this case?</p>
                            </div>

                    </div>
                </div>
            </div>
            @endif
            <!-- ---------------------------------------------------------------- -->
            @endif
        </div>
        <div class="row position-relative justify-content-end">
            <div class="col-auto my-4" id="informationParent">
                <div class="btn-group" role="group" aria-label="Information group">
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClientInformation" aria-expanded="false" aria-controls="collapseClientInformation">
                        Client information
                    </button>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCaseInformation" aria-expanded="false" aria-controls="collapseCaseInformation">
                        Case information
                    </button>
                </div>
                <div class="col-auto">
                    <div class="collapse position-absolute top-0 start-0" id="collapseClientInformation" data-bs-parent="#informationParent">
                        <div class="card card-body">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">{{ $selectedCase->user->getFullName() }}</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">{{ $selectedCase->user->email }}/{{ $selectedCase->user->phone_number }}</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">{{ $selectedCase->user->address}}, {{ $selectedCase->user->city}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="collapse position-absolute top-0 start-0" id="collapseCaseInformation" data-bs-parent="#informationParent">
                        <div class="card card-body">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Type: {{ $selectedCase->caseType->name }}</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">Status: {{ ucfirst($selectedCase->status) }}</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">Date: {{ $selectedCase->created_at->format('Y-m-d') }}</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">In process: {{ $selectedCase->start_date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4 border-bottom pb-2 mb-5">
            <h6 class="h3 text-center">About</h6>
            <div class="col-12"><span class="border-bottom border-light">Title:</span> {{ $selectedCase->title }}</div>
            <div class="col-12"><span class="border-bottom border-light">Description:</span> {{ $selectedCase->description }}</div>
        </div>
        <div class="row mb-5 position-relative">
            @include('components.success-message')
            @include('components.errors-message')
            @foreach($notes as $note)
            <div class="mb-5">
                <div class="row justify-content-between border-bottom border-start">
                    <p class="col-auto py-0 my-0 d-inline-block">Title: {{ $note->title }}</p>
                    <p class="col-auto py-0 my-0 d-inline-block">Date: {{ $note->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="row border-end">
                    <div class="col-12 mt-2">{{ $note->content }}</div>
                </div>
            </div>
            @endforeach
            <div class="col-auto mx-auto">
                {{ $notes }}
            </div>
        </div>
    </section>
</x-app-layout>