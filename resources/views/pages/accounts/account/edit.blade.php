@extends('layout.backend.main')
@section('title','Edit Account')
@section('style')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('accounts.index')}}">Manage</a>
<form action="{{route('accounts.update',$account)}}" method ="post" enctype="multipart/form-data">
@csrf
@method("PUT")
<div class="row mb-3">
	<label for="code" class="col-sm-2 col-form-label">Code</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="code" value="{{$account->code}}" id="code" placeholder="Code">
	</div>
</div>
<div class="row mb-3">
	<label for="name" class="col-sm-2 col-form-label">Name</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="name" value="{{$account->name}}" id="name" placeholder="Name">
	</div>
</div>
<div class="row mb-3">
	<label for="account_group_id" class="col-sm-2 col-form-label">Account_Group</label>
	<div class="col-sm-10">
		<select class="form-control" name="account_group_id" id="account_group_id">
			@foreach($account_groups as $account_group)
				@if($account_group->id==$account->account_group_id)
					<option value="{{$account_group->id}}" selected>{{$account_group->name}}</option>
				@else
					<option value="{{$account_group->id}}">{{$account_group->name}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row mb-3">
	<label for="is_payment_method" class="col-sm-2 col-form-label">Is Payment Method</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="is_payment_method" value="{{$account->is_payment_method}}" id="is_payment_method" placeholder="Is Payment Method">
	</div>
</div>
<div class="row mb-3">
	<label for="is_trx_no_required" class="col-sm-2 col-form-label">Is Trx No Required</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="is_trx_no_required" value="{{$account->is_trx_no_required}}" id="is_trx_no_required" placeholder="Is Trx No Required">
	</div>
</div>
<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="description" value="{{$account->description}}" id="description" placeholder="Description">
	</div>
</div>
<div class="row mb-3">
	<label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="is_active" value="{{$account->is_active}}" id="is_active" placeholder="Is Active">
	</div>
</div>
<div class="row mb-3">
	<label for="created_by" class="col-sm-2 col-form-label">Created By</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="created_by" value="{{$account->created_by}}" id="created_by" placeholder="Created By">
	</div>
</div>
<div class="row mb-3">
	<label for="updated_by" class="col-sm-2 col-form-label">Updated By</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="updated_by" value="{{$account->updated_by}}" id="updated_by" placeholder="Updated By">
	</div>
</div>

<button type="submit" class="btn btn-primary">Save Change</button>
</form>
@endsection
@section('script')


@endsection
