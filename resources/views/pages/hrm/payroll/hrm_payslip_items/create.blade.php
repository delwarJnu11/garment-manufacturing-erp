@extends('layout.backend.main')

@section('page_content')
<x-success/>
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card flex-fill">
            <div class="text-end">
                <a href="{{url('/hrm_payslip_items')}}" type="submit" class="btn btn-primary">Back</a>
            </div>
            <div class="card-header">
                <h5 class="card-title">Create Payslip Items</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/hrm_payslip_items')}}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Payslip Items Name :</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Payslip Items Name..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label">Factor :</label>
                        <div class="col-lg-10">
                            <input type="text" name="factor" value="{{old('factor')}}" class="form-control" placeholder="Enter Factor..."  autocomplete="name">
                            <x-input-error :messages="$errors->get('factor')" class="mt-2" />
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create New Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
