@extends('layout.backend.main');

@section('page_content')

<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="mb-3 px-4">Employee Position Details</h4>
        <button class="btn btn-primary" onclick="printPage()">Print</button>
        <a href="{{url('/hrm_employee_positions')}}" type="submit" class="btn btn-primary">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-4" id="printableArea">
        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <td>{{ $positions['id'] }}</td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $positions['name'] }}</td>
            </tr>
            <tr>
                <th>Department Name</th>
                <td>{{ $positions['department_id'] }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $positions['statuses_id'] }}</td>
            </tr>
            <tr>
                <th>Salary</th>
                <td>{{ $positions['salary'] }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $positions['description'] }}</td>
            </tr>

            <tr>
                <th>Created_at</th>
                <td>{{ $positions['created_at'] }}</td>
            </tr>

            <tr>
                <th>Updated_at</th>
                <td>{{ $positions['updated_at'] }}</td>
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
<script>
    function printPage() {
        var printContents = document.getElementById("printableArea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Reload the page to restore buttons after printing
    }

</script>
@endsection


