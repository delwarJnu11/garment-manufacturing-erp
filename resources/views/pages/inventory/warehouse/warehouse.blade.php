@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Warehouses" btnText="Add Warehouse" href="{{ url('warehouses/create') }}"/>

<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($warehouses as $warehouse)
       <tr>
            <td>{{ $warehouse->id }}</td>  
            <td>{{ $warehouse->name }}</td>
            <td>{{ $warehouse->phone }}</td>
            <td>{{ $warehouse->location }}</td>
            <td>{{ $warehouse->address }}</td>
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="me-2 p-2" href="{{ route('warehouses.edit', $warehouse->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline" style="margin-bottom:0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="confirm-delete" onclick="return confirm('Are you sure?')" style="color: red;width:10%; border:none">
                            <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
       @empty 
       <tr>
            <td colspan="6" class="text-center">No warehouses found.</td>
       </tr>
       @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-end">
    {{ $warehouses->links('vendor.pagination.bootstrap-5') }}
</div>

@endsection
