@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Product" btnText="Add Product" href="{{ url('products/create') }}" />

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Description</th>
                    <th>Barcode</th>
                    <th>Category</th>
                    <th>UOM</th>
                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                       
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->photo)
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ number_format($product->unit_price, 2) }}</td>
                        <td>${{ number_format($product->offer_price, 2) }}</td>
                        {{-- <td>{{ $product->weight }} grams</td> --}}
                        {{-- <td>{{ $product->size_id == 1 ? 'Small' : 'Large' }}</td>
                        <td>
                            <input type="checkbox" {{ $product->is_raw_material ? 'checked' : '' }} disabled>
                        </td> --}}
                        <td>{{ $product->barcode }}</td>
                       
                        <td>{{ $product->category? $product->category->name:'no Category ' }}</td>
                        <td>{{ $product->uom?$product->uom->name:'no units availabe' }}</td>
                     
                      
                        <td class="action-table-data">
                            <a href="{{ route('products.show', $product->id) }}">
                                <i data-feather="eye" class="feather-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" 
                                onsubmit="return confirm('Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="confirm-text" style="padding: 2px; background: transparent; border: none; width: 30px; color: red">
                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="16" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </div>
 
@endsection
