<?php


?>

<x-app-layout>
    <div class="container">
        <div class="row my-2 py-2">
            <div class="col-12 d-flex ">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back</a>
                <p class="lead p-0 m-0 d-inline-block mx-auto" style="transform:translateX(-50%);">Searched by <strong>{{ ucfirst($filter) }}</strong></p>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">{{ $legalCases }}</div>
            </div>
        </div>

        <div class="row my-4">
            <div class="accordion accordion-flush border-bottom border-start py-2 rounded" id="accordionFlushParent">
                @foreach($legalCases as $legalCase)
                <div class="accordion-item border-0">
                    <h2 class="accordion-header border-top border-end">
                        <button class="accordion-button collapsed border-end border-5 
                        {{ ($legalCase->status == 'open')?'border-primary':'border-secondary';}}
                        {{ ($legalCase->status == 'closed')?'border-success':'';}}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $legalCase->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $legalCase->id }}">
                            <p class="lead p-0 m-0">Title: {{ ucfirst($legalCase->title) }}</p>
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $legalCase->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushParent">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="card px-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <p class="p-0 m-0 d-inline-block">ID: {{ $legalCase->user->id }}</p>
                                        <p class="p-0 m-0 d-inline-block">Client: {{ ucfirst($legalCase->user->getFullName()) }}</p>
                                        <p class="p-0 m-0 d-inline-block">Date: {{ $legalCase->created_at->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="p-0 m-0 d-inline-block">ID: {{ $legalCase->id }}</p>
                                            <p class="p-0 m-0 d-inline-block">Type: {{ ucfirst($legalCase->caseType->name) }}</p>
                                            <p class="p-0 m-0 d-inline-block">Status: {{ ucfirst($legalCase->status) }}</p>
                                            @if($legalCase->status == 'open')
                                            <p class="p-0 m-0 d-inline-block">Lawyer: {{ ucfirst($legalCase->lawyer->user->getFullName()) }}</p>
                                            <p class="p-0 m-0 d-inline-block">Date: {{ $legalCase->start_date }}</p>
                                            @endif
                                        </div>
                                        <p class="card-text my-2"><strong>Description: </strong>{{ $legalCase->description }}</p>
                                        @if($legalCase->status == 'pending')
                                        <div class="div d-flex justify-content-around">
                                            <a href="{{ route('accept', ['id' => $legalCase->id])}}" class="btn btn-sm btn-outline-primary">Accept Case</a>
                                            <a href="{{ route('decline', ['id' => $legalCase->id])}}" class="btn btn-sm btn-outline-secondary">Decline Case</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>