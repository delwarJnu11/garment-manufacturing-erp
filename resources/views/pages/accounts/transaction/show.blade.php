@extends('layout.backend.main')
@section('title','Show Transaction')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('transactions.index')}}">Manage</a>
<table class='table table-striped text-nowrap'>
<tbody>
		<tr><th>Id</th><td>{{$transaction->id}}</td></tr>
		<tr><th>Voucher Ref</th><td>{{$transaction->voucher_ref}}</td></tr>
		<tr><th>Transaction Date</th><td>{{$transaction->transaction_date}}</td></tr>
		<tr><th>Account Id</th><td>{{$transaction->account_id}}</td></tr>
		<tr><th>Amount</th><td>{{$transaction->amount}}</td></tr>
		<tr><th>Description</th><td>{{$transaction->description}}</td></tr>
		<tr><th>Transaction Against</th><td>{{$transaction->transaction_against}}</td></tr>
		<tr><th>Debit</th><td>{{$transaction->debit}}</td></tr>
		<tr><th>Credit</th><td>{{$transaction->credit}}</td></tr>
		<tr><th>User Id</th><td>{{$transaction->user_id}}</td></tr>
		<tr><th>Created At</th><td>{{$transaction->created_at}}</td></tr>
		<tr><th>Updated At</th><td>{{$transaction->updated_at}}</td></tr>

</tbody>
</table>
@endsection
@section('script')


@endsection
