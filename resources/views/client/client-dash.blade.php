<?php // Dashboard / parent - container ?>
<div class="row w-100">
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item mx-1">
                <p class="d-inline-flex gap-1">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExampleOne" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Start Case
                </a>
                </p>
            </li>
            <li class="nav-item mx-1">
                <p class="d-inline-flex gap-1">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExampleTwo" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Overview
                </a>
                </p>
            </li>
            <li class="nav-item mx-1">
                <p class="d-inline-flex gap-1">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExampleThree" role="button" `aria-expanded="false" aria-controls="collapseExample">
                    Meeting
                </a>
                </p>
            </li>
            
        </ul>
        <div class="collapse" id="collapseExampleOne">
            <div class="card card-body">
            @include('client.client-case-form')           
            </div>
        </div>
        <div class="collapse" id="collapseExampleTwo">
            <div class="card card-body d-flex justify-content-around">
            @include('legalCase.overview')           
            </div>
        </div>
        <div class="collapse" id="collapseExampleThree">
            <div class="card card-body d-flex justify-content-around">
            @include('components.meeting')           
            </div>
        </div>
    </div>
</div>

<!--
<p class="d-inline-flex gap-1">
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>
-->