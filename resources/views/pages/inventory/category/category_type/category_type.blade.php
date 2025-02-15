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
       @forelse ($category_types as $categgory_type)
       <tr>
        <td>{{$categgory_type['id']}}</td>
        <td>
          
            {{$categgory_type['name']}}</td>
         
           
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
