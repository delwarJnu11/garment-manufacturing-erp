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
                    <div class="col-md-6 mb-3">
                        <input type="text" name="work_order_id" id="work_order_id" value="{{ $work_order_id }}" hidden>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cutting Section Status</label>
                            <select name="cutting_status" class="form-select" id="cutting_status">
                                <option value="">Select Section Status</option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>

                            </select>
                            <x-input-error :messages="$errors->get('cutting_status')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_pieces" class="form-label">Total Quantity</label>
                            <input class="form-control" type="text" name="total_pieces" id="total_pieces"
                                value="{{ old('total_pieces', $total_pieces) }}" placeholder="total Quantity..." />
                            <x-input-error :messages="$errors->get('total_pieces')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="total_fabric_used" class="form-label">Total Fabrics Used (m)</label>
                            <input class="form-control" type="text" name="total_fabric_used" id="total_fabric_used"
                                value="{{ old('total_fabric_used', $totalFabricsUsed) }}" placeholder="total Quantity..." />
                            <x-input-error :messages="$errors->get('total_fabric_used')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="wastage" class="form-label">Total Fabrics Wastage (m)</label>
                            <input class="form-control" type="text" name="wastage" id="wastage"
                                value="{{ old('wastage', $totalWastage) }}" placeholder="total Quantity..." />
                            <x-input-error :messages="$errors->get('wastage')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="target_quantity" class="form-label">Target Quantity (pcs)</label>
                            <input class="form-control" type="text" name="target_quantity" id="target_quantity"
                                value="{{ old('target_quantity', $total_pieces) }}" placeholder="total Quantity..." />
                            <x-input-error :messages="$errors->get('target_quantity')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="actual_quantity" class="form-label">Actual Quantity (pcs)</label>
                            <input class="form-control" type="text" name="actual_quantity" id="actual_quantity"
                                value="{{ old('actual_quantity') }}" placeholder="target Quantity..." />
                            <x-input-error :messages="$errors->get('actual_quantity')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cutting_start_date" class="form-label">Cutting Start Date</label>
                            <input class="form-control" type="date" name="cutting_start_date" id="cutting_start_date"
                                value="{{ old('cutting_start_date') }}" />
                            <x-input-error :messages="$errors->get('cutting_start_date')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cutting_end_date" class="form-label">Cutting End Date</label>
                            <input class="form-control" type="date" name="cutting_end_date" id="cutting_end_date"
                                value="{{ old('cutting_end_date') }}" />
                            <x-input-error :messages="$errors->get('cutting_end_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <button type="btn" id="create_btn" class="btn btn-primary">Start Cutting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
