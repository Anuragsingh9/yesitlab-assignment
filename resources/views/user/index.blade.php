@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Register User</a>
        </div>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Profile Pic</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobile_no}}</td>
                <td>
                    <img src="{{ Storage::url($user->profile_pic) }}" alt="Profile Pic" style="max-width: 100px;">
                </td>
                <td>
                    <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>