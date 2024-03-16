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
    Event
@endsection

{{-- modal --}}
@section('modal-title')
    Add Event
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-event">
        @csrf
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" class="form-control" name="event_name">
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight: bold;color: #565E6C">Event Type</label>
            <select class="form-select" aria-label="Default select example" name="event_type" required>
                <option selected>Select event type</option>
                <option value="academic">Academic</option>
                <option value="sporting">Sporting</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Event Points</label>
            <input type="number" class="form-control" name="event_points">
        </div>
        <div class="mb-3">
            <label class="form-label">Competition ID</label>
            <input type="number" class="form-control" name="competition_id">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('page-content')
    <table class="table table-hover mt-5 text-center">
        <thead>
            <th>ID</th>
            <th>Event Name</th>
            <th>Event Points</th>
            <th>Events Type</th>
            <th>Competition ID</th>
            <th>Start Date</th>
            <th>Expire Date</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>
                        {{ $event->id }}
                    </td>
                    <td>
                        {{ $event->event_name }}
                    </td>
                    <td>
                        {{ $event->event_points }}
                    </td>
                    <td>
                        {{ $event->event_type }}
                    </td>
                    <td>
                        {{ $event->competition_id }}
                    </td>
                    <td>
                        {{ $event->start_date }}
                    </td>
                    <td>
                        {{ $event->expire_date }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger" href="/dashboard/delete-event/{{ $event->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($event) ? '/dashboard/update-event/' . $event->id : '/dashboard/update-event/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Event Name</label>
                            <input type="text" class="form-control" name="event_name"
                                value="{{ isset($event) ? $event->event_name : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Points</label>
                            <input type="number" class="form-control" name="event_points"
                                value="{{ isset($event) ? $event->event_points : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold;color: #565E6C">Event Type</label>
                            <select class="form-select" aria-label="Default select example" name="event_type" required>
                                <option selected>Select event type</option>
                                <option value="academic">Academic</option>
                                <option value="sporting">Sporting</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ isset($event) ? $event->start_date : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expire Date</label>
                            <input type="date" class="form-control" name="expire_date"
                                value="{{ isset($event) ? $event->expire_date : '' }}">
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
            var eventsDiv = document.querySelector('.sidebar .events-div');
            eventsDiv.classList.add('active');
        });
    </script>
@endsection
