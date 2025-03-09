@extends('layout.backend.main')
@section('page_content')

<x-page-header heading="Category" btnText="category" href="{{url('stock/categoryType/create')}}"/>
{{-- <x-page-header heading="Category" btnText="category" href="{{ url('categoryType/create') }}" /> --}}
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
    
          
            <td>{{ $category_type->category ? $category_type->category->name : 'No Category' }}</td>
       
         
        <td>
          
            {{$category_type['name']}}</td>
         
           
    </tr>
       @empty
           
       @endforelse
       
    </tbody>
</table>
    <div class="d-flex justify-content-end">
        {{$category_types->links('vendor.pagination.bootstrap-5')}}
    </div>
@endsection

