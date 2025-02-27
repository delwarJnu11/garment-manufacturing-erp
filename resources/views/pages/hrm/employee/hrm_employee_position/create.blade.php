@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_employee_positions')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Department</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_employee_positions')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Position Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
                            <input type="text" name="salary" value="{{old('salary')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Description :</label>
                        <div class="col-lg-10">
                            <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
