@extends('layout.backend.main')
@section('page_content')

<x-message-banner/>

<div class="card flex-fill">
    <x-page-header heading="Size List" btnText="Add Size" href="{{ url('sizes/create') }}" />

    <table class="table table-striped table-bordered">
        <thead class="thead-primary">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Action</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse ($sizes as $size)
            <tr>
                <td>{{ $size->id }}</td>
                <td>{{ $size->name }}</td>
                
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        
                        <!-- Edit Button -->
                        <a class="me-2 p-2" href="{{ route('sizes.edit', $size->id) }}">

                        {{-- <a class="me-2 p-2" href="{{ url('sizes/' . $size->id . '/edit') }}"> --}}
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>

                        <!-- Delete Form -->
                        <form action="{{ url('sizes/' . $size->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this size?')" style="margin-bottom: 0px">
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
                <td colspan="4" class="text-center text-muted">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>    
</div>

@endsection
