@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Product" btnText="Add Product" href="{{ url('productCatelogues/create') }}" />

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
                @forelse ($productCatelogues as $product)
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
                        
                        <td>{{ $product->barcode }}</td>
                       
                        <td>{{ $product->category? $product->category->name:'no Category ' }}</td>
                        <td>{{ $product->uom?$product->uom->name:'no units availabe' }}</td>
                     
                      
                        <td class="action-table-data">
                            <a href="{{ route('productCatelogues.show', $product->id) }}">
                                <i data-feather="eye" class="feather-eye"></i>
                            </a>
                            <a href="{{ route('productCatelogues.edit', $product->id) }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            <form action="{{ route('productCatelogues.destroy', $product->id) }}" method="POST" style="margin-bottom: 0"
                               >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="confirm-text" style="padding: 2px; background: transparent; border: none; width: 30px; color: red">
                                    <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="16" class="text-center">No productCatelogues found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $productCatelogues->links('vendor.pagination.custom') }}
        </div>
    </div>
 
@endsection
