@extends('layout.backend.main')
@section('title','Show Account')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('accounts.index')}}">Manage</a>
<table class='table table-striped text-nowrap'>
<tbody>
		<tr><th>Id</th><td>{{$account->id}}</td></tr>
		<tr><th>Code</th><td>{{$account->code}}</td></tr>
		<tr><th>Name</th><td>{{$account->name}}</td></tr>
		<tr><th>Account Group Id</th><td>{{$account->account_group_id}}</td></tr>
		<tr><th>Is Payment Method</th><td>{{$account->is_payment_method}}</td></tr>
		<tr><th>Is Trx No Required</th><td>{{$account->is_trx_no_required}}</td></tr>
		<tr><th>Description</th><td>{{$account->description}}</td></tr>
		<tr><th>Is Active</th><td>{{$account->is_active}}</td></tr>
		<tr><th>Created At</th><td>{{$account->created_at}}</td></tr>
		<tr><th>Created By</th><td>{{$account->created_by}}</td></tr>
		<tr><th>Updated At</th><td>{{$account->updated_at}}</td></tr>
		<tr><th>Updated By</th><td>{{$account->updated_by}}</td></tr>

</tbody>
</table>
@endsection
@section('script')


@endsection
