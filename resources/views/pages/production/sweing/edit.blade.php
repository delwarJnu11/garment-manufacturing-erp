@extends('layout.backend.main')

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Production Sweing Section</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('sweing.update', $sweing->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="work_order_id" id="work_order_id" value="{{ $sweing->work_order_id }}">
                    <input type="hidden" name="cutting_id" id="cutting_id" value="{{ $sweing->cutting_id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sewing Status</label>
                            <select name="sewing_status" class="form-select" id="sewing_status">
                                <option value="">Select Sewing Status</option>
                                <option value="Pending"
                                    {{ old('sewing_status', $sweing->sewing_status) == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="In Progress"
                                    {{ old('sewing_status', $sweing->sewing_status) == 'In Progress' ? 'selected' : '' }}>In
                                    Progress</option>
                                <option value="Completed"
                                    {{ old('sewing_status', $sweing->sewing_status) == 'Completed' ? 'selected' : '' }}>
                                    Completed</option>
                            </select>
                            <x-input-error :messages="$errors->get('sewing_status')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_quantity" class="form-label">Total Quantity</label>
                            <input class="form-control" type="number" name="total_quantity" id="total_quantity"
                                value="{{ old('total_quantity', $sweing->total_quantity) }}"
                                placeholder="Total Quantity..." />
                            <x-input-error :messages="$errors->get('total_quantity')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="target_quantity" class="form-label">Target Quantity</label>
                            <input class="form-control" type="number" name="target_quantity" id="target_quantity"
                                value="{{ old('target_quantity', $sweing->target_quantity) }}"
                                placeholder="Target Quantity..." />
                            <x-input-error :messages="$errors->get('target_quantity')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="swen_complete" class="form-label">Swen Completed (pcs)</label>
                            <input class="form-control" type="text" name="swen_complete" id="swen_complete"
                                value="{{ old('swen_complete', $sweing->swen_complete ?? 0) }}"
                                placeholder="swen_complete (e.g., 95.5)" />
                            <x-input-error :messages="$errors->get('swen_complete')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="actual_quantity" class="form-label">Actual Quantity</label>
                            <input class="form-control" type="number" name="actual_quantity" id="actual_quantity"
                                value="{{ old('actual_quantity') }}" placeholder="Actual Quantity..." />
                            <x-input-error :messages="$errors->get('actual_quantity')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="wastage" class="form-label">Wastage</label>
                            <input class="form-control" type="number" name="wastage" id="wastage"
                                value="{{ old('wastage', $sweing->wastage) }}" placeholder="Wastage..." />
                            <x-input-error :messages="$errors->get('wastage')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sewing_start_date" class="form-label">Sewing Start Date</label>
                            <input class="form-control" type="date" name="sewing_start_date" id="sewing_start_date"
                                value="{{ old('sewing_start_date', $sweing->sewing_start_date) }}" />
                            <x-input-error :messages="$errors->get('sewing_start_date')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sewing_end_date" class="form-label">Sewing End Date</label>
                            <input class="form-control" type="date" name="sewing_end_date" id="sewing_end_date"
                                value="{{ old('sewing_end_date', $sweing->sewing_end_date) }}" />
                            <x-input-error :messages="$errors->get('sewing_end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="3">{{ old('remarks', $sweing->remarks) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" id="update_btn" class="btn btn-primary">Update Sewing</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swenQty = document.getElementById('swen_complete');
            swenQty.addEventListener('change', function() {
                const qty = swenQty.value;
                document.getElementById('actual_quantity').value = qty;
            });
        });
    </script>
@endsection
