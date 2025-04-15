@extends('layout.backend.main')
@section('title','Create Account')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('accounts.index')}}">Manage</a>
<form action="{{route('accounts.store')}}" method ="post" enctype="multipart/form-data">
@csrf
{{-- <div class="row mb-3">
	<label for="code" class="col-sm-2 col-form-label">Code</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="code" id="code" placeholder="Code">
	</div>
</div> --}}


<div class="row mb-3">
	<label for="name" class="col-sm-2 col-form-label">Name</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="name" id="name" placeholder="Name">
	</div>
</div>
<div class="row mb-3">
	<label for="account_group_id" class="col-sm-2 col-form-label">Account_Group</label>
	<div class="col-sm-10">
		<select class="form-control" name="account_group_id" id="account_group_id">
			@foreach($accountGroups as $account_group)
				<option value="{{$account_group->id}}">{{$account_group->name}}</option>
			@endforeach
		</select>
	</div>
</div>


<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
	</div>
</div>
<div class="row mb-3">
	<label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
	<div class="col-sm-10">
		<input value="1" type = "text" class="form-control" name="is_active" id="is_active" placeholder="Is Active">
	</div>
</div>
<div class="row mb-3">
	<label for="is_payment_method" class="col-sm-2 col-form-label">Is Payment Method</label>
	<div class="col-sm-10">
		<input value="0" type = "text" class="form-control" name="is_payment_method" id="is_payment_method" placeholder="Is Payment Method">
	</div>
</div>
<div class="row mb-3">
	<label for="is_trx_no_required" class="col-sm-2 col-form-label">Is Trx No Required</label>
	<div class="col-sm-10">
		<input value="0" type = "text" class="form-control" name="is_trx_no_required" id="is_trx_no_required" placeholder="Is Trx No Required">
	</div>
</div>

<button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
@section('script')


@endsection
