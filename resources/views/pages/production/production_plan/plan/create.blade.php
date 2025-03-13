@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create New Production Plan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('production-plans.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Number</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select a Order</option>
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
                            <label class="form-label">Status</label>
                            <select name="production_plan_status_id" class="form-select" id="status_dropdown">
                                <option value="">Select a Status</option>
                                @forelse ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @empty
                                    <option value="">No status Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('production_plan_status_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="production_line" class="form-label">Production Line</label>
                            <input class="form-control" type="text" name="production_line" id="production_line"
                                value="{{ old('production_line') }}" placeholder="Enter Production Line...">
                            <x-input-error :messages="$errors->get('production_line')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="daily_target" class="form-label">Daily Target</label>
                            <input class="form-control" type="text" name="daily_target" id="daily_target"
                                value="{{ old('daily_target') }}" placeholder="Enter Daily Target...">
                            <x-input-error :messages="$errors->get('daily_target')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="allocated_machines" class="form-label">Allocated Machines</label>
                            <input class="form-control" type="text" name="allocated_machines" id="allocated_machines"
                                value="{{ old('allocated_machines') }}" placeholder="Enter Allocated Machines...">
                            <x-input-error :messages="$errors->get('allocated_machines')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="allocated_workers" class="form-label">Allocated Workers</label>
                            <input class="form-control" type="text" name="allocated_workers" id="allocated_workers"
                                value="{{ old('allocated_workers') }}" placeholder="Enter Allocated Workers...">
                            <x-input-error :messages="$errors->get('allocated_workers')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input class="form-control" type="date" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input class="form-control" type="date" name="end_date" id="end_date"
                                value="{{ old('end_date') }}">
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary">Create Production Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
