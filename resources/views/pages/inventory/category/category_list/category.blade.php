@extends('layout.backend.main')
@section('page_content')

<x-message-banner/>

<div class="card flex-fill">
    <x-page-header heading="Category List" btnText="Add Category" href="{{ url('category_list/create') }}" />

    <table class="table table-striped table-bordered">
        <thead class="thead-primary">
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Is Raw Material</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    @if ($category->is_raw_material)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-danger">No</span>
                    @endif
                </td>

                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <!-- View Button -->
                        <a class="me-2 p-2 mb-0" href="{{ url('category_list/' . $category->id . '/show') }}">
                            <i data-feather="eye" class="feather-eye"></i>
                        </a>

                        <!-- Edit Button -->
                        <a class="me-2 p-2" href="{{ url('category_list/' . $category->id . '/edit') }}">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>

                        <!-- Delete Form -->
                        <form action="{{ url('category_list/' . $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="confirm-text" style="background: transparent; border: none; color: red;">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $categories->links('vendor.pagination.custom') }}
    </div>
</div>

@endsection
