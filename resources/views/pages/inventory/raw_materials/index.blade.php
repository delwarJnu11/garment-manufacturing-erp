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
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit of Measure</th>
                <th>Cost Per Unit</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($raw_materials as $material)
            <tr>
                <td>{{ $material->id }}</td>
                <td>{{ $material->material_name }}</td>
                <td>{{ $material->description }}</td>
                <td>{{ $material->quantity }}</td>
                <td>{{ $material->uom->name ?? 'N/A' }}</td>
                <td>${{ number_format($material->cost_per_unit, 2) }}</td>
                <td>{{ $material->supplier->name ?? 'N/A' }}</td>

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

                        <!-- Delete Form -->
                        <form action="{{ url('raw_materials/' . $material->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this material?')" style="margin-bottom: 0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="confirm-text" style="background: transparent; border: none; color: red;">
                                <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">No raw materials found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $raw_materials->links('vendor.pagination.custom') }}
    </div>
</div>

@endsection
