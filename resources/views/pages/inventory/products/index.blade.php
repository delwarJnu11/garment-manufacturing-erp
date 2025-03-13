@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Product Variations" btnText="Product Variants" href="{{url('stock/products/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Product Type</th>
            <th>Category Type</th>
            <th>SKU</th>
           
            <th>Size</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Unit of Meseare</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($products as $product)
       <tr>
        <td>{{$product['id']}}</td>  
        <td>
            {{$product['name']}}</td>
        <td>
            {{$product->product_type->name}}
        </td>
        <td>
            {{$product->Category_type->name ?? 'N/A'}}
        </td>
        <td>
            {{$product['sku']}}
        </td>
       
        <td>
            @if ($product->product_type->id == 1 && is_null($product->size))
                <span class="text-muted">No size available</span>
            @else
                {{ $product->size->name ?? 'N/A' }}
            @endif
        </td>
        
        <td>
            {{$product['qty']}}
        </td>
        <td>
            {{$product->uom->name ?? 'N/A'}}
        </td>
        <td>
            {{$product['unit_price']}}
        </td>
       

            <td class="action-table-data">
                <div class="edit-delete-action">
                    {{-- <a class="me-2 p-2 mb-0" href="{{ route('products.show', $product_type->id) }}">
                        <i data-feather="eye" class="feather-eye"></i>
                    </a> --}}
                    <a class="me-2 p-2" href="{{ route('products.edit', $product->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                  
                    <x-delete action="{{ url('stock/products.destroy', $product->id) }}" />
                </div>
            </td>
    </tr>
       @empty 
       @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $products->links('vendor.pagination.custom') }}
</div>
@endsection

