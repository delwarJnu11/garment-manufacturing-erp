@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create New Order</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('order_details.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <select name="product_id" class="form-select" id="product_dropdown">
                                <option value="">Select a Product</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}">{{ $buyer->name }}
                                    </option>
                                @empty
                                    <option value="">No product Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Number</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select a Order Number</option>
                                @forelse ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_number }}</option>
                                @empty
                                    <option value="">No Order Found!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size_id" class="form-select" id="size_dropdown">
                                <option value="">Select a Size</option>
                                @forelse ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @empty
                                    <option value="">No size Found!</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Color</label>
                            <select name="color_id" class="form-select" id="color_dropdown">
                                <option value="">Select a Color</option>
                                @forelse ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @empty
                                    <option value="">No colors Found!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input class="form-control" type="text" name="qty" id="qty"
                                value="{{ old('qty') }}" placeholder="Enter Quantity..." />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">UOM</label>
                            <select name="uom_id" class="form-select" id="uom_dropdown">
                                <option value="">Select a UOM</option>
                                @forelse ($uoms as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @empty
                                    <option value="">No uom Found!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="subtotal" class="form-label">Quantity</label>
                        <input class="form-control" type="text" name="subtotal" id="subtotal"
                            value="{{ old('subtotal') }}" placeholder="Enter sub total..." />
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection
