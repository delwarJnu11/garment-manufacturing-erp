@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Product Variations" btnText="Product Variants" href="{{url('product_variants/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Product Type</th>
            <th>SKU</th>
           
            <th>Size</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Unit of Meseare</th>
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
            {{$product_variant->product_type->name}}
        </td>
        <td>
            {{$product_variant['sku']}}
        </td>
       
        <td>
            @if ($product_variant->product_type->id == 1 && is_null($product_variant->size))
                <span class="text-muted">No size available</span>
            @else
                {{ $product_variant->size->name ?? 'N/A' }}
            @endif
        </td>
        
        <td>
            {{$product_variant['qty']}}
        </td>
        <td>
            {{$product_variant->uom->name}}
        </td>
        <td>
            {{$product_variant['unit_price']}}
        </td>
       

            <td class="action-table-data">
                <div class="edit-delete-action">
                    {{-- <a class="me-2 p-2 mb-0" href="{{ route('product_variants.show', $product_type->id) }}">
                        <i data-feather="eye" class="feather-eye"></i>
                    </a> --}}
                    <a class="me-2 p-2" href="{{ route('product_variants.edit', $product_variant->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    {{-- <form action="{{route('product_variants.destroy',$product_variant->id)}}" method="POST" class="d-inline">
                       
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" confirm-delete"  onclick="return confirm('Are you sure?')" style="color: red;width:10%; border:none">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </button>
                    </form> --}}
                    <x-delete action="{{ url('product_variants.destroy', $product_variant->id) }}" />
                </div>
            </td>
    </tr>
       @empty 
       @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $product_variants->links('vendor.pagination.custom') }}
</div>
@endsection

