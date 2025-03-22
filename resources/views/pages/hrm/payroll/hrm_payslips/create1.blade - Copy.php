@extends('layout.backend.main')
@section('css')
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .card {
            background: white;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card-two {
            background: white;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        h5 {
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .input-group select,
        .input-group input,
        .input-group button {
            padding: 8px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group select {
            width: 70%;
        }

        .input-group input {
            width: 30%;
        }

        .other input {
            width: 50%;
        }

        .input-group button {
            width: 40px;
            cursor: pointer;
        }

        .btn-primary {
            background: blue;
            color: white;
            border: none;
        }

        .btn-danger {
            background: red;
            color: white;
            border: none;
        }

        /* .summary-box input,
        .summary-box select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            background: #f1f1f1;
            border-radius: 5px;
            margin-bottom: 10px;
        } */
        .row {
            display: flex;
            gap: 5px;
        }

        .col {
            flex: 1;
        }

        .summary-form {
            width: 60%;
            margin-left: 170px;
        }

        .summary-input {
            margin-left: 100px;
            gap: 100px;
            line-height: -20px;
        }

        .input-field {
            padding: 5px;
            width: 55%;
        }

        .select-form {
            padding: 8px;
            width: 55%;
        }

        label {
            margin-right: 50px;
        }

        .label-one {
            margin-right: 87px;
        }

        .label-two {
            margin-right: 20px;
        }

        .label-three {
            margin-right: 28px;
        }

        .label-four {
            margin-right: 60px;
        }

        .label-five {
            margin-right: 18px;
        }

        .label-six {
            margin-right: 85px;
        }

        button {
            margin-left: 150px;
            padding: 5px;
            background-color: green;
            color: white;
            cursor: pointer;
        }
        h3{
            text-align: center;
            margin-right: 200px;
            color: white;
        }
        .salary-slip{
            padding: 20px;
            display: flex;
            margin-bottom: 10px;

        }

        .month-date{
            font-size: 15px;
        }

        .salary-input{
            width: 40%;
            padding: 5px;
        }

        .salaryinput-one{
            margin-left: 10px;
        }
        .salaryinput-two{
            margin-left: -30px;
        }
        .salaryinput-three{
            margin-left: -20px;
        }
        .salaryinput-four{
            margin-left: -35px;
        }

    </style> --}}

@endsection
@section('page_content')
    <x-success />
    <div class="container">
                    <div class="bg-success salary-slip">
                        <h3>Employee Salary Slip</h3>
                        <div class="month-date">
                            <label for="">Month :</label>
                            <input type="text">
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-5 card">
                            <select class="select-form w-100 mb-3 employee_id" name="employee_id" id="employee_id">
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="">No employee Found</option>
                                @endforelse
                            </select>
                            <p><strong >Employee Name : <span class="employee_name"></span></strong></p>
                            <p><strong >Employee ID : <span class="employeeID"></span></strong></p>
                        </div>
                        <div class="col-md-5 card">
                            <select class="select-form w-100 mb-3 employee_id" name="employee_id" id="employee_id">
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="">No employee Found</option>
                                @endforelse
                            </select>
                            <p><strong >Employee Name : <span class="employee_name"></span></strong></p>
                            <p><strong >Employee ID : <span class="employeeID"></span></strong></p>
                        </div>
                        <div class="col-md-5 card">
                            <select class="select-form w-100 mb-3 employee_id" name="employee_id" id="employee_id">
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="">No employee Found</option>
                                @endforelse
                            </select>
                            <p><strong >Employee Name : <span class="employee_name"></span></strong></p>
                            <p><strong >Employee ID : <span class="employeeID"></span></strong></p>
                        </div>
                        <div class="col-md-5 card">
                            <select class="select-form w-100 mb-3 employee_id" name="employee_id" id="employee_id">
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @empty
                                    <option value="">No employee Found</option>
                                @endforelse
                            </select>
                            <p><strong >Employee Name : <span class="employee_name"></span></strong></p>
                            <p><strong >Employee ID : <span class="employeeID"></span></strong></p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="card">
                                <p><strong >Employee Name : <span class="employee_name"></span></strong></p>
                                <p><strong >Employee ID : <span class="employeeID"></span></strong></p>
                                <p><strong >Employee Designation : <span class="employee_designation"></span></strong></p>
                                <p><strong >Employee Department : <span class="employee_department"></span></strong></p>
                                <p><strong >Employee Bank Account : <span class="employee_bank_account"></span></strong></p>
                                <p><strong >Employee Bank Name : <span class="employee_bank_name"></span></strong></p>
                            </div>
                        </div>

                        <!-- Deductions Section -->
                        <div class="col">
                            <div class="card-two">
                                <label for=""><strong>Total Working Days :</strong></label>
                                <input class="salary-input salaryinput-one" type="number"> <br> <br>
                                <label for=""><strong>Working Days Attendance :</strong></label>
                                <input class="salary-input salaryinput-two" type="number"> <br> <br>
                                <label for=""><strong>Employee Leaves Taken :</strong></label>
                                <input class="salary-input salaryinput-three" type="number"> <br> <br>
                                <label for=""><strong>Employee Balance Leaves :</strong></label>
                                <input class="salary-input salaryinput-four" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="card">
                                <h5 class="bg-success p-2">Allowances</h5>
                                <div class="input-group">
                                    <select>
                                        <option>Home Allowances</option>
                                        <option>Test Allowance</option>
                                    </select>
                                    <input type="number" value="10000">
                                    <button class="btn-primary">+</button>
                                </div>

                                <hr>
                                <h6 class="bg-info p-1 mb-1">Other Allowances</h6>
                                <div class="input-group other">
                                    <input type="text" placeholder="Title">
                                    <input type="number" placeholder="Amount">
                                </div>
                            </div>
                        </div>


                        <div class="col">
                            <div class="card">
                                <h5 class="bg-success p-2">Deductions</h5>
                                <div class="input-group ">
                                    <select>
                                        <option>PF</option>
                                    </select>
                                    <input type="number" value="5000">
                                    <button class="btn-primary">+</button>
                                </div>
                                <hr>
                                <h6 class="bg-info p-1 mb-1">Other Deductions</h6>
                                <div class="input-group other">
                                    <input type="text" placeholder="Title">
                                    <input type="number" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="card summary-box summary-form">
                        <h5 class="bg-success p-2">Summary</h5>
                        <div class="summary-input">

                            <label class="label-one">Basic</label>
                            <input class="input-field" type="number" value="12000"> <br> <br>

                            <label class="label-two">Total Allowances</label>
                            <input class="input-field" type="number" value="15000"> <br> <br>

                            <label class="label-three">Total Deduction</label>
                            <input class="input-field" type="number" value="5000"> <br> <br>

                            <label class="label-four">Net Salary</label>
                            <input class="input-field" type="number" value="22000"> <br> <br>

                            <label class="label-five">Payment Method</label>
                            <select class="select-form">
                                <option>Select</option>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                            </select> <br> <br>

                            <label class="label-six">Status</label>
                            <input class="input-field" type="text" value="Paid" readonly> <br> <br>

                            <button class="btn btn-success">Create Payslip</button>
                        </div>
                    </div>
                </div>


@endsection

@section('script')
<script>
     $(function() {

        //alert();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#employee_id').on('change', function() {
       //alert();
    let employee_id = $(this).val();
    //console.log(employee_id)

    $.ajax({
        url: "{{ url('find_employee') }}",
        type: 'get',
        data: {
            id: employee_id
        },
        success: function(res) {
            // let data=JSON.parse(res);
            console.log(res.employees);
            $(".employee_name").text(res.employees?.name);
            $(".employeeID").text(res.employees?.employee_id);
            $(".employee_designation").text(res.employees?.designations_id);
            $(".employee_department").text(res.employees?.department_id);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

 });


 })
</script>

@endsection


