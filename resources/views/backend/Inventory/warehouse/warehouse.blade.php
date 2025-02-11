@extends('layout.backend.main')
@section('page_content')
    


{{-- <body class="bg-gray-100 p-6"> --}}
    <div class="container mx-auto bg-gray-100 p-6">
      <h2 class="text-2xl font-bold mb-6 text-center">Warehouse List</h2>
      <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
          <thead>
            <tr class="bg-gray-200">
              <th class="px-4 py-2 border">ID</th>
              <th class="px-4 py-2 border">Warehouse Name</th>
              <th class="px-4 py-2 border">Location</th>
              <th class="px-4 py-2 border">Contact Person</th>
              <th class="px-4 py-2 border">Contact Number</th>
              <th class="px-4 py-2 border">Created At</th>
              <th class="px-4 py-2 border">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border text-center">1</td>
              <td class="px-4 py-2 border">Main Warehouse</td>
              <td class="px-4 py-2 border">Dhaka, Bangladesh</td>
              <td class="px-4 py-2 border">Farzana Akter</td>
              <td class="px-4 py-2 border">+880123456789</td>
              <td class="px-4 py-2 border text-center">2025-02-10</td>
              <td >
                <a href="" class="btn btn-primary">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
                <a href="" class="btn btn-danger">show</a>
                
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border text-center">2</td>
              <td class="px-4 py-2 border">Secondary Storage</td>
              <td class="px-4 py-2 border">Chittagong, Bangladesh</td>
              <td class="px-4 py-2 border">Md. Delwar Hossain</td>
              <td class="px-4 py-2 border">+880987654321</td>
              <td class="px-4 py-2 border text-center">2025-02-09</td>
              <td class="">
               <a href="" class="btn btn-primary">Edit</a>
               <a href="" class="btn btn-danger">Delete</a>
               
              </td>
            </tr>
            <!-- Additional warehouse rows can go here -->
          </tbody>
        </table>
      </div>
    </div>
  {{-- </body> --}}
  @endsection