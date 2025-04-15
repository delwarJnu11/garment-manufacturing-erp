
@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_employees.create') }}" heading="Employee" btnText=" Employee" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>EmployeeID</th>
                            <th>Employee Name</th>
                            <th>Email Number</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Department Name</th>
                            <th>Designations Name</th>
                            <th>Statuses</th>
                            <th>Joining Date</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td><a class="btn btn-outline-success" href="{{url('hrm_employees/' . $employee->id)}}">{{ $employee->employee_id_number}}</a></td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->department_id }}</td>
                                <td>{{ $employee->designations_id }}</td>
                                <td>{{ $employee->statuses_id }}</td>
                                <td>{{ $employee->joining_date }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        {{-- <a class="me-2 p-2 mb-0" href="{{url("hrm_employees/{$employee->id}")}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a> --}}
                                        <a class="me-2 p-2" href="{{url("hrm_employees/$employee->id/edit")}}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{url("hrm_employees/delete/$employee->id")}}">
                                            <i  data-feather="trash-2" class="feather-trash-2" onclick="return confirm('Are you sure you want to delete this Position? This action cannot be undone!');">
                                                Yes, Delete></i>
                                        </a>
                                        {{-- <form action="{{url("hrm_status/{$data['id']}")}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn-danger px-4"
                                                    onclick="return confirm('Are you sure you want to delete this customer? This action cannot be undone!');">
                                                    Yes, Delete
                                                </button>
                                                <a class="confirm-text p-2" href="">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <td>Do not data found</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5">
                {!! $employees->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
