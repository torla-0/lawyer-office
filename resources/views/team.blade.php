<?php
$count = '1';
$url = asset('assets/img/lawyer-1.jpg');
?>
<x-guest-layout>

    <div class="container p-3 mb-5 bg-transparent rounded mt-4">
        <div class="row my-2 mb-4">
            <h6 class="display-6 text-center">Meet the Team</h6>
            <small class="text-end"><i>Our advice is - "Hold on tight and enjoy the ride"</i></small>
        </div>
        <div class="row justify-content-around">

            @foreach($lawyers as $key => $lawyer)

            <div class="card mb-4 px-0 rounded border-0 position-relative" style="width: 18rem;">
                <div class="rounded m-2 p-0  position-absolute bottom-0 start-0 btnMeetTeam">
                    <button class="w-auto btn btn-outline-dark text-white" type="button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLawyerInfo{{ $lawyer->user->id }}" aria-expanded="false" aria-controls="collapseLawyerInfo{{ $lawyer->user->id }}">More</button>
                </div>
                <?php $x = asset('assets/img/team/lawyer-' . (($count == 5) ? $count = 1 : $count) . '.jpg'); ?>
                <div class="rounded" style="background-image: url('{{$x}}');width: 100%;
    height: 0;
    padding-top: 136.25%; 
    background-size: cover;
    background-position: center;
"></div>

                <div class="card-body collapse  position-absolute top-0 start-0 bg-dark" style="--bs-bg-opacity: .5;" id="collapseLawyerInfo{{ $lawyer->user->id }}">
                    <h5 class="card-title">{{ ucfirst($lawyer->user->getFullname()) }}</h5>
                    <p class="card-text">Add lawyer description - text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="card-text">{{ ucfirst($lawyer->specialization) }}</p>
                </div>
            </div>
            <?php ++$count ?>

            @endforeach

        </div>
    </div>
</x-guest-layout>