@extends('layout.backend.main')
@section('page_content')
    <div class="container mt-5">
        <h1>Create Account Group</h1>
        <a href="{{ route('accountGroups.index') }}" class="btn btn-secondary mb-3">Back to List</a>

        <form action="{{ route('accountGroups.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="number" class="form-control" id="code" name="code" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent ID</label>
                <input type="number" class="form-control" id="parent_id" name="parent_id">
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Is Active</label>
                <select class="form-control" id="is_active" name="is_active" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection