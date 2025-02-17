@extends('layout.backend.main')
@section('page_content')

<x-message-banner/>


<div class="card flex-fill">
    <div class="card-header">
        <h5 class="card-title "><a href="{{url('category/create')}}" class=" btn btn-info p-3 rounded ">Add Category</a></h5>
    </div>
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{$category['id']}}</td>
            <td>{{$category['name']}}</td>
            <td>{{$category['description']}}</td>
          
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="me-2 p-2 mb-0" href="{{url('category')}}/{{$category['id']}}/show">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye action-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </a>
                    <a class="me-2 p-2" href="{{url('category')}}/{{$category['id']}}/edit">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    {{-- <form action="{{ url('category/' . $category->id) }}" method="post" onsubmit="return confirm('Are you sure todelte')>
                        @csrf
                        @method('DELETE')
                    <a class="confirm-text p-2" href="{{ url('category/' . $category->id) }} " onclick="return confirm('Are you sure todelte')">
                        <i data-feather="trash-2" class="feather-trash-2"></i>
                    </a>
                </form> --}}

                <form action="{{ url('category/' . $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="confirm-text p-2 bg-transparent border-none">
                        <i data-feather="trash-2" class="feather-trash-2"></i>
                    </button>
                </form>
              
                
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

<div class="d-flex justify-content-end">
    {{$categories->links( 'pagination::bootstrap-5')}}
</div>
@endsection
