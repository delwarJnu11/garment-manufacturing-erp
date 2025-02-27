@extends('layout.backend.main')
@section('page_content')
    <x-message-banner />


    <div class="card flex-fill">

        <x-page-header heading="Category" btnText="category" href="{{ url('category/create') }}" />
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>category type</th>
                    <th>Category </th>
                    <th>category value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category_attributes as $category)
                    <tr>
                        <td>{{ $category['id'] }}</td>
                        {{-- <td>{{$category['category_id']}}</td> --}}
                        <td>{{ $category->category ? $category->category->name : 'no category here' }}</td>
                        <td>{{ $category->category_type ? $category->category_type->name : 'no category Type here' }}</td>
                        <td>{{ $category['name'] }}</td>
                        <td>{{ $category['attribute_value'] }}</td>

                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="{{ url('category') }}/{{ $category['id'] }}/show">
                                    {{-- <a class="me-2 p-2 mb-0" href="{{ route('category.show', $category->id) }}"> --}}


                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-eye action-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a class="me-2 p-2" href="{{ url('category') }}/{{ $category['id'] }}/edit">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>


                                <form action="{{ url('category/' . $category->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="confirm-text "
                                        style="padding: 2 ; background:transparent; border:none; width:30; color:red">
                                        <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                                    </button>
                                </form>
                            </div>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $category_attributes->links('pagination::bootstrap-5') }}
        </div>
    @endsection
