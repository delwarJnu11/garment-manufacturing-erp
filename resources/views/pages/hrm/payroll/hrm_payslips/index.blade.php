
@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_payslips.create') }}" heading="Employee" btnText=" Employee" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>EmployeeID</th>
                            <th>Employee Name</th>
                            <th>Salary Month</th>
                            <th>Total Salary</th>
                            <th>Status</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payslips as $payslip)
                            <tr>
                                <td>{{ $payslip->id }}</td>
                                <td><a class="btn btn-outline-success" href="{{url('hrm_employees/' . $payslip->id)}}">{{ optional($payslip->employee)->employee_id_number }}</a></td>
                                <td>{{ optional($payslip->employee)->name }}</td>
                                <td>{{ $payslip->salary_month }}</td>
                                <td>{{ $payslip->net_salary }}</td>
                                <td>{{ $payslip->statuses_id }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 mb-0" href="{{url("hrm_payslips/{$payslip->id}")}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye action-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <a class="confirm-textt p-2" href="{{url("hrm_employees/delete/$payslip->id")}}">
                                            <i  data-feather="trash-2" class="feather-trash-2" onclick="return confirm('Are you sure you want to delete this Position? This action cannot be undone!');">
                                                Yes, Delete></i>
                                        </a>
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
                {!! $payslips->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
