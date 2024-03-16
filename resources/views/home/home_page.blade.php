@extends('components.navbar')

@section('title')
    Home Page
@endsection

@section('content')
    {{-- landing page section --}}
    <div class="home_body">
        <div class="container">
            <div class="home-content">
                <div class="texts">
                    <h1 style="font-size: 56px;color:#379AE6">
                        Explore university competitions now!
                    </h1>
                    <p style="color: #9095A0;font-size:20px">
                        Here's all information about university competitions, it makes a competition every year that
                        contains
                        academic and sporting events
                    </p>
                    <a class="btn" href="#your-competitions" style="background-color: #379AE6;color:white">View My
                        Competitions</a>
                </div>
                <div class="image">
                    <img src="{{ asset('images/home/landing_page.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    {{-- Your competitions section --}}
    <div id="your-competitions" class="competitions-body mt-5 mb-5">
        <h1 style="color:#379AE6;font-size:48px;" class="text-center">Your Competitions</h1>
        @isset($competitions)
            @empty($competitions)
                <div class="texts container text-start">
                    <h2 class="mt-5 mb-4" style="color:#323842;font-size:38px;font-weight:600;">You haven't enrolled in any
                        competitions yet!</h2>
                    <p class="" style="color:#9095A0;font-size:20px;">You can register for any competition to see your
                        competitions and compete with others.</p>
                </div>
            @else
                <div class="container mt-2">
                    <div class='row'>
                        @foreach ($competitions as $competition)
                            <div class="card" style="width: 20rem;margin:20px;">
                                <img src={{ asset('images/competitions_details/competition_logo.png') }} class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $competition->competition_name }}</h5>
                                    <p class="card-text">
                                        {{ $competition->description }}
                                    </p>
                                    <a href="/competition-rank/{{ $competition->id }}" class="btn btn-outline-primary">Show My
                                        Rank</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endempty
        @else
            <div class="texts container text-start">
                <h2 class="mt-5 mb-4" style="color:#323842;font-size:38px;font-weight:600;">You haven't enrolled in any
                    competitions yet!</h2>
                <p class="" style="color:#9095A0;font-size:20px;">You can register for any competition to see your
                    competitions and compete with others.</p>
            </div>
        @endisset
    </div>

    {{-- Contact Us section --}}
    <div id="contact" class="contact-body" style="background-color: #EBFDFF; ">
        <div class="container-fluid p-4">
            <div class="contact-content">
                <div class="subContainer">
                    <div class="form-container w-50">
                        <h2>Contact Us</h2>

                        <form class="w-100" id="contact-form">
                            <div class="mb-3">
                                <label for="nameInput" class="form-label"
                                    style="font-weight: bold;color: #565E6C">Name</label>
                                <input type="text" class="form-control" id="nameInput" placeholder="Enter your name"
                                    name="name">
                            </div>

                            <div class="mb-3">
                                <label for="emailInput" class="form-label"
                                    style="font-weight: bold;color: #565E6C">Email</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email "
                                    name="email">
                            </div>
                            <div class="mt-3 mb-2 ">
                                <label class="form-label" style="font-weight: bold;color: #565E6C">Question</label>
                                <textarea class="form-control" cols="30" rows="5" placeholder="Enter your question or feedback"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/home/contact.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
