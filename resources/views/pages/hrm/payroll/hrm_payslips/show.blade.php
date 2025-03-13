@extends('layout.backend.main')
@section('css')
<style>
    /* General Styles */
body {
font-family: Arial, sans-serif;
background-color: #f4f7fc;
margin: 0;
padding: 0;
}

/* Card and Content Styling */
.card-body {
background-color: #fff;
padding: 30px;
border-radius: 10px;
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
max-width: 800px;
margin: 30px auto;
}

/* Header Section */
#viewData img {
max-width: 150px;
margin-bottom: 15px;
}

h4 {
font-size: 24px;
font-weight: bold;
margin-top: 10px;
}

h4 span {
font-size: 18px;
color: #5f6368;
}

/* Table Styles */
table {
width: 100%;
margin-top: 20px;
border-collapse: collapse;
font-size: 14px;
}

th, td {
padding: 12px;
text-align: left;
border: 1px solid #ddd;
}

th {
background-color: #f7f7f7;
font-weight: bold;
}

td {
background-color: #fff;
}

.text-center {
text-align: center;
}

/* Payroll Data Table */
.payrollDatatableReport {
margin-top: 20px;
border-radius: 8px;
}

.payrollDatatableReport th, .payrollDatatableReport td {
border: 1px solid #e2e2e2;
}

.payrollDatatableReport tr.alert-warning {
background-color: #ffeb3b;
font-weight: bold;
}

.payrollDatatableReport .text-start {
font-size: 16px;
}

/* Two Column Layout for Description and Deduction */
.payroll-summary {
display: flex;
justify-content: space-between;
gap: 20px;
margin-top: 20px;
}

.description, .deduction {
flex: 1;
background-color: #f9f9f9;
padding: 15px;
border-radius: 8px;
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.description h5, .deduction h5 {
font-size: 18px;
font-weight: bold;
margin-bottom: 15px;
}

.table-striped tr:nth-child(odd) {
background-color: #f9f9f9;
}

.table-striped th, .table-striped td {
font-size: 14px;
}

/* Footer Section */
footer {
text-align: center;
margin-top: 30px;
font-size: 14px;
color: #5f6368;
}

footer div {
display: inline-block;
width: 33%;
text-align: center;
padding: 10px 0;
font-weight: bold;
}

footer div:not(:last-child) {
border-right: 1px solid #ddd;
}

.border-top {
border-top: 2px solid #ddd;
padding-top: 10px;
}


@media print {
    body * {
        visibility: hidden;
    }

    #section-to-print,
    #section-to-print * {
        visibility: visible;
    }

    #section-to-print {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }

    @page {
            size: A4;
            margin: 20mm;
        }
}

</style>
@endsection
@section('page_content')

<div class="d-flex justify-content-end">
    <button class="btn btn-primary" onclick="printPayslip()">Print</button>
</div>

<div class="card-body" id="section-to-print">
    <div id="viewData">
        <div class="px-5">
            <table width="99%">
                <tbody>
                    <tr>
                        <td width="50%"><h2>Company Name</h2>
                            <p>123 Business Rd<br>City, State, ZIP<br>Email: info@company.com<br>Phone: (123) 456-7890</p></td>
                        <td width="50%" class="text-center">
                            <img src="https://hrm.bdtask-demoserver.com/storage/application/1716986808logo.jpg">
                            <h4 class="mt-3">Bdtask HRM <span class="text-uppercase">(Payslip)</span> </h4>
                        </td>
                        {{-- <td width="30%"></td> --}}
                    </tr>
                </tbody>
            </table>
            <br>

            <div class="row">
                <div class="text-center bg-info fs-3 p-3 rounded-2">Employee Salary Slip</div>
                <table width="99%" class="payrollDatatableReport table table-bordered">
                    <tbody>
                        <tr class="text-start">
                            <th>Employee name</th>
                            <td>Hasan</td>
                            <th>Month</th>
                            <td>March, 2025</td>
                        </tr>
                        <tr class="text-start">
                            <th>Employee ID</th>
                            <td>#EMP0000002</td>
                            <th>Total Working Days:</th>
                            <td>22</td>
                        </tr>
                        <tr class="text-start">
                            <th>Employee Designation</th>
                            <td>Managing Director</td>
                            <th>Working Days Attendance:</th>
                            <td>20</td>
                        </tr>
                        <tr class="text-start">
                            <th>Employee Department</th>
                            <td>The Pre-Production</td>
                            <th>Leaves Taken</th>
                            <td>2</td>
                        </tr>
                        <tr>
                            <th>Employee Bank Account</th>
                            <td>123456789</td>
                            <th>Balance Leaves</th>
                            <td>8</td>
                        </tr>
                        <tr class="text-start">
                            <th>Employee Bank Name</th>
                            <td>Duch Bangla Bank</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <!-- Two-Column Layout for Description and Deduction -->
                <div class="payroll-summary">
                    <div class="description">
                        <h5 class="bg-success p-3 text-center rounded-2">Allowance</h5>
                        <table width="100%" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>House Rent Allowance (HRA)</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td>Medical Allowance</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td>Festival Allowance</td>
                                    <td>1000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="deduction">
                        <h5 class=" bg-danger p-3 text-center rounded-2">Deduction</h5>
                        <table width="100%" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Provident Fund (PF)</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>Income Tax (TDS)</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>Absenteeism</td>
                                    <td>500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Total Deductions and Net Salary -->
                {{-- <table width="95%" class="payrollDatatableReport table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="alert-warning text-start">
                            <th>Description</th>
                            <th>Amount (৳)</th>
                            <th>Rate (৳)</th>
                            <th>#Value (৳)</th>
                            <th>Deduction (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-start">
                            <th>Gross salary</th>
                            <th></th>
                            <th></th>
                            <th>1,570.00</th>
                            <th></th>
                        </tr>
                        <tr class="text-start">
                            <th>Total deductions</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>1,020.00</th>
                        </tr>
                        <tr class="text-start alert-warning">
                            <th colspan="4">Net salary</th>
                            <th class="text-start">550.00</th>
                        </tr>
                    </tbody>
                </table> --}}
                <div class="summary-box mt-3 card p-2">
                    <h5 class="card-header bg-warning text-white text-center fs-4 rounded-2">Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <tbody class="text-center">
                                <tr>
                                    <th style="width: 30%;">Basic Salary</th>
                                    <td>40000.00</td>
                                </tr>
                                <tr>
                                    <th>Total Allowances</th>
                                    <td>3000.00</td>
                                </tr>
                                <tr>
                                    <th>Total Deductions</th>
                                    <td>1500.00</td>
                                </tr>
                                <tr>
                                    <th>Net Salary</th>
                                    <td>41500.00</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>Bank Transfer</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>Paid</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Footer Section -->
            <table width="100%" class="mt-5">
                <tbody>
                    <tr>
                        <td class="" width="33%">
                            <div class="border-top mx-5 text-center">Prepared by: <b>Admin</b></div>
                        </td>
                        <td width="33%">
                            <div class="border-top mx-5 text-center">Checked by</div>
                        </td>
                        <td width="33%">
                            <div class="border-top mx-5 text-center">Authorized by</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function printPayslip() {
    window.print();
}
</script>
@endsection

