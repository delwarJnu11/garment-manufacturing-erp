{{-- @extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_leave_types')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Leave Type</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_leave_types')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave Type :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Lerve Type..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Days :</label>
                        <div class="col-lg-10">
                            <input type="number" name="max_days" value="{{old('max_days')}}" class="form-control" placeholder="Enter Days..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('max_days')" class="mt-2" />
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
                        <button type="submit" class="btn btn-primary">Create New Leave Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}





@extends('layout.backend.main')

@section('page_content')
    <x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">

            <div class="text-end mb-3">
                <a href="{{url('/hrm_leave_types')}}" type="submit" class="btn btn-primary">Back</a>
            </div>

            <div class="card-header">
                <h5 class="card-title">Create Leave Type</h5>
            </div>

            <div class="card-body">

                <form action="{{url('/hrm_leave_types')}}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Leave Type:</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Leave Type..." autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Days:</label>
                        <div class="col-lg-10">
                            <input type="number" name="max_days" value="{{old('max_days')}}" class="form-control" placeholder="Enter Number of Days..." autocomplete="name">
                            <x-input-error :messages="$errors->get('max_days')" class="mt-2" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Description:</label>
                        <div class="col-lg-10">
                            <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="Enter Description..." autocomplete="name">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

             
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Leave Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
