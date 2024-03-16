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
    User
@endsection

{{-- modal --}}
@section('modal-title')
    Add User
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-user">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('page-content')
    <table class="table table-hover mt-5 text-center">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                    <td>
                        {{ $user->updated_at }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger" href="/dashboard/delete-user/{{ $user->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($user) ? '/dashboard/update-user/' . $user->id : '/dashboard/update-user/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ isset($user) ? $user->name : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ isset($user) ? $user->email : '' }}"
                                name="email">
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
            var usersDiv = document.querySelector('.sidebar .users-div');
            usersDiv.classList.add('active');
        });
    </script>
@endsection
