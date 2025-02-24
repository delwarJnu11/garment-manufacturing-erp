@extends('layout.backend.main');

@section('page_content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card flex-fill">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Create Fabrics Type</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('fabric_types.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-lg-2 col-form-label">Fabrics Type</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Enter fabrics types..." required autocomplete="name">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Fabrics Type</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
