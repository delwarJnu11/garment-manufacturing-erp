
@extends('layout.backend.main')
@section('title','Manage AccountGroup')
@section('css')


@endsection
@section('page_content')
<a class="btn btn-primary" href="{{route('accountGroups.create')}}">New AccountGroup</a>
<table class="table table-hover text-nowrap">
	<thead>
		<tr>
			<!-- <th>Id</th> -->
			<th>Code</th>
			<th>Name</th>
			<th>Description</th>
			<th>Parent Id</th>
			<th>Is Active</th>
			<th>System Generated</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach($accountgroups as $accountgroup)
		<tr>
			<!-- <td>{{$accountgroup->id}}</td> -->
			<td>{{$accountgroup->code}}</td>
			<td>{{$accountgroup->name}}</td>
			<td>{{$accountgroup->description}}</td>
			<td>{{$accountgroup->parent_id}}</td>
			<td>{{$accountgroup->is_active}}</td>
			<td>{{$accountgroup->system_generated}}</td>

			<td>
			<form action = "{{route('accountGroups.destroy',$accountgroup->id)}}" method = "post">
				<a class= 'btn btn-primary' href = "{{route('accountGroups.show',$accountgroup->id)}}">View</a>
				<a class= 'btn btn-success' href = "{{route('accountGroups.edit',$accountgroup->id)}}"> Edit </a>
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
