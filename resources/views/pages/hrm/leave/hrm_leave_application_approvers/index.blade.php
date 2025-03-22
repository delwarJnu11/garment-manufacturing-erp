
@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_employee_performances.create') }}" heading="Employee" btnText=" Employee" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">

                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Employee Name</th>
                            <th>Department Name</th>
                            <th>Designation Name</th>
                            <th>Status</th>
                            <th>Branch</th>
                            <th>Subject</th>
                            <th>Goals</th>
                            <th>Target Achievement</th>
                            <th>Target Rating</th>
                            <th>Overall Rating</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Feedback</th>
                            <th>Appraisal Date</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($performances as $performance)
                            <tr>
                                <td>{{ $performance->id }}</td>
                                <td>{{ optional( $performance->employees)->name }}</td>
                                <td>{{ optional( $performance->department)->name }}</td>
                                <td>{{ optional( $performance->designations)->name}}</td>
                                <td>{{ optional( $performance->statuses)->name}}</td>
                                <td>{{ $performance->branch}}</td>
                                <td>{{ $performance->subject}}</td>
                                <td>{{ $performance->goals}}</td>
                                <td>{{ $performance->target_achievement }}</td>
                                <td>{{ $performance->target_rating }}</td>
                                <td>{{ $performance->overall_rating }}</td>
                                <td>{{ $performance->start_date }}</td>
                                <td>{{ $performance->end_date }}</td>
                                <td>{{ $performance->feedback}}</td>
                                <td>{{ $performance->appraisal_date }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{ url("hrm_employee_performances/{$performance->id}") }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="me-2 p-2" href="{{ url("hrm_employee_performances/{$performance->id}/edit") }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{ url("hrm_employee_performances/delete/{$performance->id}") }}">
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
                {!! $performances->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
