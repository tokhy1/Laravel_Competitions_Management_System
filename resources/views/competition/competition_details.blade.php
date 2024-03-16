@extends('components.navbar')

@section('title')
    Competition Details
@endsection

@section('content')
    <div class="container">
        <div class="sub-container">
            <div class="details-content">
                <div class="image">
                    <img src="{{ asset('images/competitions_details/competition_logo.png') }}" alt="">
                </div>
                <div class="texts">
                    <h1>{{ $competition->competition_name }}</h1>
                    <p>
                        {{ $competition->description }}
                    </p>

                    @if ($status == 'participated')
                        <a class="btn" href="/competition-rank/{{ $competition->id }}"
                            style="background-color: #379AE6;color:white">Show My Rank</a>
                    @elseif ($status == 'not participated')
                        <a class="btn" href="/competition-showregister/{{ $competition->id }}"
                            style="background-color: #379AE6;color:white">Apply</a>
                    @elseif ($status == 'completed')
                        <p class="text-danger">* Complete number of submissions for this competition</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
