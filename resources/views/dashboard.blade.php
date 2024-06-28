<?php

use Illuminate\Support\Facades\Cache;

$caseTypes = Cache::get('caseTypes');
?>
<x-app-layout>
    <x-slot name="header">
        @if($user->isLawyer())
        @include('workbench')
        @endif
    </x-slot>

    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded container mb-2 h-100 position-relative">
        @include('components.success-message')
        @include('components.errors-message')

        @if(Auth::user()->role->name == 'Client')
        @include('client.client-dash')
        @elseif(Auth::user()->role->name == "Lawyer")
        @include('lawyer.lawyer-dash')
        @elseif(Auth::user()->role->name == "Staff")

        @else

        @endif
    </div>

</x-app-layout>