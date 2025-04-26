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
                <h4 style="color: white">Update Package Form</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('packaging.update', $packaging->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_id" class="form-label">Order Number</label>
                            <input type="hidden" name="order_id" id="order_id"
                                value="{{ old('order_id', $packaging->order_id) }}" class="form-control" required>
                            <input type="text" name="order_number" id="order_number"
                                value="{{ old('order_number', $packaging->order->order_number) }}" class="form-control"
                                readonly required>
                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="product_id" class="form-label">Product Name</label>
                            <input type="hidden" name="product_id" id="product_id"
                                value="{{ old('product_id', $packaging->product_id) }}" class="form-control" required>
                            <input type="text" name="product_name" id="proudct_name"
                                value="{{ old('product_name', $packaging->product->name) }}" class="form-control" readonly
                                required>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity</label>
                            <input type="number" name="total_quantity" id="total_quantity"
                                value="{{ old('total_quantity', $packaging->total_quantity) }}" readonly
                                class="form-control" required>
                            <x-input-error :messages="$errors->get('total_quantity')" class="mt-2" />
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="package_qty" class="form-label">Package Quantity</label>
                            <input type="number" name="package_qty" id="package_qty" value="{{ old('package_qty') }}"
                                class="form-control" required>
                            <x-input-error :messages="$errors->get('package_qty')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="packaged_quantity" class="form-label">Packaged Quantity</label>
                            <input type="number" name="packaged_quantity" id="packaged_quantity"
                                value="{{ old('packaged_quantity', $packaging->packaged_quantity) }}" class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('packaged_quantity')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Select Status</option>
                                <option {{ $packaging->status === 'Pending' ? 'selected' : '' }} value="Pending">Pending
                                </option>
                                <option {{ $packaging->status === 'In Progress' ? 'selected' : '' }} value="In Progress">In
                                    Progress</option>
                                <option {{ $packaging->status === 'Completed' ? 'selected' : '' }} value="Completed">
                                    Completed
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks', $packaging->remarks) }}</textarea>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Update Packaging</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(function() {
            $('#package_qty').on('change', function() {
                const packageQty = parseInt($(this).val());
                const prevPackagedQty = parseInt($('#packaged_quantity').val()) || 0;

                $('#packaged_quantity').val(prevPackagedQty + packageQty);
            })
        })
    </script>
@endsection
