@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_leave_applications')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Leave Application</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_leave_applications')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Name:</label>
                        <div class="col-lg-10">
                            <select name="employee_id" id="employee_id" class="form-select">
                                <option value="">Select an Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Type Name :</label>
                        <div class="col-lg-10">
                            <select name="leave_type_id" id="leave_type_id" class="form-select">
                                <option value="">Select a Leave Type</option>
                                @foreach ($leave_types as $leave_type)
                                    <option value="{{ $leave_type->id }}" {{ old('leave_type_id') == $leave_type->id ? 'selected' : '' }}>{{ $leave_type->name }}</option>
                                @endforeach
                            </select>
                            @error('leave_type_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Apply Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="date" value="{{old('date')}}" class="form-control"  autocomplete="name">
                            @error('date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave Start Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control"  autocomplete="email">
                            @error('start_date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave End Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control"  autocomplete="email">
                            @error('end_date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Duration :</label>
                        <div class="col-lg-10">
                            <input type="text" name="duration" value="{{old('duration')}}" class="form-control" placeholder="Enter Duration..." autocomplete="name">
                            @error('duration')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave Reason :</label>
                        <div class="col-lg-10">
                            <input type="text" name="reason" value="{{old('reason')}}" class="form-control" placeholder="Enter Reason..." autocomplete="name">
                            @error('reason')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Application Form :</label>
                        <div class="col-lg-10">
                            <input type="file" name="photo" value="{{old('photo')}}" class="form-control">
                            @error('photo')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Leave Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


