@extends('layout.backend.main')
@section('page_content')
    <x-page-header href="{{ route('buyers.create') }}" heading="Buyers" btnText="Add Buyers" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Bank Acconut</th>
                            <th>Country</th>
                            <th>Shipping address</th>
                            <th>Billings Address</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buyers as $buyer)
                            <tr>
                                <td>
                                    <div class="userimgname">
                                        <a href="javascript:void(0);" class="userslist-img bg-img">
                                            <img width="60" height="60" style="border-radius: 50%"
                                                src="{{ asset('uploads') }}/buyers/{{ $buyer->photo }}" alt="buyer">
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $buyer->first_name }}</td>
                                <td>{{ $buyer->last_name }}</td>
                                <td><a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a></td>
                                <td>{{ $buyer->phone }}</td>
                                <td>{{ $buyer->bankAccount->name ?? 'N/A' }}</td>
                                <td>{{ $buyer->country }}</td>
                                <td>{{ $buyer->shipping_address }}</td>
                                <td>{{ $buyer->billing_address }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{ route('buyers.show', $buyer->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>
                                        <a class="me-2 p-2" href="{{ route('buyers.edit', $buyer->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        {{-- <form action="{{ route('buyers.destroy', $buyer->id) }}" method="POST" class="d-inline"> --}}
                                          <!-- Delete Form -->
                        <form action="{{ route('buyers.destroy',$buyer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this size?')" style="margin-bottom: 0px">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  style="background: transparent; border: none; color: red;">
                                <i data-feather="trash-2" class="feather-trash-2 delete_icon" ></i>
                            </button>
                        </form>
                                    
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No buyers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        {{ $buyers->links('vendor.pagination.custom') }}
    </div>
    
@endsection

