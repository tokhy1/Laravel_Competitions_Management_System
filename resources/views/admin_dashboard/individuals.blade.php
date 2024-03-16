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
    Individual
@endsection

{{-- modal --}}
@section('modal-title')
    Add Individual
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-individual">
        @csrf
        <div class="mb-3">
            <label class="form-label">Team Name</label>
            <input type="text" class="form-control" name="team_name">
        </div>
        <div class="mb-3">
            <label class="form-label">User ID</label>
            <input type="number" class="form-control" name="user_id">
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
            <th>Team Name</th>
            <th>User ID</th>
            <th>Competition ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($individuals as $individual)
                <tr>
                    <td>
                        {{ $individual->id }}
                    </td>
                    <td>
                        {{ $individual->team_name }}
                    </td>
                    <td>
                        {{ $individual->user_id }}
                    </td>
                    <td>
                        {{ $individual->competition_id }}
                    </td>
                    <td>
                        {{ $individual->created_at }}
                    </td>
                    <td>
                        {{ $individual->updated_at }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger"
                            href="/dashboard/delete-individual/{{ $individual->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Individual</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($individual) ? '/dashboard/update-individual/' . $individual->id : '/dashboard/update-individual/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Team Name</label>
                            <input type="text" class="form-control" name="team_name"
                                value="{{ isset($individual) ? $individual->team_name : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Competition ID</label>
                            <input type="number" class="form-control" name="competition_id"
                                value="{{ isset($individual) ? $individual->competition_id : '' }}">
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
            var individualsDiv = document.querySelector('.sidebar .individuals-div');
            individualsDiv.classList.add('active');
        });
    </script>
@endsection
