@extends('layout.backend.main')
@section('page_content')
    <x-page-header href="{{ route('suppliers.create') }}" heading="Suppliers" btnText="Add Supplier" />
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
                            <th>Phone</th>
                            <th>Bank Account</th>
                            <th>Address</th>
                            {{-- <th>Created At</th> --}}
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>
                                    <div class="userimgname">
                                      
                                        <a href="javascript:void(0);" class="userslist-img bg-img">
                                          
                                            <img width="60" height="60" style="border-radius: 50%"
                                                src="{{ asset('uploads') }}/suppliers/{{ $supplier->photo }}" alt="supplier">
                                        </a>
                                        <span>#00{{$supplier->id}}</span>
                                    </div>
                                </td>
                                <td>{{ $supplier->first_name }}</td>
                                <td>{{ $supplier->last_name }}</td>
                                <td><a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->bankAccount->name ?? 'N/A' }}</td>
                                <td>{{ $supplier->address }}</td>
                                {{-- <td>{{ $supplier->created_at }}</td> --}}
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{ route('suppliers.show', $supplier->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>
                                        <a class="me-2 p-2" href="{{ route('suppliers.edit', $supplier->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <form action="{{ route('suppliers.destroy',$supplier->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this size?')" style="margin-bottom: 0px">
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
                                <td colspan="8" class="text-center">No suppliers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $suppliers->links('vendor.pagination.custom') }}
    </div>
@endsection

