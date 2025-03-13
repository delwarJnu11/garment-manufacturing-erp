@extends('layout.backend.main')
@section('page_content')

<x-message-banner/>

<div class="card flex-fill">
    <x-page-header heading="Raw Materials List" btnText="Add Raw Material" href="{{ url('raw_materials/create') }}" />

    <table class="table table-striped table-bordered">
        <thead class="thead-primary">
            <tr>
                <th>#</th>
                <th>Material Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Unit of Measure</th>
                <th>Cost Per Unit</th>
                {{-- <th>Supplier</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rawMaterials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->name }}</td>
                    <td>{{ $material->category_type->name ?? 'N/A' }}</td>
                    <td>{{ $material->qty }}</td>
                    <td>{{ $material->uom->name ?? 'N/A' }}</td>
                    <td>${{ number_format($material->unit_price, 2) }}</td>
        
                    <td class="action-table-data">
                        <div class="edit-delete-action">
                            <!-- View Button -->
                            <a class="me-2 p-2 mb-0" href="{{ url('raw_materials/' . $material->id . '/show') }}">
                                <i data-feather="eye" class="feather-eye"></i>
                            </a>
        
                            <!-- Edit Button -->
                            <a class="me-2 p-2" href="{{ url('raw_materials/' . $material->id . '/edit') }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No raw materials found</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $rawMaterials->links('vendor.pagination.custom') }}
    </div>
</div>

@endsection
