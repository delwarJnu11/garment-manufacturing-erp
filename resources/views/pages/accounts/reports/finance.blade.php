@extends('layout.backend.main')
@section('page_content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Financial Statements</h1>
        <p class="lead">An overview of the company's financial health.</p>
    </div>

    <!-- Financial Report Tabs -->
    <ul class="nav nav-tabs  bg-secondary" id="financialTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="income-statement-tab" data-bs-toggle="tab" href="#income-statement" role="tab" aria-controls="income-statement" aria-selected="true">Income Statement</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="balance-sheet-tab" data-bs-toggle="tab" href="#balance-sheet" role="tab" aria-controls="balance-sheet" aria-selected="false">Balance Sheet</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="cash-flow-tab" data-bs-toggle="tab" href="#cash-flow" role="tab" aria-controls="cash-flow" aria-selected="false">Cash Flow Statement</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="financialTabsContent">
        <!-- Income Statement Tab -->
        <div class="tab-pane fade show active" id="income-statement" role="tabpanel" aria-labelledby="income-statement-tab">
            <h4 class="mb-1">Income Statement</h4>
            <table class="table table-bordered table-striped table-dark w-50 mx-auto">
                <thead>
                    <tr class="bg-secondary">
                        <th class="text-center">Description</th>
                        <th class="text-center">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Revenue</td>
                        <td class="text-end">1,000,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Cost of Goods Sold</td>
                        <td class="text-end">(600,000) ৳</td>
                    </tr>
                    <tr>
                        <td>Gross Profit</td>
                        <td class="text-end">400,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Operating Expenses</td>
                        <td class="text-end">(150,000) ৳</td>
                    </tr>
                    <tr>
                        <td>Net Income</td>
                        <td class="text-end">250,000 ৳</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Balance Sheet Tab -->
        <div class="tab-pane fade" id="balance-sheet" role="tabpanel" aria-labelledby="balance-sheet-tab">
            <h4 class="mb-1">Balance Sheet</h4>
            <table class="table table-bordered w-50 mx-auto">
                <thead>
                    <tr class="bg-secondary">
                        <th class="text-center">Description</th>
                        <th class="text-center">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Assets</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Current Assets</td>
                        <td class="text-end">500,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Non-Current Assets</td>
                        <td class="text-end">1,200,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Total Assets</td>
                        <td class="text-end">1,700,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Liabilities</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Current Liabilities</td>
                        <td class="text-end">200,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Non-Current Liabilities</td>
                        <td class="text-end">500,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Total Liabilities</td>
                        <td class="text-end">700,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Equity</td>
                        <td class="text-end">1,000,000 ৳</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Cash Flow Statement Tab -->
        <div class="tab-pane fade" id="cash-flow" role="tabpanel" aria-labelledby="cash-flow-tab">
            <h4 class="mb-1">Cash Flow Statement</h4>
            <table class="table table-bordered table-striped table-dark w-50 mx-auto">
                <thead>
                    <tr class="bg-secondary">
                        <th class="text-center">Description</th>
                        <th class="text-center">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Operating Activities</td>
                        <td class="text-end">300,000 ৳</td>
                    </tr>
                    <tr>
                        <td>Investing Activities</td>
                        <td class="text-end">(100,000) ৳</td>
                    </tr>
                    <tr>
                        <td>Financing Activities</td>
                        <td class="text-end">(50,000) ৳</td>
                    </tr>
                    <tr>
                        <td>Net Cash Flow</td>
                        <td class="text-end">150,000 ৳</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for showing details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Additional Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>More details can be added dynamically here...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>

@section('script')
<script>
    // Example of jQuery for interaction
    $(document).ready(function() {
        // Show details modal when clicking any amount cell
        $('td').click(function() {
            $('#detailsModal').modal('show');
        });
    });
</script>

@endsection

<!-- what are the reports produced by accounts & finance module of an ERP software?
    1. Financial Statements
    Balance Sheet – Displays assets, liabilities, and equity at a specific point in time.
    Profit & Loss Statement (Income Statement) – Shows revenues, expenses, and net profit/loss over a period.
    Cash Flow Statement – Tracks cash inflows and outflows from operating, investing, and financing activities.
    2. Accounts Payable & Receivable Reports
    Aging Reports – Lists outstanding invoices categorized by due date.
    Vendor Outstanding Report – Details unpaid invoices to suppliers.
    Customer Outstanding Report – Shows unpaid invoices from customers.
    Payment Due Report – Tracks upcoming payments to be made.
    Invoice Summary – Lists all issued invoices and their statuses.
    3. General Ledger Reports
    Trial Balance – Summarizes all debit and credit balances to check accounting accuracy.
    Ledger Summary – Detailed breakdown of all transactions in each account.
    Journal Entry Report – Lists all manual and system-generated journal entries.
    4. Tax & Compliance Reports
    GST/VAT Report – Summarizes tax collected and payable for compliance.
    Withholding Tax Report – Details tax deducted at source for suppliers and employees.
    Audit Trail Report – Logs all changes made to financial records for audit purposes.
    5. Budgeting & Forecasting Reports
    Budget Variance Report – Compares actual expenses with budgeted amounts.
    Financial Forecasting Report – Predicts future financial performance based on trends.
    6. Bank Reconciliation & Cash Management Reports
    Bank Reconciliation Statement – Matches company records with bank statements.
    Petty Cash Report – Tracks small cash expenses.
    7. Fixed Assets Reports
    Depreciation Report – Calculates depreciation for fixed assets.
    Fixed Assets Register – Lists all company assets with details.
    8. Payroll & Employee Expense Reports
    Salary Expense Report – Summarizes employee salaries and benefits.
    Employee Reimbursement Report – Details reimbursed expenses.
    9. Project & Cost Accounting Reports
    Job Costing Report – Tracks costs associated with projects.
    Department-wise Expense Report – Breaks down expenses by department or cost center.
    10. Custom & Analytical Reports
    Profitability Analysis Report – Assesses profitability by product, project, or department.
    Financial KPI Report – Tracks key financial indicators like EBITDA, ROE, and ROA.
    Custom Dashboards – Interactive reports tailored to business needs.
    @endsection -->