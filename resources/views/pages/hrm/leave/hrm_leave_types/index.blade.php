@extends('layout.backend.main');

@section('page_content')
<x-success/>
@if (Auth::user()->isAdmin())
    <x-page-header href="{{ route('hrm_leave_types.create') }}" heading="Leave Type" btnText=" Leave Type" />
@endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Leave Type</th>
                            <th>Days</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->id }}</td>
                                <td>{{ $leave->name }}</td>
                                <td>{{ $leave->max_days }}</td>
                                <td>{{ $leave->description }}</td>
                                <td>{{ $leave->created_at }}</td>

                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{url("hrm_leave_types/{$leave->id}")}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        @if (Auth::user()->isAdmin())
                                        <a class="me-2 p-2" href="{{url("hrm_leave_types/$leave->id/edit")}}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{url("hrm_leave_types/delete/$leave->id")}}">
                                            <i  data-feather="trash-2" class="feather-trash-2" onclick="return confirm('Are you sure you want to delete this Status? This action cannot be undone!');">
                                                Yes, Delete></i>
                                        </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5">
                {!! $leaves->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

