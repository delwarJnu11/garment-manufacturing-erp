@extends('layout.backend.main')

@section('page_content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title">Create User Role</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/users/roles/store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Role Name:</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Role Name..." required autocomplete="name">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection