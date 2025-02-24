@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_employee_bank_accounts')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Department</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_employee_bank_accounts')}}" method="POST">
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
                        <label class="col-lg-2 col-form-label">Bank Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="bank_name" value="{{old('bank_name')}}" class="form-control" placeholder="Enter Bank Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Account_number :</label>
                        <div class="col-lg-10">
                            <input type="text" name="account_number" value="{{old('account_number')}}" class="form-control" placeholder="Enter Account_number..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Branch_name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="branch_name" value="{{old('branch_name')}}" class="form-control" placeholder="Enter Branch_name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Branch_location :</label>
                        <div class="col-lg-10">
                            <input type="text" name="branch_location" value="{{old('branch_location')}}" class="form-control" placeholder="Enter Branch_location..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('branch_location')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Bank_identifier_code :</label>
                        <div class="col-lg-10">
                            <input type="text" name="bank_identifier_code" value="{{old('bank_identifier_code')}}" class="form-control" placeholder="Enter Bank_identifier_code..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('bank_identifier_code')" class="mt-2" />
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
