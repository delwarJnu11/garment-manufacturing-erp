@extends('layout.backend.main');

@section('page_content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card flex-fill">
                <div class="card-header bg-primary">
                    <h5 class="card-title">Create Wastage Type</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('wastage-types.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold mb-2">Wastage Type Name</label>
                            <input type="text" name="type_name" value="{{ old('type_name') }}" class="form-control"
                                placeholder="Enter Type Name..." required autocomplete="type_name">
                            <x-input-error :messages="$errors->get('type_name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold mb-2">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Wastage Type</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
