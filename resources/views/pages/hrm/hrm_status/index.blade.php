@extends('layout.backend.main');

@section('page_content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
    <x-page-header href="{{ route('hrm_status.create') }}" heading="Status" btnText="Add Status" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Status Name</th>
                            <th>Created At</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($status as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="me-2 p-2" href="{{url("hrm_status/$data->id/edit")}}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-text p-2" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
