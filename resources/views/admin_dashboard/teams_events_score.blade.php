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
    Event Score
@endsection

{{-- modal --}}
@section('modal-title')
    Add Event Score
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-team-event-score">
        @csrf
        <div class="mb-3">
            <label class="form-label">Team ID</label>
            <input type="number" class="form-control" name="team_id">
        </div>
        <div class="mb-3">
            <label class="form-label">Event ID</label>
            <input type="number" class="form-control" name="event_id">
        </div>
        <div class="mb-3">
            <label class="form-label">Event Score</label>
            <input type="number" class="form-control" name="event_score">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('page-content')
    <table class="table table-hover mt-5 text-center">
        <thead>
            <th>ID</th>
            <th>Team ID</th>
            <th>Event ID</th>
            <th>Event Score</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($events_score as $event_score)
                <tr>
                    <td>
                        {{ $event_score->id }}
                    </td>
                    <td>
                        {{ $event_score->team_id }}
                    </td>
                    <td>
                        {{ $event_score->event_id }}
                    </td>
                    <td>
                        {{ $event_score->event_score }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger"
                            href="/dashboard/delete-team-event-score/{{ $event_score->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Team Event Score</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($event_score) ? '/dashboard/update-team-event-score/' . $event_score->id : '/dashboard/update-team-event-score/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Event ID</label>
                            <input type="number" class="form-control" name="event_id"
                                value="{{ isset($event_score) ? $event_score->event_id : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Score</label>
                            <input type="number" class="form-control" name="event_score"
                                value="{{ isset($event_score) ? $event_score->event_score : '' }}">
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
