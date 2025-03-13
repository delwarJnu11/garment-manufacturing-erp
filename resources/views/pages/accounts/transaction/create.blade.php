@extends('layout.backend.main')
@section('title','Create Transaction')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('transactions.index')}}">Manage</a>
<form action="{{route('transactions.store')}}" method ="post" enctype="multipart/form-data">
@csrf
<div class="row mb-3">
	<label for="voucher_ref" class="col-sm-2 col-form-label">Voucher Ref</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="voucher_ref" id="voucher_ref" placeholder="Voucher Ref">
	</div>
</div>
<div class="row mb-3">
	<label for="transaction_date" class="col-sm-2 col-form-label">Transaction Date</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="transaction_date" id="transaction_date" placeholder="Transaction Date">
	</div>
</div>
<div class="row mb-3">
	<label for="account_id" class="col-sm-2 col-form-label">Account</label>
	<div class="col-sm-10">
		<select class="form-control" name="account_id" id="account_id">
			@foreach($accounts as $account)
				<option value="{{$account->id}}">{{$account->name}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="row mb-3">
	<label for="amount" class="col-sm-2 col-form-label">Amount</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="amount" id="amount" placeholder="Amount">
	</div>
</div>
<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
	</div>
</div>
<div class="row mb-3">
	<label for="transaction_against" class="col-sm-2 col-form-label">Transaction Against</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="transaction_against" id="transaction_against" placeholder="Transaction Against">
	</div>
</div>
<div class="row mb-3">
	<label for="debit" class="col-sm-2 col-form-label">Debit</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="debit" id="debit" placeholder="Debit">
	</div>
</div>
<div class="row mb-3">
	<label for="credit" class="col-sm-2 col-form-label">Credit</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="credit" id="credit" placeholder="Credit">
	</div>
</div>
<div class="row mb-3">
	<label for="user_id" class="col-sm-2 col-form-label">User</label>
	<div class="col-sm-10">
		<select class="form-control" name="user_id" id="user_id">
			@foreach($users as $user)
				<option value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
		</select>
	</div>
</div>

<button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
@section('script')


@endsection
