@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Product Type" btnText="Product Type" href="{{url('product_variants/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Product Type</th>
            <th>Size</th>
            <th>SKU</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($product_variants as $product_variant)
       <tr>
        <td>{{$product_variant['id']}}</td>  
        <td>
            {{$product_variant['name']}}</td>
        <td>
            {{$product_variant['product_type_id']}}
        </td>
        <td>
            {{$product_variant['size_id']}}
        </td>
        <td>
            {{$product_variant['sku']}}
        </td>

            <td class="action-table-data">
                <div class="edit-delete-action">
                    {{-- <a class="me-2 p-2 mb-0" href="{{ route('product_variants.show', $product_type->id) }}">
                        <i data-feather="eye" class="feather-eye"></i>
                    </a> --}}
                    <a class="me-2 p-2" href="{{ route('product_variants.edit', $product_variant->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{route('product_variants.destroy',$product_variant->id)}}" method="POST" class="d-inline">
                       
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
        {{$product_variants->links('vendor.pagination.bootstrap-5')}}
    </div>
@endsection

