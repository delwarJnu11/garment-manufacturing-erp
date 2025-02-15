@extends('layout.backend.main');
    <?php use Carbon\Carbon; ?>
@section('page_content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>User Role List</h4>
            <h6>Manage Your User Roles</h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Pdf" data-bs-original-title="Pdf"><img src="{{asset('assets')}}/img/icons/pdf.svg" alt="img"></a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Excel" data-bs-original-title="Excel"><img src="{{asset('assets')}}/img/icons/excel.svg" alt="img"></a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print" data-bs-original-title="Print"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer feather-rotate-ccw">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg></a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                </svg></a>
        </li>
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse" data-bs-original-title="Collapse" class=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                    <polyline points="18 15 12 9 6 15"></polyline>
                </svg></a>
        </li>
    </ul>
    <div class="page-btn">
        <a href="{{route('roles.create')}}" class="btn btn-added" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle me-2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>Add New Role</a>
    </div>
</div>
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
                            {{$role->id}}
                        </td>
                        <td>{{$role->name}}</td>
                        <td>{{Carbon::parse($role->created_at)->format('d M, Y')}}</td>
                        <td>{{Carbon::parse($role->created_at)->format('h.i A')}}</td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye action-eye">
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
                            No role found
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection