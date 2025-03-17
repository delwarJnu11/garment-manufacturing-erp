@extends('layout.backend.main')
@section('title','Manage Transaction')
@section('css')


@endsection
@section('page_content')
<a href="{{route('transactions.create')}}">New Transaction</a>
<table class="table table-hover text-nowrap">
	<thead>
		<tr>
			<th>Id</th>
			<th>Voucher Ref</th>
			<th>Transaction Date</th>
			<th>Account Id</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Transaction Against</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>User Id</th>
			<th>Created At</th>
			<th>Updated At</th>

			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach($transactions as $transaction)
		<tr>
			<td>{{$transaction->id}}</td>
			<td>{{$transaction->voucher_ref}}</td>
			<td>{{$transaction->transaction_date}}</td>
			<td>{{$transaction->account_id}}</td>
			<td>{{$transaction->amount}}</td>
			<td>{{$transaction->description}}</td>
			<td>{{$transaction->transaction_against}}</td>
			<td>{{$transaction->debit}}</td>
			<td>{{$transaction->credit}}</td>
			<td>{{$transaction->user_id}}</td>
			<td>{{$transaction->created_at}}</td>
			<td>{{$transaction->updated_at}}</td>

			<td>
			<form action = "{{route('transactions.destroy',$transaction->id)}}" method = "post">
				<a class= 'btn btn-primary' href = "{{route('transactions.show',$transaction->id)}}">View</a>
				<a class= 'btn btn-success' href = "{{route('transactions.edit',$transaction->id)}}"> Edit </a>
				@method('DELETE')
				@csrf
				<input type = "submit" class="btn btn-danger" name = "delete" value = "Delete" />
			</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection
@section('script')


@endsection
