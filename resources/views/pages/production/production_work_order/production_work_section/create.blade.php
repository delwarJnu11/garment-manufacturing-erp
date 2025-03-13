@extends('layout.backend.main');

@section('page_content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card flex-fill">
                <div class="card-header bg-primary">
                    <h5 class="card-title">Create Production Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('production_work_sections.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-lg-2 col-form-label">Section Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="status_name" value="{{ old('status_name') }}"
                                    class="form-control" placeholder="Enter Status Name..." required
                                    autocomplete="status_name">
                            </div>
                            <x-input-error :messages="$errors->get('status_name')" class="mt-2" />
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Production Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
