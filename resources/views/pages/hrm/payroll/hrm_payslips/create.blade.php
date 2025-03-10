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
            font-size: 25px;
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
            width: 60%;
            margin-left: 180px;
            /* background-color: #f1f1f1; */
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); */
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

        .summary-box h5 {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-row label {
            width: 30%;
            /* Adjust width based on design preference */
            font-weight: 500;
            margin-right: 10px;
        }

        .form-row .form-control,
        .form-row .form-select {
            width: 100%;
        }
    </style>
@endsection
@section('page_content')
    <x-success />
    <div class="container salary-slip-container">
        <div class="card w-100" style="max-width: 900px;">
            <div class="card-header bg-info">
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Allowance Item</th>
                                            <th>Amount</th>
                                            <th><button class="btn bg-danger clearAll">ClearAll</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-select payslip_items_id" id="allowance_items"
                                                    name="payslip_items_id">
                                                    @forelse ($payslip_items as $payslip_item)
                                                        @if ($payslip_item->factor == 1)
                                                            <option value="{{ $payslip_item->id }}">
                                                                {{ $payslip_item->name }}</option>
                                                        @endif
                                                    @empty
                                                        <option value="">No Payslip_Items Found</option>
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <input class="allowance_amount form-control" type="number" value="10000">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary alowance_add_btn" id="alowance_add_btn">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="dataAppend"> </tfoot>
                                </table>
                                <hr>
                                <h4 class="text-center bg-info p-2 mb-2">Other Allowance</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Other Allowance</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Other Allowance">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="Amount">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Deductions -->
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-danger text-white">Deductions</div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Deduction Items</th>
                                            <th>Amount</th>
                                            <th><button class="btn bg-danger Clear">ClearAll</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-select payslip_items_id" id="deduction_items"
                                                    name="payslip_items_id">
                                                    @forelse ($payslip_items as $payslip_item)
                                                        @if ($payslip_item->factor == -1)
                                                            <option value="{{ $payslip_item->id }}">
                                                                {{ $payslip_item->name }}</option>
                                                        @endif
                                                    @empty
                                                        <option value="">No Payslip_Items Found</option>
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <input class=" form-control deduction_amount" type="number" value="10000">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary deduction_add_btn" id="deduction_add_btn">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="dataAppended"> </tfoot>
                                </table>
                                <hr>
                                <h4 class="text-center bg-info p-2 mb-2">Other Deduction</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Other Deduction</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Other Allowance">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="Amount">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->

                <div class="summary-box mt-3 card p-3">
                    <h5 class="card-header bg-warning text-white">Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Basic Salary</th>
                                    <td>
                                        <input type="number" class="form-control basic_salary" value="0" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Allowances</th>
                                    <td>
                                        <input type="number" class="form-control total_allowance" value="0" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Deductions</th>
                                    <td>
                                        <input type="number" class="form-control" value="0" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Net Salary</th>
                                    <td>
                                        <input type="number" class="form-control" value="0" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <select class="form-select">
                                            <option>Select</option>
                                            <option>Bank Transfer</option>
                                            <option>Cash</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <input type="text" class="form-control" value="Paid" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary w-100 mt-3 btn-lg">Create Payslip</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {

            const cart = new Cart('payslip');
            printCart();
            printCartDeduc();

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
                        $(".basic_salary").val(res.employees?.salary);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });

            $('.alowance_add_btn').on('click', function() {
                // alert();

                let payslip_items_allowance_id = $("#allowance_items").val();
                let payslip_items_allowance_name = $("#allowance_items option:selected").text();
                let allowance_amount = $(".allowance_amount").val();
                let subtotal = allowance_amount;

                //console.log(payslip_items_allowance_id, payslip_items_allowance_name, allowance_amount);
                // let total_allowance = subtotal;
                if (!payslip_items_allowance_id || allowance_amount <= 0) {
                    alert("Please select an allowance and enter a valid amount.");
                    return;
                }

                let item = {
                    'name': payslip_items_allowance_name,
                    'item_id': payslip_items_allowance_id,
                    'allowance_amount': allowance_amount,
                    'subtotal': subtotal
                };

                cart.save(item);
                printCart();

            });


            function printCart() {
                let cartdata = cart.getCart();
                if (cartdata) {

                    let htmldata = "";
                    let subtotal = 0;
                    let total_allowance = 0;

                    cartdata.forEach((element, index) => {
                        subtotal += element.subtotal;
                        total_allowance += element.subtotal;

                        htmldata += `
                                        <tr>
                                            <td>
                                                <p class="fs-14">${element.name}</p>
                                            </td>
                                            <td>
                                                <p class="fs-14">${element.allowance_amount}</p>
                                            </td>
                                             <td>
						                        <button data="${element.item_id}" class=' btn btn-danger remove'>-</button>
					                        </td>
                                        </tr>
				                    `;
                    });

                    $('.dataAppend').html(htmldata);
                    $('.subtotal').html(subtotal);
                    $('.total_allowance').html(subtotal);
                    // $('.grandtotal').html(subtotal + (subtotal * 5 / 100));
                    cartIconIncrease()
                }

            }


            $(document).on('click', '.remove', function() {
                let id = $(this).attr('data');
                cart.delItem(id);
                printCart();
            })

            $(document).on('click', '.clearAll', function() {
                cart.clearCart();
                printCart();
            });
            cartIconIncrease()

            function cartIconIncrease() {
                let items = cart.getCart().length
                $(".cartIcon").html(items);
            }

            cart.clearCart();





            $('.deduction_add_btn').on('click', function() {
                // alert();

                let payslip_items_deduction_id = $("#deduction_items").val();
                let payslip_items_deduction_name = $("#deduction_items option:selected").text();
                let deduction_amount = $(".deduction_amount").val();
                let subtotal = deduction_amount;

                //console.log(payslip_items_allowance_id, payslip_items_allowance_name, allowance_amount);
                // let total_allowance = subtotal;
                if (!payslip_items_deduction_id || deduction_amount <= 0) {
                    alert("Please select an allowance and enter a valid amount.");
                    return;
                }

                let item = {
                    'name': payslip_items_deduction_name,
                    'item_id': payslip_items_deduction_id,
                    'deduction_amount': deduction_amount,
                    'subtotal': subtotal
                };

                cart.save(item);
                printCartDeduc();

            });



            function printCartDeduc() {
                let cartdata = cart.getCart();
                if (cartdata) {

                    let htmldata = "";
                    let subtotal = 0;
                    let total_deduction = 0;

                    cartdata.forEach((element, index) => {
                        subtotal += element.subtotal;
                        total_deduction += element.subtotal;

                        htmldata += `
                                        <tr>
                                            <td>
                                                <p class="fs-14">${element.name}</p>
                                            </td>
                                            <td>
                                                <p class="fs-14">${element.deduction_amount}</p>
                                            </td>
                                             <td>
						                        <button data-id="${element.item_id}" class=' btn btn-danger removed'>-</button>
					                        </td>
                                        </tr>
				                    `;
                    });

                    $('.dataAppended').html(htmldata);
                    $('.subtotal').html(subtotal);
                    $('.total_deduction').html(subtotal);
                    // $('.grandtotal').html(subtotal + (subtotal * 5 / 100));
                    cartIconIncreaseDeduc()
                }

            }


            $(document).on('click', '.removed', function() {
                let id = $(this).attr('data-id');
                cart.delItem(id);
                printCartDeduc();
            })

            $(document).on('click', '.Clear', function() {
                cart.clearCart();
                printCartDeduc();
            });
            cartIconIncreaseDeduc()

            function cartIconIncreaseDeduc() {
                let items = cart.getCart().length
                $(".cartIcon").html(items);
            }

            cart.clearCart();






        })
    </script>
     <script src="{{ asset('assets/js/cart_.js') }}"></script>
@endsection


{{--
let allowanceCart = [];
let deductionCart = [];

// ================= ALLOWANCE SECTION =================
$('.allowance_add_btn').on('click', function() {
    let payslip_items_allowance_id = $("#allowance_items").val();
    let payslip_items_allowance_name = $("#allowance_items option:selected").text();
    let allowance_amount = parseFloat($(".allowance_amount").val()) || 0;

    if (!payslip_items_allowance_id || allowance_amount <= 0) {
        alert("Please select an allowance and enter a valid amount.");
        return;
    }

    let item = {
        'name': payslip_items_allowance_name,
        'item_id': payslip_items_allowance_id,
        'allowance_amount': allowance_amount
    };

    allowanceCart.push(item);
    printAllowanceCart();
});

function printAllowanceCart() {
    let htmldata = "";
    let subtotal = 0;

    allowanceCart.forEach((element, index) => {
        subtotal += element.allowance_amount;

        htmldata += `
            <tr>
                <td><p class="fs-14">${index + 1}</p></td>
                <td><p class="fs-14">${element.name}</p></td>
                <td><p class="fs-14">${element.allowance_amount.toFixed(2)}</p></td>
                <td>
                    <button data-id="${element.item_id}" class='btn btn-danger remove-allowance'>-</button>
                </td>
            </tr>
        `;
    });

    $('.dataAppend').html(htmldata);
    $('.allowance-subtotal').html(subtotal.toFixed(2));
    $('.total_allowance').html(subtotal.toFixed(2));

    updateAllowanceIcon();
}

// Remove allowance item
$(document).on('click', '.remove-allowance', function() {
    let id = $(this).attr('data-id');
    allowanceCart = allowanceCart.filter(item => item.item_id !== id);
    printAllowanceCart();
});

// Clear all allowances
$(document).on('click', '.clearAllowances', function() {
    allowanceCart = [];
    printAllowanceCart();
});

function updateAllowanceIcon() {
    $(".allowanceIcon").html(allowanceCart.length);
}

// ================= DEDUCTION SECTION =================
$('.deduction_add_btn').on('click', function() {
    let payslip_items_deduction_id = $("#deduction_items").val();
    let payslip_items_deduction_name = $("#deduction_items option:selected").text();
    let deduction_amount = parseFloat($(".deduction_amount").val()) || 0;

    if (!payslip_items_deduction_id || deduction_amount <= 0) {
        alert("Please select a deduction and enter a valid amount.");
        return;
    }

    let item = {
        'name': payslip_items_deduction_name,
        'item_id': payslip_items_deduction_id,
        'deduction_amount': deduction_amount
    };

    deductionCart.push(item);
    printDeductionCart();
});

function printDeductionCart() {
    let htmldata = "";
    let subtotal = 0;

    deductionCart.forEach((element, index) => {
        subtotal += element.deduction_amount;

        htmldata += `
            <tr>
                <td><p class="fs-14">${index + 1}</p></td>
                <td><p class="fs-14">${element.name}</p></td>
                <td><p class="fs-14">${element.deduction_amount.toFixed(2)}</p></td>
                <td>
                    <button data-id="${element.item_id}" class='btn btn-danger remove-deduction'>-</button>
                </td>
            </tr>
        `;
    });

    $('.dataAppended').html(htmldata);
    $('.deduction-subtotal').html(subtotal.toFixed(2));
    $('.total_deduction').html(subtotal.toFixed(2));

    updateDeductionIcon();
}

// Remove deduction item
$(document).on('click', '.remove-deduction', function() {
    let id = $(this).attr('data-id');
    deductionCart = deductionCart.filter(item => item.item_id !== id);
    printDeductionCart();
});

// Clear all deductions
$(document).on('click', '.clearDeductions', function() {
    deductionCart = [];
    printDeductionCart();
});

function updateDeductionIcon() {
    $(".deductionIcon").html(deductionCart.length);
}

// ================= CLEAR ALL =================
$(document).on('click', '.clearAll', function() {
    allowanceCart = [];
    deductionCart = [];
    printAllowanceCart();
    printDeductionCart();
});

// ================= INITIALIZE =================
printAllowanceCart();
printDeductionCart();
 --}}
