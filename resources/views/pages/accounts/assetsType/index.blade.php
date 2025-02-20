@extends('layout.backend.main')

@section('page_content')
<div class="container">
    <h1 class="bg-light text-center p-5">Assets Type</h1>
    <span class="float-end">
        <form action="assetTypes/create" method="get">@csrf
            <button class="btn btn-info">Add Asset Type</button>
        </form>
    </span>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="w-50">Description</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->name}}</td>
                <td class="w-50">{!! Str::limit($type->description, 80, ' ...') !!}</td>
                <td style="width: 215px; display: flex; gap:5" class="text-center">
                    <form action="assetTypes/{{ $type->id }}/edit" method="get">
                        <button class="btn btn-info">Edit</button>
                    </form>
                    <form action="{{ url("assetTypes/$type->id") }}">
                        <button class="btn btn-success" href="">Show</button>
                    </form>

                    <form action="{{ url("assetTypes/$type->id") }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Del</button>
                    </form>

                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>
@endsection