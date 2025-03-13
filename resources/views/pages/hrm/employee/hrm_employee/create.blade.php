@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('hrm_employees')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Employee</h5>
            </div>
            <div class="card-body">
                <form action="{{url('hrm_employees')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">EmployeeID :</label>
                        <div class="col-lg-10">
                            <input type="text" name="employee_id" value="{{old('employee_id')}}" class="form-control" placeholder="Enter Employee Name..." autocomplete="name">
                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Employee Name..." autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Email :</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email ..." autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Phone Number :</label>
                        <div class="col-lg-10">
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter Phone Number..." autocomplete="email">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="col-lg-2 col-form-label">Gender :</label>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="male" class="form-check-input"
                                {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="female" class="form-check-input"
                                {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Date Of Birth :</label>
                        <div class="col-lg-10">
                            <input type="date" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control" placeholder="Enter Joining_date ..." autocomplete="name">
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Department Name :</label>
                        <div class="col-lg-10">
                            <select name="department_id" id="department_id" class="form-select" value="{{old('department_id')}}">
                                <option value="">Select a Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Designation:</label>
                        <div class="col-lg-10">
                            <select name="designations_id" id="designations_id" class="form-select" value="{{old('designations_id')}}">
                                <option value="">Select a Designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('designations_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status :</label>
                        <div class="col-lg-10">
                            <select name="statuses_id" id="statuses_id" class="form-select" value="{{old('statuses_id')}}">
                                <option value="">Select a Status</option>
                                @foreach ($status as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('statuses_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Salary :</label>
                        <div class="col-lg-10">
                            <input type="text" name="salary" value="{{old('salary')}}" class="form-control" placeholder="Enter Salary..." autocomplete="name">
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Branch :</label>
                        <div class="col-lg-10">
                            <input type="text" name="branch" value="{{old('branch')}}" class="form-control" placeholder="Enter Branch..." autocomplete="name">
                            <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Photo :</label>
                        <div class="col-lg-10">
                            <input type="file" name="photo" value="{{old('photo')}}" class="form-control" autocomplete="name">
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Resume :</label>
                        <div class="col-lg-10">
                            <input type="file" name="resume" value="{{old('resume')}}" class="form-control" autocomplete="name">
                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Certificate :</label>
                        <div class="col-lg-10">
                            <input type="file" name="certificate" value="{{old('certificate')}}" class="form-control" autocomplete="name">
                            <x-input-error :messages="$errors->get('certificate')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Joining Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="joining_date" value="{{old('joining_date')}}" class="form-control" autocomplete="name">
                            <x-input-error :messages="$errors->get('joining_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Address :</label>
                        <div class="col-lg-10">
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address..." autocomplete="name">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">City :</label>
                        <div class="col-lg-10">
                            <input type="text" name="city" value="{{old('city')}}" class="form-control" placeholder="Enter City..." autocomplete="name">
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
