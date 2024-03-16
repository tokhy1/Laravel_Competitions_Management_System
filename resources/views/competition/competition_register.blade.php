@extends('components.navbar')

@section('title')
    Competition Registration
@endsection

@section('content')
    {{-- Contact Us section --}}
    <div class="register-body" style="background-color: #EBFDFF; ">
        <div class="container-fluid p-4">
            <div class="register-content">
                <div class="subContainer">
                    <div class="form-container w-50">
                        <h2>Competition Registration </h2>

                        <form method="POST" action="/competition-register/{{ $id }}" class="w-100">
                            @csrf
                            <div class="mb-3">
                                <label for="nameInput" class="form-label" style="font-weight: bold;color: #565E6C">Team
                                    Name</label>
                                <input type="text" class="form-control" id="nameInput" placeholder="Enter your team name"
                                    name="team_name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold;color: #565E6C">Participate As</label>
                                <select class="form-select" aria-label="Default select example" name="participation_type" required>
                                    <option selected>Select participation type</option>
                                    <option value="team">Team</option>
                                    <option value="individual">Individual</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Apply</button>
                        </form>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/competitions_details/competition_register.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
