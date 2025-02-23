@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_employees')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Department</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_employees')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Employee Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Email Number :</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email Number..."  autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Phone Number :</label>
                        <div class="col-lg-10">
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter Phone Number..."  autocomplete="email">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="col-lg-2 col-form-label">Gender :</label>
                        <div class="form-check form-check-inline">
                            <label  class="form-check-label">Male :</label>
                            <input type="radio" name="gender" value="{{old('phone')}}" class="form-check-input">
                        </div>
                        <div class="form-check form-check-inline">
                            <label  class="form-check-label">Female</label>
                            <input type="radio" name="gender" value="{{old('phone')}}" class="form-check-input" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Date Of Birth :</label>
                        <div class="col-lg-10">
                            <input type="date" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control" placeholder="Enter Joining_date ..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Department Name :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="department_id" id="departments_id"  class="form-select">
                                <option value="" >Select a Department </option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('departments_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Position :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="statuses_id" id="statuses_id"  class="form-select">
                                <option value="" >Select a Position </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('statuses_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Employee Designation:</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="statuses_id" id="statuses_id"  class="form-select">
                                <option value="" >Select a Position </option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('statuses_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="statuses_id" id="statuses_id"  class="form-select">
                                <option value="" >Select a Status </option>
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
                            <input type="text" name="salary" value="{{old('salary')}}" class="form-control" placeholder="Enter Salary..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Joining Date :</label>
                        <div class="col-lg-10">
                            <input type="date" name="joining_date" value="{{old('joining_date')}}" class="form-control" placeholder="Enter Joining_date ..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('joining_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Address :</label>
                        <div class="col-lg-10">
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">City :</label>
                        <div class="col-lg-10">
                            <input type="text" name="city" value="{{old('city')}}" class="form-control" placeholder="Enter City Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Position</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
