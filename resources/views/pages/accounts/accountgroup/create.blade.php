
@extends('layout.backend.main')
@section('title','Create AccountGroup')
@section('style')


@endsection
@section('page_content')
{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

<a class='btn btn-success' href="{{route('accountGroups.index')}}">Manage</a>

<form action="{{route('accountGroups.store')}}" method ="post" enctype="multipart/form-data">
@csrf
{{-- <div class="row mb-3">
	<label for="code" class="col-sm-2 col-form-label">Code</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="code" id="code" placeholder="Code">
	</div>
</div> --}}
<div class="row mb-3">
	<label for="name" class="col-sm-2 col-form-label">Name</label>
	<div class="col-sm-10">
		<input type = "text" class="form-control" name="name" id="name" placeholder="Name">
	</div>
</div>
<div class="row mb-3">
	<label for="description" class="col-sm-2 col-form-label">Description</label>
	<div class="col-sm-10">
		<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
	</div>
</div>
<div class="row mb-3">
	<label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
	<div class="col-sm-10">
		<select class="form-control" name="parent_id" id="parent_id">
		<option value="">Select Parent Account</option>
			@foreach($parents as $parent)
			<option value="{{ $parent->id }}" {{ session('parent_id') == $parent->id ? 'selected' : '' }}>
				{{ $parent->name }}
			</option>
			@endforeach
		</select>
	</div>
</div>
<div class="row mb-3">
	<label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
	<div class="col-sm-10">
		<input value="1" type = "text" class="form-control" name="is_active" id="is_active" placeholder="Is Active">
	</div>
</div>
<div class="row mb-3">
	<label for="system_generated" class="col-sm-2 col-form-label">System Generated</label>
	<div class="col-sm-10">
		<input value="1" type = "text" class="form-control" name="system_generated" id="system_generated" placeholder="System Generated">
	</div>
</div>

<button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
@section('script')


@endsection
