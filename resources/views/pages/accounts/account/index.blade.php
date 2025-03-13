@extends('layout.backend.main')
@section('title','Manage Account')
@section('css')


@endsection
@section('page_content')
<a href="{{route('accounts.create')}}">New Account</a>
<table class="table table-hover text-nowrap">
	<thead>
		<tr>
			<th>Id</th>
			<th>Code</th>
			<th>Name</th>
			<th>Account Group Id</th>
			<th>Is Payment Method</th>
			<th>Is Trx No Required</th>
			<th>Description</th>
			<th>Is Active</th>
			<th>Created At</th>
			<th>Created By</th>
			<th>Updated At</th>
			<th>Updated By</th>

			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach($accounts as $account)
		<tr>
			<td>{{$account->id}}</td>
			<td>{{$account->code}}</td>
			<td>{{$account->name}}</td>
			<td>{{$account->account_group_id}}</td>
			<td>{{$account->is_payment_method}}</td>
			<td>{{$account->is_trx_no_required}}</td>
			<td>{{$account->description}}</td>
			<td>{{$account->is_active}}</td>
			<td>{{$account->created_at}}</td>
			<td>{{$account->created_by}}</td>
			<td>{{$account->updated_at}}</td>
			<td>{{$account->updated_by}}</td>

			<td>
			<form action = "{{route('accounts.destroy',$account->id)}}" method = "post">
				<a class= 'btn btn-primary' href = "{{route('accounts.show',$account->id)}}">View</a>
				<a class= 'btn btn-success' href = "{{route('accounts.edit',$account->id)}}"> Edit </a>
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
