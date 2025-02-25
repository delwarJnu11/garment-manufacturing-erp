@extends('layout.backend.main')
@section('page_content')
<div class="container mt-5">
    <h1 class="mb-4">Accounts</h1>
    <a href="{{ route('accounts.create') }}" class="btn btn-success mb-3">Create Account</a>

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
                <!-- <th>Account Group</th> -->
                <!-- <th>Is Active</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->code }}</td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->accountGroup->name }}</td>
                <td>{{ $account->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" class="d-inline-block">
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