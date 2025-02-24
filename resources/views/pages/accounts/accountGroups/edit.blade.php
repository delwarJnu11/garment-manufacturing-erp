@extends('layout.backend.main')
@section('page_content')
<div class="container mt-5">
    <h1>Edit Account Group</h1>
    <a href="{{ route('accountGroups.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <form action="{{ route('accountGroups.update', $accountGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="number" class="form-control" id="code" name="code" value="{{ $accountGroup->code }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $accountGroup->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $accountGroup->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent ID</label>
            <input type="number" class="form-control" id="parent_id" name="parent_id" value="{{ $accountGroup->parent_id }}">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Is Active</label>
            <select class="form-control" id="is_active" name="is_active" required>
                <option value="1" {{ $accountGroup->is_active == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $accountGroup->is_active == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection