@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_employee_performances')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Employee Performance</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_employee_performances')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Name:</label>
                        <div class="col-lg-10">
                            <select name="employees_id" id="employees_id" class="form-select">
                                <option value="">Select an Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employees_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('employees_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Department Name:</label>
                        <div class="col-lg-10">
                            <select name="department_id" id="department_id" class="form-select">
                                <option value="">Select a Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Designation:</label>
                        <div class="col-lg-10">
                            <select name="designations_id" id="designations_id" class="form-select">
                                <option value="">Select a Designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}" {{ old('designations_id') == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                                @endforeach
                            </select>
                            @error('designations_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status:</label>
                        <div class="col-lg-10">
                            <select name="statuses_id" id="statuses_id" class="form-select">
                                <option value="">Select a Status</option>
                                @foreach ($status as $data)
                                    <option value="{{ $data->id }}" {{ old('statuses_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('statuses_id')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Branch:</label>
                        <div class="col-lg-10">
                            <input type="text" name="branch" value="{{old('branch')}}" class="form-control" placeholder="Enter Employee Branch..." autocomplete="name">
                            @error('branch')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Subject:</label>
                        <div class="col-lg-10">
                            <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="Enter Subject..." autocomplete="email">
                            @error('subject')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Goals:</label>
                        <div class="col-lg-10">
                            <input type="text" name="goals" value="{{old('goals')}}" class="form-control" placeholder="Enter Goals ..." autocomplete="email">
                            @error('goals')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Target Achievement:</label>
                        <div class="col-lg-10">
                            <input type="number" name="target_achievement" value="{{old('target_achievement')}}" class="form-control" placeholder="Enter Target Achievement ..." autocomplete="name">
                            @error('target_achievement')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Target Rating:</label>
                        <div class="col-lg-10">
                            <input type="number" name="target_rating" value="{{old('target_rating')}}" class="form-control" placeholder="Enter Target Rating..." autocomplete="name">
                            @error('target_rating')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Overall Rating:</label>
                        <div class="col-lg-10">
                            <input type="number" name="overall_rating" value="{{old('overall_rating')}}" class="form-control" placeholder="Enter Overall Rating..." autocomplete="name">
                            @error('overall_rating')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Start Date:</label>
                        <div class="col-lg-10">
                            <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control">
                            @error('start_date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">End Date:</label>
                        <div class="col-lg-10">
                            <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control">
                            @error('end_date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Feedback:</label>
                        <div class="col-lg-10">
                            <input type="text" name="feedback" value="{{old('feedback')}}" class="form-control">
                            @error('feedback')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Appraisal Date:</label>
                        <div class="col-lg-10">
                            <input type="date" name="appraisal_date" value="{{old('appraisal_date')}}" class="form-control">
                            @error('appraisal_date')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Employee Performance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
