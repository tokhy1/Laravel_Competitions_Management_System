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
    Competition Score
@endsection

{{-- modal --}}
@section('modal-title')
    Add Competition Score
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-individual-competition-score">
        @csrf
        <div class="mb-3">
            <label class="form-label">Individual ID</label>
            <input type="number" class="form-control" name="individual_id">
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
            <th>Individual ID</th>
            <th>Competition ID</th>
            <th>Total Score</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($competitions_score as $competition_score)
                <tr>
                    <td>
                        {{ $competition_score->id }}
                    </td>
                    <td>
                        {{ $competition_score->individual_id }}
                    </td>
                    <td>
                        {{ $competition_score->competition_id }}
                    </td>
                    <td>
                        {{ $competition_score->total_score }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger"
                            href="/dashboard/delete-individual-competition-score/{{ $competition_score->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Individual Competition Score</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($competition_score) ? '/dashboard/update-individual-competition-score/' . $competition_score->id : '/dashboard/update-individual-competition-score/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Competition ID</label>
                            <input type="number" class="form-control" name="competition_id"
                                value="{{ isset($competition_score) ? $competition_score->competition_id : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Individual ID</label>
                            <input type="number" class="form-control" name="individual_id"
                                value="{{ isset($competition_score) ? $competition_score->individual_id : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Score</label>
                            <input type="number" class="form-control" name="total_score"
                                value="{{ isset($competition_score) ? $competition_score->total_score : '' }}">
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
