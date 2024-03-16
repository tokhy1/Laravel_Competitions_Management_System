@extends('components.sidebar')

@section('button-content')
    Admin
@endsection

@section('superadmin-content')
    <div class="admins-div" onclick="handleClick('admins')">
        <i class="fa-solid fa-user-tie"></i>
        <p>Admins</p>
    </div>
@endsection

{{-- modal --}}
@section('modal-title')
    Add Admin
@endsection

@section('modal-body')
    <form method="POST" action="/dashboard/add-admin">
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
            @foreach ($admins as $admin)
                <tr>
                    <td>
                        {{ $admin->id }}
                    </td>
                    <td>
                        {{ $admin->name }}
                    </td>
                    <td>
                        {{ $admin->email }}
                    </td>
                    <td>
                        {{ $admin->created_at }}
                    </td>
                    <td>
                        {{ $admin->updated_at }}
                    </td>
                    <td>
                        <a class="btn btn-outline-success" style="margin-right: 5px" data-bs-toggle="modal"
                            data-bs-target="#updateModel">
                            Update
                        </a>
                        <a class="btn btn-outline-danger" href="/dashboard/delete-admin/{{ $admin->id }}">Delete</a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ isset($admin) ? '/dashboard/update-admin/' . $admin->id : '/dashboard/update-admin/' }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ isset($admin) ? $admin->name : '' }}"
                                name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ isset($admin) ? $admin->email : '' }}"
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
            var adminsDiv = document.querySelector('.sidebar .admins-div');
            adminsDiv.classList.add('active');
        });
    </script>
@endsection
