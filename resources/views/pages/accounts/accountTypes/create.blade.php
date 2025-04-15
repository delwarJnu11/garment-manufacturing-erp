@extends('layout.backend.main')
@section('page_content')
<div class="container my-5">
    <h2>Create Account Type</h2>
    <form action="{{ route('accountTypes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Account Type Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('accountTypes.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection