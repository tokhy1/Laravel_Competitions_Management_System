@extends('components.sidebar')

@if (Auth::user()->role == 'superadmin')
    @section('superadmin-content')
        <div class="admins-div" onclick="handleClick('admins')">
            <i class="fa-solid fa-user-tie"></i>
            <p>Admins</p>
        </div>
    @endsection
@endif

@section('button-content')
    Competition
@endsection

{{-- modal --}}
@section('modal-title')
    Add Competition
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-competition">
        @csrf
        <div class="mb-3">
            <label class="form-label">Competition Name</label>
            <input type="text" class="form-control" name="competition_name">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description">
        </div>
        <div class="mb-3">
            <label class="form-label">Number of events</label>
            <input type="number" class="form-control" name="num_of_events">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('page-content')
    <table class="table table-hover mt-5 text-center">
        <thead>
            <th>ID</th>
            <th>Competition Name</th>
            <th>Num of events</th>
            <th>Start Date</th>
            <th>Expire Date</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($competitions as $competition)
                <tr>
                    <td>
                        {{ $competition->id }}
                    </td>
                    <td>
                        {{ $competition->competition_name }}
                    </td>
                    <td>
                        {{ $competition->num_of_events }}
                    </td>
                    <td>
                        {{ $competition->start_date }}
                    </td>
                    <td>
                        {{ $competition->expire_date }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger"
                            href="/dashboard/delete-competition/{{ $competition->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="updateModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Competition</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($competition) ? '/dashboard/update-competition/' . $competition->id : '/dashboard/update-competition/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Competition Name</label>
                            <input type="text" class="form-control" name="competition_name"
                                value="{{ isset($competition) ? $competition->competition_name : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ isset($competition) ? $competition->description : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Number of events</label>
                            <input type="number" class="form-control" name="num_of_events"
                                value="{{ isset($competition) ? $competition->num_of_events : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ isset($competition) ? $competition->start_date : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expire Date</label>
                            <input type="date" class="form-control" name="expire_date"
                                value="{{ isset($competition) ? $competition->expire_date : '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var competitions = document.querySelector('.sidebar .competitions-div');
            competitions.classList.add('active');
        });
    </script>
@endsection
