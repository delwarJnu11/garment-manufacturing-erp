
@extends('layout.backend.main')
@section('title','Edit AccountGroup')
@section('style')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('accountgroups.index')}}">Manage</a>
<form action="{{route('accountgroups.update',$accountgroup)}}" method ="post" enctype="multipart/form-data">
@csrf
@method("PUT")
<div class="row mb-3">
	<label for="code" class="col-sm-2 col-form-label">Code</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="code" value="{{$accountgroup->code}}" id="code" placeholder="Code">
	</div>
</div>
<div class="row mb-3">
	<label for="name" class="col-sm-2 col-form-label">Name</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="name" value="{{$accountgroup->name}}" id="name" placeholder="Name">
	</div>
</div>
<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="description" value="{{$accountgroup->description}}" id="description" placeholder="Description">
	</div>
</div>
<div class="row mb-3">
	<label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
	<div class="col-sm-10">
		<select class="form-control" name="parent_id" id="parent_id">
			@foreach($parents as $parent)
				@if($parent->id==$accountgroup->parent_id)
					<option value="{{$parent->id}}" selected>{{$parent->name}}</option>
				@else
					<option value="{{$parent->id}}">{{$parent->name}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row mb-3">
	<label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="is_active" value="{{$accountgroup->is_active}}" id="is_active" placeholder="Is Active">
	</div>
</div>
<div class="row mb-3">
	<label for="system_generated" class="col-sm-2 col-form-label">System Generated</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="system_generated" value="{{$accountgroup->system_generated}}" id="system_generated" placeholder="System Generated">
	</div>
</div>

<button type="submit" class="btn btn-primary">Save Change</button>
</form>
@endsection
@section('script')


@endsection
