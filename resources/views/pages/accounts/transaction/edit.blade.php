@extends('layout.backend.main')
@section('title','Edit Transaction')
@section('style')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('transactions.index')}}">Manage</a>
<form action="{{route('transactions.update',$transaction)}}" method ="post" enctype="multipart/form-data">
@csrf
@method("PUT")
<div class="row mb-3">
	<label for="voucher_ref" class="col-sm-2 col-form-label">Voucher Ref</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="voucher_ref" value="{{$transaction->voucher_ref}}" id="voucher_ref" placeholder="Voucher Ref">
	</div>
</div>
<div class="row mb-3">
	<label for="transaction_date" class="col-sm-2 col-form-label">Transaction Date</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="transaction_date" value="{{$transaction->transaction_date}}" id="transaction_date" placeholder="Transaction Date">
	</div>
</div>
<div class="row mb-3">
	<label for="account_id" class="col-sm-2 col-form-label">Account</label>
	<div class="col-sm-10">
		<select class="form-control" name="account_id" id="account_id">
			@foreach($accounts as $account)
				@if($account->id==$transaction->account_id)
					<option value="{{$account->id}}" selected>{{$account->name}}</option>
				@else
					<option value="{{$account->id}}">{{$account->name}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row mb-3">
	<label for="amount" class="col-sm-2 col-form-label">Amount</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="amount" value="{{$transaction->amount}}" id="amount" placeholder="Amount">
	</div>
</div>
<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="description" value="{{$transaction->description}}" id="description" placeholder="Description">
	</div>
</div>
<div class="row mb-3">
	<label for="transaction_against" class="col-sm-2 col-form-label">Transaction Against</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="transaction_against" value="{{$transaction->transaction_against}}" id="transaction_against" placeholder="Transaction Against">
	</div>
</div>
<div class="row mb-3">
	<label for="debit" class="col-sm-2 col-form-label">Debit</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="debit" value="{{$transaction->debit}}" id="debit" placeholder="Debit">
	</div>
</div>
<div class="row mb-3">
	<label for="credit" class="col-sm-2 col-form-label">Credit</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="credit" value="{{$transaction->credit}}" id="credit" placeholder="Credit">
	</div>
</div>
<div class="row mb-3">
	<label for="user_id" class="col-sm-2 col-form-label">User</label>
	<div class="col-sm-10">
		<select class="form-control" name="user_id" id="user_id">
			@foreach($users as $user)
				@if($user->id==$transaction->user_id)
					<option value="{{$user->id}}" selected>{{$user->name}}</option>
				@else
					<option value="{{$user->id}}">{{$user->name}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>

<button type="submit" class="btn btn-primary">Save Change</button>
</form>
@endsection
@section('script')


@endsection
