@extends('layout.backend.main');
<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-page-header href="{{ route('users.create') }}" heading="Users" btnText="User" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Role</th>
                            <th>Created At</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="userimgname">
                                        <a href="javascript:void(0);" class="userslist-img bg-img">
                                            <img width="60" height="60" style="border-radius: 50%"
                                                src="{{ asset('uploads') }}/users/{{ $user->image }}" alt="product">
                                        </a>
                                        <div>
                                            <a href="javascript:void(0);">{{ $user->name }}</a>
                                        </div>

                                    </div>
                                </td>
                                <td><a href="javascript:void(0);">{{ $user->email }}</a></td>
                                <td>01749497676</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ Carbon::parse($user->created_at)->format('d M, Y') }}</td>
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
                                        <a class="me-2 p-2" href="{{ route('users.edit', $user->id) }}">
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
        <!-- Pagination Links -->
        <div class="d-flex justify-content-end p-3">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
