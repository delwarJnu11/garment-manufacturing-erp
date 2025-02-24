@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Order Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('order_details.store') }}" method="POST">
                    @csrf

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Product Name</label>
                            <select name="product_id" class="form-select" id="product_dropdown">
                                <option value="">Select Product</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}
                                    </option>
                                @empty
                                    <option value="">No product Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Order Number</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select Order Number</option>
                                @forelse ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_number }}</option>
                                @empty
                                    <option value="">No Order Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size_id" class="form-select" id="size_dropdown">
                                <option value="">Select Size</option>
                                @forelse ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @empty
                                    <option value="">No size Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Color</label>
                            <select name="color_id" class="form-select" id="color_dropdown">
                                <option value="">Select Color</option>
                                @forelse ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @empty
                                    <option value="">No colors Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input class="form-control" type="text" name="qty" id="qty"
                                value="{{ old('qty') }}" placeholder="Qty" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">UOM</label>
                            <select name="uom_id" class="form-select" id="uom_dropdown">
                                <option value="">Select UOM</option>
                                @forelse ($uoms as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @empty
                                    <option value="">No uom Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-1 mt-3">
                            <button class="form_btn p-2" style="background: green !important; color:#fff !important;">
                                <i data-feather="plus" class="feather-edit"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection
