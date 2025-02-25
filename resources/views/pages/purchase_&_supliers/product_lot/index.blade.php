@extends('layout.backend.main')

@section('page_content')

@if (session('error'))
<div class="alert alert-danger">
    <strong>Error!</strong> {{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-4">
    <div class="card flex-fill">
        <x-page-header heading="Product Lot" btnText="Add Product Lt" href="{{ url('product_lots/create') }}" />
        
      
            <table class="table table-bordered">
                <thead class="thead-primary">
                    <tr>
                        <th>ID</th>
                        <th>Raw Material ID</th>
                        <th>Quantity</th>
                        <th>Cost Price</th>
                        <th>Warehouse ID</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product_lots as $product_lot)
                    <tr>
                        <td>{{ $product_lot->id }}</td>
                        <td>{{ $product_lot->raw_material_id }}</td>
                        <td>{{ $product_lot->quantity }}</td>
                        <td>{{ $product_lot->cost_price }}</td>
                        <td>{{ $product_lot->warehouse_id }}</td>
                        <td>{{ $product_lot->description }}</td>
                        <td>{{ $product_lot->created_at }}</td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="{{ route('product_lots.show', $product_lot->id) }}">
                                    <i data-feather="eye" class="feather-eye"></i>
                                </a>
                                <a class="me-2 p-2" href="{{ route('product_lots.edit', $product_lot->id) }}">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>
                                <form action="{{ route('product_lots.destroy', $product_lot->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product lot?')" style="display: inline-block; margin-bottom: 0px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: transparent; border: none; color: red;">
                                        <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Product Lots Found</td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $product_lots->links() }}
            </div>
        </div>
    </div>



@endsection
