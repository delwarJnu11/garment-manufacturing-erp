@extends('layout.backend.main');

@section('page_content')

<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="mb-3 btn btn-secondary px-4">Status Details</h4>
        <button class="btn btn-primary" onclick="printPage()">Print</button>
        <a href="{{url('/hrm_departments')}}" type="submit" class="btn btn-primary">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-4" id="printableArea">
        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <td>{{ $departments['id'] }}</td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $departments['name'] }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $departments['statuses_id'] }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $departments['description'] }}</td>
            </tr>

            <tr>
                <th>Created_at</th>
                <td>{{ $departments['created_at'] }}</td>
            </tr>

            <tr>
                <th>Updated_at</th>
                <td>{{ $departments['updated_at'] }}</td>
            </tr>
        </table>


    </div>

    <div class="row col-12">
        {{-- <div class="col-6 p-4">
            <a href="{{ url('hrm_status') }}" class="btn btn-warning">Back</a>
        </div> --}}
        {{-- <div class="d-md-flex d-grid align-items-center gap-3 d-flex justify-content-end col-6 p-2">
            <a href="{{ route('hrm_status.edit', $status->id) }}" class="btn btn-success">Edit</a>
        </div> --}}
    </div>
</div>

@endsection
