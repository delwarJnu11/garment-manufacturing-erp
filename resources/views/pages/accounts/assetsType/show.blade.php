@extends('layout.backend.main')

@section('page_content')
<div class="container vh-100">
    <h1 class="bg-light text-center p-5">Assets Type Details</h1>
    <span class="float-end">
        <form action="/assetTypes/create" method="get">@csrf
            <button class="btn btn-info">Add Asset Type</button>
        </form>
    </span>
    <div class="text-center m-5">
        <h1>{{ $types['name'] }}</h1>
        <p>{{ $types['description'] }}</p>
    </div>
</div>
@endsection