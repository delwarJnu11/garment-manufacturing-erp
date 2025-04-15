@extends('layout.backend.main')
@section('page_content')
<div class="container my-5">
    <h2>Edit Account Type</h2>
    <form action="{{ route('accountTypes.update', $accountType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Account Type Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $accountType->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('accountTypes.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection