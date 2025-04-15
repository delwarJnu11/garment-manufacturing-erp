@extends('layout.backend.main')
@section('page_content')
<!-- resources/views/account_groups/index.blade.php -->
<div class="container mt-5">
    <h1 class="mb-4">Account Groups</h1>
    <a href="{{ route('accountGroups.create') }}" class="btn btn-success mb-3">Create Account Group</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Parent ID</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accountGroups as $group)
            <tr>
                <td>{{ $group->code }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>{{ $group->parent_id }}</td>
                <td>{{ $group->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('accountGroups.edit', $group->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('accountGroups.destroy', $group->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection