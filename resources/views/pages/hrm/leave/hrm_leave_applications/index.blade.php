
@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_leave_applications.create') }}" heading="Application" btnText=" Application" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">

                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Employee Name</th>
                            <th>Type Name</th>
                            <th>Apply Date</th>
                            <th>Leave Start Date</th>
                            <th>Leave End Date</th>
                            <th>Total Days</th>
                            <th>Duration</th>
                            <th>Leave Status</th>
                            <th>Leave Reason</th>
                            <th>Application Form</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->employees_id}}</td>
                                <td>{{ $application->leave_type_id}}</td>
                                <td>{{ $application->date}}</td>
                                <td>{{ $application->start_date }}</td>
                                <td>{{ $application->end_date }}</td>
                                <td>{{ $application->number_of_days }}</td>
                                <td>{{ $application->duration }}</td>
                                <td class="btn text-center mt-0 btn-sm btn-{{"warning"}} disabled">{{ $application->statuses_id == 2 ? "Pending": '' }}</td>
                                <td>{{ $application->reason}}</td>
                                <td>{{ $application->photo}}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{ url("hrm_leave_applications/{$application->id}") }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="me-2 p-2" href="{{ url("hrm_leave_applications/{$application->id}/edit") }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{ url("hrm_leave_applications/delete/{$application->id}") }}">
                                            <i data-feather="trash-2" class="feather-trash-2"
                                               onclick="return confirm('Are you sure you want to delete this position? This action cannot be undone!');">
                                                Yes, Delete
                                            </i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="text-center">No positions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5">
                {!! $applications->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
