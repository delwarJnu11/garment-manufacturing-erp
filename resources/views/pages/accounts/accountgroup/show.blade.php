
@extends('layout.backend.main')
@section('title','Show AccountGroup')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('accountGroups.index')}}">Manage</a>
<table class='table table-striped text-nowrap'>
<tbody>
		<tr><th>Id</th><td>{{$accountgroup->id}}</td></tr>
		<tr><th>Code</th><td>{{$accountgroup->code}}</td></tr>
		<tr><th>Name</th><td>{{$accountgroup->name}}</td></tr>
		<tr><th>Description</th><td>{{$accountgroup->description}}</td></tr>
		<tr><th>Parent Id</th><td>{{$accountgroup->parent_id}}</td></tr>
		<tr><th>Is Active</th><td>{{$accountgroup->is_active}}</td></tr>
		<tr><th>System Generated</th><td>{{$accountgroup->system_generated}}</td></tr>
		<tr><th>Created At</th><td>{{$accountgroup->created_at}}</td></tr>
		<tr><th>Updated At</th><td>{{$accountgroup->updated_at}}</td></tr>

</tbody>
</table>
@endsection
@section('script')


@endsection
