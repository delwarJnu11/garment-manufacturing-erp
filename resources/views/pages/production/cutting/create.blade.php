@extends('layout.backend.main')

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Production Cutting Section</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cutting.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Order Number</label>
                        <select name="order_id" class="form-select" id="order_dropdown" readonly>
                            <option value="">Select Order</option>
                            @forelse ($orders as $order)
                                <option {{ $order_id == $order->id ? 'selected' : '' }} value="{{ $order->id }}">
                                    {{ $order->order_number }} -
                                    {{ $order->buyer->first_name . ' ' . $order->buyer->last_name }}
                                </option>
                            @empty
                                <option value="">No order Found!</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Cutting Section Status</label>
                        <select name="cutting_status" class="form-select" id="cutting_status">
                            <option value="">Select Section Manager</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>

                        </select>
                        <x-input-error :messages="$errors->get('cutting_status')" class="mt-2" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Work Order Status</label>
                        <select name="work_order_status_id" class="form-select" id="work_order_status">
                            <option value="">Select Work Order Status</option>
                            @forelse ($workStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @empty
                                <option value="">No work orderstatus Found!</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('work_order_status_id')" class="mt-2" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="total_pieces" class="form-label">Total Quantity</label>
                        <input class="form-control" type="text" name="total_pieces" id="total_pieces"
                            value="{{ old('total_pieces', $totalQty) }}" placeholder="total Quantity..." />
                        <x-input-error :messages="$errors->get('total_pieces')" class="mt-2" />
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="btn" id="create_btn" class="btn btn-primary">Create Work Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
