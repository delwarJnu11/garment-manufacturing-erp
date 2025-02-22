@extends('layout.backend.main')
@section('page_content')

<<<<<<< HEAD
<x-page-header heading="Category" btnText="category" href="{{url('categoryType/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
=======
{{-- <x-page-header heading="CategoryTypes" btnText ="CategoryTypes" hrf="{{url('CategoryTypes/create')}}"/> --}}

<x-page-header heading="CategoryTypes" btnText="CategoryTypes" href="{{ url('CategoryTypes/create') }}" />
>>>>>>> 7abba29e73d223ef2c261f42d21e62cb4a6000f0
<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th> Category state</th>
            <th> Name</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($category_types as $category_type)
       <tr>
        <td>{{$category_type['id']}}</td>
<<<<<<< HEAD
    
          
            <td>{{ $category_type->category ? $category_type->category->name : 'No Category' }}</td>
       
         
=======
>>>>>>> 7abba29e73d223ef2c261f42d21e62cb4a6000f0
        <td>
          
            {{$category_type['name']}}</td>
         
           
    </tr>
       @empty
           
       @endforelse
       
    </tbody>
</table>
    
@endsection
