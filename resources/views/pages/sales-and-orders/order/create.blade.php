@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create New Order</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Buyer Name</label>
                            <select name="buyer_id" class="form-select" id="buyer_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supervisor Name</label>
                            <select name="supervisor_id" class="form-select" id="supervisor_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Status</label>
                            <select name="status_id" class="form-select" id="status_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fabric Type</label>
                            <select name="fabric_type_id" class="form-select" id="fabric_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gsm" class="form-label">GSM</label>
                            <input class="form-control" type="text" name="gsm" id="gsm" value="{{old('gsm')}}" placeholder="Enter GSM..." />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="delivery_date" class="form-label">Delivery Date</label>
                            <input class="form-control" type="datetime" name="delivery_date" id="delivery_date" value="{{old('delivery_date')}}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter product description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection
