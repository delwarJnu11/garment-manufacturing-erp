@extends('layout.backend.main')
@section('css')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .salary-slip-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #28a745;
            color: #fff;
            padding: 16px;
            font-size: 20px;
            text-align: center;
        }

        .input-group input,
        .input-group select {
            border-radius: 6px;
            border: 1px solid #ced4da;
            font-size: 15px;
            font-weight: 600;
        }

        .summary-box {
            width: 70%;
            margin-left: 150px;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border-radius: 6px;
        }

        .btn-success {
            background-color: #28a745;
            border-radius: 6px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('page_content')
    <x-success />
    <div class="container salary-slip-container">
        <div class="card w-100" style="max-width: 900px;">
            <div class="card-header bg-success">
                Employee Salary Slip
            </div>
            <div class="card-body">

                <!-- Employee Details Section -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="employee_id">Select Employee:</label>
                        <select class="form-select employee_id" name="employee_id" id="employee_id">
                            @forelse ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @empty
                                <option value="">No employee Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Month:</label>
                        <input type="month" class="form-control">
                    </div>
                </div>

                <!-- Employee Info -->
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Employee Name :</strong> <span class="employee_name"></span></p>
                        <p><strong>Employee ID :</strong> <span class="employeeID"></span></p>
                        <p><strong>Employee Designation :</strong> <span class="employee_designation"></span></p>
                        <p><strong>Employee Department :</strong> <span class="employee_department"></span></p>
                        <p><strong>Employee Bank Account :</strong> <span class="employee_bank_account"></span></p>
                        <p><strong>Employee Bank Name :</strong> <span class="employee_bank_name"></span></p>
                    </div>

                    <!-- Attendance Info -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Working Days:</label>
                            <input type="number" class="form-control" value="30">
                        </div>
                        <div class="form-group">
                            <label>Working Days Attendance:</label>
                            <input type="number" class="form-control" value="28">
                        </div>
                        <div class="form-group">
                            <label>Leaves Taken:</label>
                            <input type="number" class="form-control" value="2">
                        </div>
                        <div class="form-group">
                            <label>Balance Leaves:</label>
                            <input type="number" class="form-control" value="5">
                        </div>
                    </div>
                </div>

                <!-- Allowances and Deductions -->
                <div class="row">
                    <!-- Allowances -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-success text-white">Allowances</div>
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <select class="form-select payslip_items_id" id="allowance_items" name="payslip_items_id"
                                        id="payslip_items_id">
                                        @forelse ($payslip_items as $payslip_item)
                                            @if ($payslip_item->factor == 1)
                                                <option value="{{ $payslip_item->id }}">{{ $payslip_item->name }}</option>
                                            @endif

                                        @empty
                                            <option value="">No Payslip_Items Found</option>
                                        @endforelse
                                    </select>

                                    <input class="allowance_amount" type="number" class="form-control" value="10000">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary add_btn" id="add_btn">+</button>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-center bg-info p-2 mb-2">Other Allowance</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Other Allowance">
                                    <input type="number" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deductions -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-danger text-white">Deductions</div>
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <select class="form-select payslip_items_id" id="deduction_items" name="payslip_items_id"
                                        id="payslip_items_id">
                                        @forelse ($payslip_items as $payslip_item)
                                            @if ($payslip_item->factor == -1)
                                                <option value="{{ $payslip_item->id }}">{{ $payslip_item->name }}</option>
                                            @endif

                                        @empty
                                            <option value="">No Payslip_Items Found</option>
                                        @endforelse
                                    </select>
                                    <input type="number" class="form-control" value="5000">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">+</button>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-center bg-info p-2 mb-2">Other Deductions</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Other Deduction">
                                    <input type="number" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="summary-box mt-3 card">
                    <h5>Summary</h5>
                    <div class="form-group">
                        <label>Basic Salary</label>
                        <input type="number" class="form-control" value="12000">
                    </div>
                    <div class="form-group">
                        <label>Total Allowances</label>
                        <input type="number" class="form-control" value="15000">
                    </div>
                    <div class="form-group">
                        <label>Total Deductions</label>
                        <input type="number" class="form-control" value="5000">
                    </div>
                    <div class="form-group">
                        <label>Net Salary</label>
                        <input type="number" class="form-control" value="22000">
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option>Bank Transfer</option>
                            <option>Cash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" value="Paid" readonly>
                    </div>
                    <button class="btn btn-success w-100">Create Payslip</button>
                </div>
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
                        $(".employee_bank_account").text(res.employees?.bank_accounts_id);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });


            $('.add_btn').on('click', function() {


                let payslip_items_allowance_id = $("#allowance_items").val();
                let payslip_items_allowance_name = $("#allowance_items option:selected").text();

                let allowance_amount = $(".allowance_amount").val();

                let subtotal + = allowance_amount;
                let total_allowance = subtotal;

                let item = {
                    "name": payslip_items_allowance_name,
                    "item_id": payslip_items_allowance_id,
                    "allowance_amount": allowance_amount,
                    "total_allowance": total_allowance,
                    "subtotal": subtotal
                };

            });

            function printCart() {
                let cartdata = cart.getCart();
                if (cartdata) {


                    let htmldata = "";
                    let subtotal = 0;
                    let total_allowance = 0;

                    cartdata.forEach((element, index) => {
                        subtotal += element.subtotal

                        htmldata += `

				`;
                    });

                    $('.dataAppend').html(htmldata);


                    $('.subtotal').html(subtotal);
                    $('.vat').html(subtotal * 5 / 100);
                    $('.Discount').html(dicount);
                    $('.grandtotal').html(subtotal + (subtotal * 5 / 100));
                    cartIconIncrease()
                }

            }










        })
    </script>
@endsection

<div>
    <span></span>
    <span></span>
    <button></button>
</div>
