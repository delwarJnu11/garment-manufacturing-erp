@extends('layout.backend.main');
@section('css')
<style>
    .small{
        margin-right: 10px;
    }
</style>
@endsection
<?php use Carbon\Carbon; ?>
@section('page_content')
    <x-page-header href="{{ route('roles.create') }}" heading="User Roles" btnText="Role" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Created Date</th>
                            <th>Created Time</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->id }}
                                </td>
                                <td>{{ $role->name }}</td>
                                <td>{{ Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                                <td>{{ Carbon::parse($role->created_at)->format('h.i A') }}</td>
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
                                        <a class="me-2 p-2" href="#">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-text p-2" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="4" class="text-danger">No role found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-end p-3">
            {{ $roles->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
