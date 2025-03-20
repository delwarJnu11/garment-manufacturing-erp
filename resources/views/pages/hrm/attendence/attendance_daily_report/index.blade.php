@extends('layout.backend.main')

@section('page_content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <h1 class="mb-5 text-center">Attendance Daily Report for {{ $date }}</h1>

                <!-- Form to filter by employee, department, and date -->
                <form method="get" action="{{ route('attendance.dailyReport') }}" class="row g-3">
                    <!-- Select Date -->
                    <div class="col-md-4">
                        <label for="date" class="form-label">Select Date:</label>
                        <input type="date" name="date" value="{{ $date }}" class="form-control">
                    </div>

                    <!-- Select Employee -->
                    <div class="col-md-4">
                        <label for="employee_id" class="form-label">Select Employee:</label>
                        <select name="employee_id" class="form-select">
                            <option value="">All Employees</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $employee->id == request('employee_id') ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Department -->
                    <div class="col-md-4">
                        <label for="department_id" class="form-label">Select Department:</label>
                        <select name="department_id" class="form-select">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $department->id == request('department_id') ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>

                <!-- Attendance Report Table -->
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            {{-- <th>Department</th> --}}
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Late Days</th>
                            <th>Leave Days</th>
                            <th>Late Times</th>
                            <th>Leave Times</th>
                            <th>Status</th>
                            <th>Total Work Hours</th>
                            <th>Overtime Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->employee_name }}</td>
                                {{-- <td>{{ $attendance->employee->department->name ?? 'N/A' }}</td> <!-- Assuming the department is related --> --}}
                                <td>{{ $attendance->clock_in }}</td>
                                <td>{{ $attendance->clock_out }}</td>
                                <td>{{ $attendance->late_days }}</td>
                                <td>{{ $attendance->leave_days }}</td>
                                <td>{{ $attendance->late_times }}</td>
                                <td>{{ $attendance->leave_times }}</td>
                                <td>{{ $attendance->statuses_id }}</td>
                                <td>{{ $attendance->total_work_hours }}</td>
                                <td>{{ $attendance->overtime_hours }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
