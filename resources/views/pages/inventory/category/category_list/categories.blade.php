@extends('layout.backend.main')
@section('page_content')
    

<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Type</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{$category['id']}}</td>
            <td>{{$category['name']}}</td>
            <td>{{ $category->category_type->name ?? 'N/A' }}</td>
            <td>{{$category['description']}}</td>
            <td>
                <x-status-badge :status='$category->status'></x-status-badge>
            </td>
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye action-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </a>
                    <a class="me-2 p-2" href="#">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <a class="confirm-text p-2" href="javascript:void(0);">
                        <i data-feather="trash-2" class="feather-trash-2"></i>
                    </a>
                </div>
            {{-- <td>
                <a href="{{ url('/categories/view/1') }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ url('/categories/edit/1') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/categories/delete/1') }}" class="btn btn-danger btn-sm">Delete</a>
            </td> --}}
        </tr>
        @empty
            
        @endforelse
        {{-- <tr>
            <td>2</td>
            <td>Work-in-Process (WIP)</td>
            <td>Main</td>
            <td>—</td>
            <td>Semi-processed garments in production</td>
            <td><span class="badge badge-warning">Processing</span></td>
            <td>
                <a href="{{ url('/categories/view/2') }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ url('/categories/edit/2') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/categories/delete/2') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>T-Shirts</td>
            <td>Subcategory</td>
            <td>Finished Goods</td>
            <td>All types of T-shirts</td>
            <td><span class="badge badge-success">Active</span></td>
            <td>
                <a href="{{ url('/categories/view/3') }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ url('/categories/edit/3') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/categories/delete/3') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Denim Jeans</td>
            <td>Subcategory</td>
            <td>Work-in-Process</td>
            <td>Jeans in production</td>
            <td><span class="badge badge-warning">Processing</span></td>
            <td>
                <a href="{{ url('/categories/view/4') }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ url('/categories/edit/4') }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ url('/categories/delete/4') }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr> --}}
    </tbody>
</table>
@endsection
