@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Product Type" btnText="Product Type" href="{{url('stock/product_types/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Product Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($product_types as $product_type)
       <tr>
        <td>{{$product_type['id']}}</td>  
        <td>
            {{$product_type['name']}}</td>

            <td class="action-table-data">
                <div class="edit-delete-action">
                  
                    <a class="me-2 p-2" href="{{ route('product_types.edit', $product_type->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    {{-- <form action="{{route('product_types.destroy',$product_type->id)}}" method="POST" class="d-inline"> --}}
                       
                     <x-delete action="{{url('product_types.destroy',$product_type->id)}}"/>
                     {{-- <x-delete action="{{url('product_types.destroy',$product_type->id)}}"/> --}}
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
        {{$product_types->links('vendor.pagination.custom')}}
    </div>
@endsection

