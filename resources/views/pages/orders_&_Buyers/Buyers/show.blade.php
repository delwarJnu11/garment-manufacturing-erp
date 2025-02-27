@extends('layout.backend.main')

@section('page_content')
    <x-page-header heading="Buyer Details" btnText="Back" href="{{ route('buyers.index') }}" />

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Photo</th>
                    <td>
                        <img src="{{ asset('uploads/buyers/' . $buyer->photo) }}" alt="Buyer Image"
                            width="100" height="100" style="border-radius: 50%;">
                    </td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $buyer->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $buyer->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $buyer->phone }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $buyer->country }}</td>
                </tr>
                <tr>
                    <th>Shipping Address</th>
                    <td>{{ $buyer->shipping_address }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $buyer->created_at->format('d M, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
