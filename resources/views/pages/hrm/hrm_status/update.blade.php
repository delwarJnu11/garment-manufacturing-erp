@extends('layout.backend.main')

@section('page_content')
<div class="row">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_status')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Status</h5>
            </div>
            <div class="card-body">
                <form action="{{url("hrm_status/{$status['id']}")}}" method="POST">
                    @csrf
                    <input type="hidden"  name="_method" value="put" >
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{$status['name']}}" class="form-control" placeholder="Enter Status Name..." required  autocomplete="name">
                        </div>
                        @error('name')
                        <span style="color: red" >{{$message}}</span>
                       @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Description :</label>
                        <div class="col-lg-10">
                            <input type="text" name="description" value="{{$status['description']}}" class="form-control" placeholder="Enter Role Name..." required autocomplete="name">
                        </div>
                        @error('description')
                        <span style="color: red" >{{$message}}</span>
                       @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Change Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
