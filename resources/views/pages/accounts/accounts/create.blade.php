@extends('layout.backend.main')
@section('page_content')
<div class="container mt-5">
    <h1>Create Account</h1>
    <a href="{{ route('accounts.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <form action="{{ route('accounts.store') }}" method="POST">
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
            <label for="account_group_id" class="form-label">Account Group</label>
            <select class="form-control" id="account_group_id" name="account_group_id" required>
                @foreach($accountGroups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="is_payment_method" class="form-label">Is Payment Method</label>
            <select class="form-control" id="is_payment_method" name="is_payment_method">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="is_trx_no_required" class="form-label">Is Transaction No Required</label>
            <select class="form-control" id="is_trx_no_required" name="is_trx_no_required">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
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