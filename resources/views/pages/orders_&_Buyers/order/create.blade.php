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
                                <option value="">Select a Buyer</option>
                                @forelse ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}">{{ $buyer->first_name }} {{ $buyer->last_name }}
                                    </option>
                                @empty
                                    <option value="">No Buyer Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('buyer_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supervisor Name</label>
                            <select name="supervisor_id" class="form-select" id="supervisor_dropdown">
                                <option value="">Select a Supervisor</option>
                                @forelse ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                @empty
                                    <option value="">No Supervisor Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('supervisor_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Status</label>
                            <select name="status_id" class="form-select" id="status_dropdown">
                                <option value="">Select a Status</option>
                                @forelse ($order_status as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @empty
                                    <option value="">No order status Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fabric Type</label>
                            <select name="fabric_type_id" class="form-select" id="fabric_dropdown">
                                <option value="">Select a Fabric Type</option>
                                @forelse ($fabrics_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @empty
                                    <option value="">No fabrics types Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('fabric_type_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gsm" class="form-label">GSM</label>
                            <input class="form-control" type="text" name="gsm" id="gsm"
                                value="{{ old('gsm') }}" placeholder="Enter GSM..." />
                                <x-input-error :messages="$errors->get('gsm')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="delivery_date" class="form-label">Delivery Date</label>
                            <input class="form-control" type="date" name="delivery_date" id="delivery_date"
                                value="{{ old('delivery_date') }}">
                                <x-input-error :messages="$errors->get('delivery_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter product description"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
