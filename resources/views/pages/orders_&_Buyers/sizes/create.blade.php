
@extends('layout.backend.main')
@section('page_content')

<div class="card flex-fill">
    <div class="card-header">
        <h5 class="card-title text-center bg-primary p-3">Add Category</h5>
    </div>
    <div class="card-body">
        <form action="{{route('sizes.store')}}" method="POST">
            @csrf
            <div class="row mb-3">
                <label class="col-lg-3 col-form-label">Size Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="name">
                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
    
@endsection