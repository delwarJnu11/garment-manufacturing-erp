
@extends('layout.backend.main');

@section('page_content')
<x-success/>
    <x-page-header href="{{ route('hrm_payslips.create') }}" heading="Employee" btnText=" Salary Create" />
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
                                         <a href="{{url("hrm_payslips/{$payslip->id}")}}" class="btn btn-warning btn-lg  p-2 text-black" title="Payslip"><i class="fa fa-eye"></i> Payslip</a>
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
