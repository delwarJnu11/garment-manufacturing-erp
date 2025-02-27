@extends('layout.backend.main')
@section('page_content')

<table class="table table-striped table-bordered">
    <thead class="thead-info">
        <tr>
            <th>#</th>
            <th> Name</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($statuses as $status)
       <tr>
        <td>{{$status['id']}}</td>
        <td>
            @if ($status['id'] == 1)
            <span class="badge badge-success">{{$status['name']}}</span></td>
            @else
            <span class="badge badge-danger">{{$status['name']}}</span></td>
            @endif
           
        {{-- <td>
            <a href="{{ url('/products/view/1') }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ url('/products/edit/1') }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ url('/products/delete/1') }}" class="btn btn-danger btn-sm">Delete</a>
        </td> --}}
    </tr>
       @empty
           
       @endforelse
       
    </tbody>
</table>
    
@endsection
