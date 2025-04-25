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
                <h4 style="color: white">Quality Check Form</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('qc.update', $qualityCheck->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_order_id" value="{{ $qualityCheck->work_order_id }}">
                    <input type="hidden" name="id" value="{{ $qualityCheck->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_id" class="form-label">Order ID</label>
                            <input type="text" value="{{ $qualityCheck->order->order_number }}" class="form-control"
                                readonly>
                            <input type="hidden" name="order_id" value="{{ $qualityCheck->order_id }}">

                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity</label>
                            <input type="number" name="total_quantity" id="total_quantity"
                                value="{{ old('total_quantity', $qualityCheck->total_quantity) }}" class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('total_quantity')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_quantity" class="form-label">Check Quantity</label>
                            <input type="number" name="check_qty" id="check_qty" value="{{ old('check_qty') }}"
                                class="form-control" placeholder="Enter current check quantity..." required>
                            <x-input-error :messages="$errors->get('check_qty')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="checked_quantity" class="form-label">Checked Quantity</label>
                            <input type="number" name="checked_quantity" id="checked_quantity"
                                value="{{ old('checked_quantity', $qualityCheck->checked_quantity) }}" class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('checked_quantity')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="rejected_quantity" class="form-label">Rejected Quantity</label>
                            <input type="number" name="rejected_quantity" id="rejected_quantity"
                                value="{{ old('rejected_quantity') }}" class="form-control" required>
                            <x-input-error :messages="$errors->get('rejected_quantity')" class="mt-2" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="passed_quantity" class="form-label">Passed Quantity</label>
                            <input type="number" name="passed_quantity" id="passed_quantity"
                                value="{{ old('passed_quantity', $qualityCheck->passed_quantity) }}" class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('passed_quantity')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="Pending"
                                    {{ old('status', $qualityCheck->status) == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="In Progress"
                                    {{ old('status', $qualityCheck->status) == 'In Progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="Completed"
                                    {{ old('status', $qualityCheck->status) == 'Completed' ? 'selected' : '' }}>Completed
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks', $qualityCheck->remarks) }}</textarea>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Add Quality Check</button>
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
            $('#check_qty').on('change', function() {
                const newQty = parseInt($(this).val());
                const prevQty = parseInt($('#checked_quantity').val());
                const passedQty = parseInt($('#passed_quantity').val());
                $('#checked_quantity').val(newQty + prevQty);
                $('#passed_quantity').val(newQty + passedQty);
            })
            $('#rejected_quantity').on('change', function() {
                const newQty = parseInt($(this).val());
                const passedQty = parseInt($('#passed_quantity').val());
                $('#passed_quantity').val(passedQty - newQty);
            })
        })
    </script>
@endsection
