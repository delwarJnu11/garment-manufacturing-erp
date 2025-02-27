@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Category" btnText="category" href="{{url('uoms/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Unit Of Mesure</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($uoms as $uom)
       <tr>
        <td>{{$uom['id']}}</td>  
        <td>
            {{$uom['name']}}</td>

            <td class="action-table-data">
                <div class="edit-delete-action">
                    {{-- <a class="me-2 p-2 mb-0" href="{{ route('uoms.show', $uom->id) }}">
                        <i data-feather="eye" class="feather-eye"></i>
                    </a> --}}
                    <a class="me-2 p-2" href="{{ route('uoms.edit', $uom->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{route('uoms.destroy',$uom->id)}}" method="POST" class="d-inline">
                       
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" confirm-delete"  onclick="return confirm('Are you sure?')" style="color: red;width:10%; border:none">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </button>
                    </form>
                   
                </div>
            </td>
    </tr>
       @empty 
       @endforelse
    </tbody>
</table>
    <div class="d-flex justify-content-end">
        {{$uoms->links('vendor.pagination.bootstrap-5')}}
    </div>
@endsection

