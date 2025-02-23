@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_employee_positions.create') }}" heading="Employee Position" btnText=" Position" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Position Name</th>
                            <th>Department Name</th>
                            <th>Status</th>
                            <th>Salary</th>
                            <th>Description</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $position)
                            <tr>
                                <td>{{ $position->id }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->department_id }}</td>
                                <td>{{ $position->statuses_id }}</td>
                                <td>{{ $position->salary }}</td>
                                <td>{{ $position->description }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{url("hrm_employee_positions/{$position->id}")}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="me-2 p-2" href="{{url("hrm_employee_positions/$position->id/edit")}}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{url("hrm_employee_positions/delete/$position->id")}}">
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
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5">
                {!! $positions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
