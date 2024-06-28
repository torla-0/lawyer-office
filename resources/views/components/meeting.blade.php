<?php  // parent containenr
?>
<div class="row mt-4">
    <form action="{{ route('appointment.add') }}" method="post">
    @csrf
    <div class="col-auto input-group log-event"
      id="datetimepicker1"
      data-td-target-input="nearest"
      data-td-target-toggle="nearest">
      
      <span class="input-group-text lead">Looking for meeting, send us request</span>
      <span
        class="input-group-text"
        data-td-target="#datetimepicker1"
        data-td-toggle="datetimepicker">
        
        <i class="bi bi-calendar"></i>
      </span>
      <input
        id="datetimepicker1Input"
        type="text"
        class="form-control col"
        data-td-target="#datetimepicker1"/>
        <input type="hidden" name="date" value="">
        <input type="hidden" name="time" value="">
        @if(strtolower($user->role->name) == 'client')
          <select name="lawyer_id" id="" class="input-group-text">
            <option value="">Lawyer</option>
            @foreach($lawyers as $lawyer)
            <option value="{{ $lawyer->id }}">{{ $lawyer->user->firstname}} {{ $lawyer->user->lastname }}</option>
            @endforeach
          </select>
        @elseif (strtolower($user->role->name) == 'lawyer')
          <select name="user_id" id="" class="input-group-text">
            <option value="">Client</option>
            @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->firstname}} {{ $client->lastname }}</option>
            @endforeach
          </select>
        @endif
        
    </div>
    <div class="col-12 input-group mt-2">
      <span class="input-group-text">Agenda</span>
      <input type="text" class="form-control" name="agenda">
      <button class="btn btn-outline-primary" type="submit">Request</button>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-12 mt-4">
      <p class="lead py-1 my-2 mb-2 px-2 border-bottom col-12">Schedule</p>
  </div>
  <?php 
// TODO: fix css 
  ?>
    @foreach($meetings as $meeting)
  <div class="row mx-2 align-items-center my-2 border-start rounded border-secondary 
  {{ ($meeting->status == 'confirmed')? 'border-success' : ''; }}
  {{ ($meeting->status == 'cancelled')? 'border-danger' : ''; }}">
    <p class="col p-0 m-0 d-inline-block">Date: {{ $meeting->date }}</p>
    <p class="col p-0 m-0 d-inline-block">Time: {{ $meeting->time}} </p>
    <p class="col p-0 m-0 d-inline-block">Lawyer: {{ $meeting->lawyer->user->firstname}} {{ $meeting->lawyer->user->lastname}}</p>
    <p class="col p-0 m-0 d-inline-block">Status: {{ ucfirst($meeting->status) }}</p>
    @if(strtolower($user->role->name) == 'lawyer')
      <form id="update-form-{{ $meeting->id }}" action="{{ route('appointment.update', ['id' => $meeting->id]) }}" method="POST" class="w-auto">
      @csrf
      @method('PUT')
        <input type="hidden" name="status" id="status-{{ $meeting->id }}" value="">
        @if($meeting->status == 'pending')
          <button type="button" onclick="setStatus('{{ $meeting->id }}', 'confirmed')" class="btn btn-sm btn-outline-primary">Confirm</button>
        @elseif($meeting->status == 'confirmed')
        <button type="button" onclick="setStatus('{{ $meeting->id }}', 'cancelled')" class="btn btn-sm btn-outline-secondary">Cancel</button>
        @endif
        <button type="submit" style="display: none;">Submit</button>
      </form>
<!-- --------------------------------------------------------------------------------------------------------------------------- -->
      @elseif(strtolower($user->role->name) == 'client' && $meeting->status == 'confirmed')
      <form id="update-form-{{ $meeting->id }}" action="{{ route('appointment.update', ['id' => $meeting->id]) }}" method="POST" class="w-auto">
      @csrf
      @method('PUT')
        <input type="hidden" name="status" id="status-{{ $meeting->id }}" value="">
        <button type="button" onclick="setStatus('{{ $meeting->id }}', 'cancelled')" class="btn btn-sm btn-outline-secondary">Cancel</button>
        <button type="submit" style="display: none;">Submit</button>
      </form>
    @endif
    <p class="col-12 p-0 m-0">Agenda: {{ $meeting->agenda }}</p>
  </div>
  @endforeach
</div>




<!--
  <button type="button" class="col-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Request
    </button>
-->
<!-- Modal - show for form 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Fill the form and we will get back to u</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="col-sm-12">
      <label for="datetimepicker1Input" class="form-label">Picker</label>
      
      
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
-->

<script>
  
  const mainInput = document.getElementById('datetimepicker1Input');

  mainInput.addEventListener('change', function(){
    let values = mainInput.value.split(' ');
    mainInput.nextElementSibling.value = values[0].trim();
    mainInput.nextElementSibling.nextElementSibling.value = values[1].trim();
  });
  
    function setStatus(meetingId, status) {
        document.getElementById('status-' + meetingId).value = status;
        document.getElementById('update-form-' + meetingId).submit();
    }

</script>