@extends('layout.backend.main')
@section('page_content')

{{-- <x-page-header heading="CategoryTypes" btnText ="CategoryTypes" hrf="{{url('CategoryTypes/create')}}"/> --}}

<x-page-header heading="CategoryTypes" btnText="CategoryTypes" href="{{ url('CategoryTypes/create') }}" />
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th> Name</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($category_types as $category_type)
       <tr>
        <td>{{$category_type['id']}}</td>
        <td>
          
            {{$category_type['name']}}</td>
         
           
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
