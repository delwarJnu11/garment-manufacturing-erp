@extends('layout.backend.main')

@section('page_content')
    <x-page-header heading="Supplier Details" btnText="Back" href="{{ route('suppliers.index') }}" />

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Photo</th>
                    <td>
                        <img src="{{ asset('uploads/suppliers/' . $supplier->photo) }}" alt="Supplier Image"
                            width="100" height="100" style="border-radius: 50%;">
                    </td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $supplier->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $supplier->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $supplier->phone }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $supplier->address }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $supplier->created_at->format('d M, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
