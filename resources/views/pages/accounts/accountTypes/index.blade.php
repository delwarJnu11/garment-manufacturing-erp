@extends('layout.backend.main')
@section('page_content')
<div class="container my-5">
    <h2>Account Types</h2>
    <a href="{{ route('accountTypes.create') }}" class="btn btn-primary mb-3">Add Account Type</a>

    <!-- Success message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered w-100 m-auto">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accountTypes as $accountType)
                <tr>
                    <td>{{ $accountType->name }}</td>
                    <td>
                        <a href="{{ route('accountTypes.edit', $accountType->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('accountTypes.destroy', $accountType->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection