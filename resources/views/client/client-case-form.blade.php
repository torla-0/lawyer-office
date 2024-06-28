<?php

use App\Models\CaseType;
use Illuminate\Support\Facades\Cache;


?>

  <form action="{{ route('store') }}" method="POST">
    @csrf
    <p class="lead py-1 my-2 mb-4 px-2 border-bottom col-12">Please, include as much detaiils as possible</p>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="input-group mb-3">
      <label class="input-group-text" for="inputGroupSelect01">Case type</label>
      <select class="form-select" id="case_type_id" name="case_type_id">
      @isset($caseTypes)  
        @foreach($caseTypes as $caseType)
          <option name="" value="{{ $caseType->id }}">{{ $caseType->name }}</option>
        @endforeach
      @endisset
      </select>
    </div>

  
  <div class="input-group mb-3">
    <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
    <input name="title" type="text" class="form-control" aria-label="Sizing example input" 
    aria-describedby="inputGroup-sizing-default" required>
  </div>
  <div class="input-group">
    <span class="input-group-text">Description</span>
    <textarea name="description" value="" class="form-control" aria-label="With textarea" required></textarea>
  </div>

<div>
  <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>

</div>

</form>
