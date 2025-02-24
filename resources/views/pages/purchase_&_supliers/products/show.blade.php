@extends('layout.backend.main')

@section('page_content')
    <x-page-header heading="Product Details" btnText="Back" href="{{ route('products.index') }}" />

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Photo</th>
                    <td>
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}"
                                width="100" height="100" style="border-radius: 5px;">
                        @else
                            No Image Available
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>SKU</th>
                    <td>{{ $product->sku }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $product->description }}</td>
                </tr>
                
                
                
                <tr>
                    <th>Barcode</th>
                    <td>{{ $product->barcode }}</td>
                </tr>
                {{-- <tr>
                    <th>RFID</th>
                    <td>{{ $product->rfid }}</td>
                </tr> --}}
                <tr>
                    <th>Category</th>
                    <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                </tr>
                <tr>
                    <th>UOM</th>
                    <td>{{ $product->uom ? $product->uom->name : 'No Units Available' }}</td>
                </tr>
               
                <tr>
                    <th>Created At</th>
                    <td>{{ $product->created_at->format('d M, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
