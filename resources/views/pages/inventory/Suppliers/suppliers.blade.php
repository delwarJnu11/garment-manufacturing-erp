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
                                    </div>
                                </td>
                                <td>{{ $supplier->first_name }}</td>
                                <td>{{ $supplier->last_name }}</td>
                                <td><a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                                <td>{{ $supplier->phone }}</td>
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
                                        <a class="confirm-text p-2" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
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
    <div class="d-flex justify-content-end mt-3">
        {{ $suppliers->links() }}
    </div>
    
@endsection

