@extends('layout.backend.main')

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Production Work Order</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <select hidden name="production_plan_id" class="form-select" id="production_plan_dropdown">
                            <option value="">Select Production Plan</option>
                            @forelse ($productionPlans as $productionPlan)
                                <option value="{{ $productionPlan->id }}">{{ $productionPlan->id }}</option>
                            @empty
                                <option value="">No productionPlan Found!</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('production_plan_id')" class="mt-2" />
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Number</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select Order</option>
                                @forelse ($orders as $order)
                                    <option value="{{ $order->id }}">
                                        {{ $order->order_number }} -
                                        {{ $order->buyer->first_name . ' ' . $order->buyer->last_name }}
                                    </option>
                                @empty
                                    <option value="">No order Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Work Section manager</label>
                            <select name="assign_to" class="form-select" id="assign_to">
                                <option value="">Select Section Manager</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option value="">No user Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('assign_to')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Production Work Section</label>
                            <select name="production_work_section_id" class="form-select"
                                id="production_work_section_dropdown">
                                <option value="">Select Prodction Work Section</option>
                                @forelse ($workSections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @empty
                                    <option value="">No section Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('production_work_section_id')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Production Work Section</label>
                            <select name="production_work_status_id" class="form-select"
                                id="production_work_status_dropdown">
                                <option value="">Select Prodction Work Section</option>
                                @forelse ($workStatuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @empty
                                    <option value="">No status Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('production_work_status_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="target_qty" class="form-label">Target Quantity</label>
                            <input class="form-control" type="text" name="target_qty" id="target_qty"
                                value="{{ old('target_qty') }}" placeholder="Target Quantity..." />
                            <x-input-error :messages="$errors->get('target_qty')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="actual_qty" class="form-label">Actual Quantity</label>
                            <input class="form-control" type="text" name="actual_qty" id="actual_qty"
                                value="{{ old('actual_qty') }}" placeholder="Actual Quantity..." />
                            <x-input-error :messages="$errors->get('actual_qty')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="btn" id="create_btn" class="btn btn-primary">Create Work Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
