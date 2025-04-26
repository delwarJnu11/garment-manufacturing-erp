@extends('layout.backend.main')

@section('page_content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Package Form</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('packaging.store') }}">
                    @csrf
                    <input type="hidden" name="work_order_id" value="{{ $workOrderId }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_id" class="form-label">Order Number</label>
                            <input type="hidden" name="order_id" id="order_id" value="{{ old('order_id', $order->id) }}"
                                class="form-control" required>
                            <input type="text" name="order_number" id="order_number"
                                value="{{ old('order_number', $order->order_number) }}" class="form-control" readonly
                                required>
                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="product_id" class="form-label">Product Name</label>
                            <input type="hidden" name="product_id" id="product_id"
                                value="{{ old('product_id', $productId) }}" class="form-control" required>
                            <input type="text" name="product_name" id="proudct_name"
                                value="{{ old('product_name', $productName) }}" class="form-control" readonly required>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity</label>
                            <input type="number" name="total_quantity" id="total_quantity"
                                value="{{ old('total_quantity', $totalQuantity) }}" readonly class="form-control" required>
                            <x-input-error :messages="$errors->get('total_quantity')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="packaged_quantity" class="form-label">Packaged Quantity</label>
                            <input type="number" name="packaged_quantity" id="packaged_quantity"
                                value="{{ old('packaged_quantity') }}" class="form-control" required>
                            <x-input-error :messages="$errors->get('packaged_quantity')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="packaged_by" class="form-label">Package Manager</label>
                            <select name="packaged_by" id="packaged_by" class="form-select" required>
                                <option value="">Select Packaged Manager</option>
                                @forelse ($packageManagers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>

                                @empty
                                    <option class="text-danger" value="">No manager found</option>
                                    </option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('packaged_by')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="Pending">Pending
                                </option>
                                <option value="In Progress">In
                                    Progress</option>
                                <option value="Completed">Completed
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="packaging_start" class="form-label">Packaging Start Date</label>
                            <input type="date" name="packaging_start" id="packaging_start"
                                value="{{ old('packaging_start') }}" class="form-control" required>
                            <x-input-error :messages="$errors->get('packaging_start')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="packaging_end" class="form-label">Packaging End Date</label>
                            <input type="date" name="packaging_end" id="packaging_end"
                                value="{{ old('packaging_end') }}" class="form-control" required>
                            <x-input-error :messages="$errors->get('packaging_end')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks') }}</textarea>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Add Packaging</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
