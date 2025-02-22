@extends('layout.backend.main')

@section('page_content')
<div class="container vh-100">

    <h1 class="text-center my-5">Asset Types!</h1>

    <form action="{{url("assetTypes/$data->id")}}" method="post">
        @csrf
        @method('PUT')

        <input class="w-50 m-auto form-control col-sm-4 my-1" type="text" name="name" placeholder="Asset type name" value="{{ $data->name }}">
        <input class="w-50 m-auto form-control my-1" type="text" name="description" placeholder="Asset type description" value="{{ $data->description }}">

        <button class="w-50 m-auto form-control bg-info text-white text-uppercase fw-bold" type="submit" name="submitAssetType">Update Asset Type</button>
    </form>

</div>

@endsection