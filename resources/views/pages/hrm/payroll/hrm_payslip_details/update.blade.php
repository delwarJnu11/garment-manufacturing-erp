@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_departments')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Department</h5>
            </div>
            <div class="card-body">
                <form action="{{url("hrm_departments/{$departments['id']}")}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Department Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{$departments->name}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Status :</label>
                        <div class="col-lg-10">
                            {{-- <input type="text" name="statuses_id" value="{{old('statuses_id')}}" class="form-control" placeholder="Enter Status Name..."  autocomplete="name"> --}}
                            <select name="statuses_id" id="statuses_id"  class="form-select">
                                <option value="" >Select a Department </option>
                                @foreach ($status as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    <option {{ $departments->statuses_id ===  $data->id ? 'selected' : '' }}
                                        value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('statuses_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Description :</label>
                        <div class="col-lg-10">
                            <input type="text" name="description" value="{{$departments->description}}" class="form-control" placeholder="Enter Role Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Change Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
