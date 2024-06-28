<?php

?>
<style>

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    border-color: #0d6efd #0d6efd transparent #0d6efd;
  }
</style>
<div class="row">
  <ul class="nav nav-tabs border-primary" id="idInsideNavbar">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page"
      data-bs-toggle="collapse" href="#caseOverview" role="button" aria-expanded="true" aria-controls="caseOverview">Cases</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" aria-current="page"
      data-bs-toggle="collapse" href="#schedule" role="button" aria-expanded="false" aria-controls="schedule">Schedule</a>
    </li>
  </ul>
</div>

<div id="collapseParent">
  
  <div class="row collapse show" id="caseOverview" data-bs-parent="#collapseParent">
    <div class="row my-2 py-2">
    <div class="col-12 d-flex ">
      <p class="lead p-0 m-0 d-inline-block mx-auto"><strong>  Open </strong> cases</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-auto">{{ $legalCases }}</div>
    </div>
  </div>
    <div class="accordion accordion-flush" id="accordionFlushParent">
      @foreach($legalCases as $legalCase)
      <div class="accordion-item border-0">
        <h2 class="accordion-header border-primary border-end border-5">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $legalCase->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $legalCase->id }}">
            <p class="lead p-0 m-0">Title: {{ $legalCase->title }}</p>
          </button>
        </h2>
        <div id="flush-collapse{{ $legalCase->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushParent">
          <div class="accordion-body">
            <div class="row">
              <div class="card px-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <p class="p-0 m-0 d-inline-block">ID: {{ $legalCase->user->id }}</p>
                  <p class="p-0 m-0 d-inline-block">First name: {{ ucfirst($legalCase->user->firstname) }}</p>
                  <p class="p-0 m-0 d-inline-block">Last name: {{ ucfirst($legalCase->user->lastname) }}</p>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="p-0 m-0 d-inline-block">ID: {{ $legalCase->id }}</p>
                    <p class="p-0 m-0 d-inline-block">Type: {{ $legalCase->caseType->name }}</p>
                    <p class="p-0 m-0 d-inline-block">Status: {{ ucfirst($legalCase->status) }}</p>
                    <p class="p-0 m-0 d-inline-block">Create: {{ $legalCase->created_at->format('d-m-Y') }}</p>
                    <p class="p-0 m-0 d-inline-block">Start: {{ $legalCase->start_date }}</p>

                  </div>
                  <p class="card-text my-2"><strong>Description: </strong>{{ $legalCase->description }}</p>
                  <?php //<a href=" route('details', ['legalCase' => $legalCase]) " class="btn btn-sm btn-outline-primary">Case details</a>
                  ?>
                  <a href="{{ route('details', ['id' => $legalCase->id]) }}" class="btn btn-sm btn-outline-primary">Case details</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <?php  
  //////////////////////////////// Meetings
  ?>

  <div class="row collapse" id="schedule" data-bs-parent="#collapseParent">
    @include('components.meeting')
  </div>
</div>

<script>
  
  const parent = document.getElementById('idInsideNavbar');
  const elems = parent.getElementsByTagName('a');
    for (let i = 0; i < elems.length; i++) {
      elems[i].addEventListener('click', function(event){
        setCssClass(event);
      })
    };

  function setCssClass(e){
    if(!e.target.classList.contains('active')){
      for (let i = 0; i < elems.length; i++) {
        elems[i].classList.remove('active');
      } 
      e.target.classList.add('active');
    }else{
      e.target.classList.remove('active');
    }
  }
</script>