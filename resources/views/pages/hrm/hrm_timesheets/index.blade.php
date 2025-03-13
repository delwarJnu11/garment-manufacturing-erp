@extends('layout.backend.main');

@section('page_content')
<x-success/>
    {{-- <x-page-header href="{{ route('hrm_employee_timesheets.create') }}" heading="TimeSheets" btnText=" TimeSheets" /> --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Clock_in</th>
                            <th>Clock_out</th>
                            <th>Shift_start</th>
                            <th>Shift_end</th>
                            {{-- <th>Break_duration</th> --}}
                            <th>Total_working_hours</th>
                            <th>Total_work_done</th>
                            <th>Overtime_hours</th>
                            {{-- <th>Remarks</th> --}}
                            <th>Created At</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($timesheets as $timesheet)
                            <tr>
                                <td>{{ $timesheet->id }}</td>
                                <td>{{optional($timesheet->employee)->name}}</td>
                                <td>{{ $timesheet->date }}</td>
                                <td>{{optional($timesheet->statuses)->name}}</td>
                                <td>{{ $timesheet->clock_in }}</td>
                                <td>{{ $timesheet->clock_out }}</td>
                                <td>{{ $timesheet->shift_start }}</td>
                                <td>{{ $timesheet->shift_end }}</td>
                                {{-- <td>{{ $timesheet->break_duration }}</td> --}}
                                <td>{{ $timesheet->fixed_work_hours }}</td>
                                <td>{{ $timesheet->total_work_hours }}</td>
                                <td>{{ $timesheet->overtime_hours }}</td>
                                {{-- <td>{{ $timesheet->remarks }}</td> --}}
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{url("hrm_attendance_list/{$timesheet->id}")}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        @if (Auth::user()->isAdmin())
                                        <a class="me-2 p-2" href="{{url("hrm_attendance_list/$timesheet->id/edit")}}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{url("hrm_attendance_list/delete/$timesheet->id")}}">
                                            <i  data-feather="trash-2" class="feather-trash-2" onclick="return confirm('Are you sure you want to delete this Status? This action cannot be undone!');">
                                                Yes, Delete></i>
                                        </a>
                                        @endif

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
                        <td>Data Not Found</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5">
                {!! $timesheets->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
