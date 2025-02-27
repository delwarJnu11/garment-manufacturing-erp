@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_attendance_list')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Attendence</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_attendance_list')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Name :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="employee_id" id="employee_id"  class="form-select">
                                <option value="" >Select a Employee </option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="date" value="{{old('date')}}" class="form-control"   autocomplete="name">
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="statuses_id" id="statuses_id"  class="form-select">
                                <option value="" >Select a Status </option>
                                @foreach ($statuses as $statuse)
                                    <option value="{{ $statuse->id }}">{{ $statuse->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('statuses_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Clock_in :</label>
                        <div class="col-lg-10">
                            <input type="text" name="clock_in" value="{{old('clock_in')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('clock_in')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Clock_out :</label>
                        <div class="col-lg-10">
                            <input type="text" name="clock_out" value="{{old('clock_out')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('clock_out')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Late_days :</label>
                        <div class="col-lg-10">
                            <input type="text" name="late_days" value="{{old('late_days')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('late_days')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave_days :</label>
                        <div class="col-lg-10">
                            <input type="text" name="leave_days" value="{{old('leave_days')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('leave_days')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Overtime_hours :</label>
                        <div class="col-lg-10">
                            <input type="text" name="overtime_hours" value="{{old('overtime_hours')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('overtime_hours')" class="mt-2" />
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Attendence</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
