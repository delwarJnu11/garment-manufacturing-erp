@extends('layout.backend.main')

@section('page_content')
    <div class="row">
        <div class="col-md-12 col-lg-8 offset-lg-2">
            <div class="card mt-5 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white">Wastage Type Details</h5>
                    <a href="{{ route('wastage-types.index') }}" class="btn btn-light btn-sm">
                        ← Go Back
                    </a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="fw-bold">{{ $wastageType->name }}</h4>
                        @if ($wastageType->description)
                            <p class="text-muted">{{ $wastageType->description }}</p>
                        @else
                            <p class="text-muted fst-italic">No description provided.</p>
                        @endif
                    </div>

                    <div class="border-top pt-3">
                        <p class="mb-1"><strong>Created At:</strong>
                            {{ $wastageType->created_at->format('d M, Y h:i A') }}</p>
                        <p class="mb-0"><strong>Last Updated:</strong>
                            {{ $wastageType->updated_at->format('d M, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
