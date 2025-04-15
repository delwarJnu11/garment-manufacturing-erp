@extends('layout.backend.main')
@section('page_content')

@php
$assets = DB::table('transactions')
->whereIn('account_id', [1, 2, 3, 5, 6, 7, 8, 9])
->selectRaw('SUM(debit) - SUM(credit) as total_assets')
->first();

$liabilities = DB::table('transactions')
->whereIn('account_id', [10, 13, 14, 15, 16, 17, 18, 19, 20, 40, 41, 42, 43, 44, 45, 46])
->selectRaw('SUM(credit) - SUM(debit) as total_liabilities')
->first();

$equity = DB::table('transactions')
->whereIn('account_id', [24, 25])
->selectRaw('SUM(debit) - SUM(credit) as total_equity')
->first();
@endphp
<div class="">
    <div class="text-center mb-4">
        <h1>Financial Statements</h1>
        <p class="lead">An overview of the company's financial health.</p>
    </div>

    <!-- Financial Report Tabs -->
    <ul class="nav nav-tabs  bg-secondary p-2" id="financialTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="income-statement-tab" data-bs-toggle="tab" href="#income-statement" role="tab" aria-controls="income-statement" aria-selected="true">Income Statement</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="balance-sheet-tab" data-bs-toggle="tab" href="#balance-sheet" role="tab" aria-controls="balance-sheet" aria-selected="false">Balance Sheet</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="cash-flow-tab" data-bs-toggle="tab" href="#cash-flow" role="tab" aria-controls="cash-flow" aria-selected="false">Cash Flow Statement</a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="chartOfAccounts-tab" data-bs-toggle="tab" href="#chartOfAccounts" role="tab" aria-controls="chartOfAccounts" aria-selected="false">Chart Of Account</a>
        </li> -->
    </ul>

    <div class="tab-content mt-4" id="financialTabsContent">
        <!-- Income Statement Tab -->
        <div class="tab-pane fade show active" id="income-statement" role="tabpanel" aria-labelledby="income-statement-tab">
            <!-- <h4 class="mb-1">Income Statement</h4>
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
            </table> -->

            <!-- <h1>Income Statement</h1> -->

            <h2>Revenues</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Revenue Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sales Revenue (Garment Sales)</td>
                        <td>4,500.00</td>
                    </tr>
                    <tr>
                        <td>Service Income (Shipping)</td>
                        <td>400.00</td>
                    </tr>
                    <tr>
                        <td>Embroidery Services Income</td>
                        <td>500.00</td>
                    </tr>
                    <tr>
                        <td>Miscellaneous Revenue</td>
                        <td>200.00</td>
                    </tr>
                    <tr class="total">
                        <td>Total Revenues</td>
                        <td>5,600.00</td>
                    </tr>
                </tbody>
            </table>

            <h2>Cost of Goods Sold (COGS)</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="section-title">
                        <td>Raw Materials</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Fabric Purchase</td>
                        <td>800.00</td>
                    </tr>
                    <tr>
                        <td>Trims and Accessories Purchase</td>
                        <td>400.00</td>
                    </tr>
                    <tr class="total">
                        <td>Total COGS</td>
                        <td>1,200.00</td>
                    </tr>
                </tbody>
            </table>

            <h2>Operating Expenses</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="section-title">
                        <td>Labor and Factory Costs</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Direct Labor Costs</td>
                        <td>1,000.00</td>
                    </tr>
                    <tr>
                        <td>Factory Utility Costs</td>
                        <td>600.00</td>
                    </tr>
                    <tr>
                        <td>Machine Maintenance Costs</td>
                        <td>200.00</td>
                    </tr>
                    <tr>
                        <td>Factory Rent Expense</td>
                        <td>1,500.00</td>
                    </tr>
                    <tr>
                        <td>Depreciation of Factory Assets</td>
                        <td>500.00</td>
                    </tr>
                    <tr>
                        <td>Freight and Shipping Costs</td>
                        <td>300.00</td>
                    </tr>
                    <tr class="section-title">
                        <td>Administrative and General Expenses</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Salaries for Administrative Staff</td>
                        <td>2,000.00</td>
                    </tr>
                    <tr>
                        <td>Office Supplies Purchased</td>
                        <td>150.00</td>
                    </tr>
                    <tr>
                        <td>Legal and Professional Fees</td>
                        <td>300.00</td>
                    </tr>
                    <tr>
                        <td>Marketing Expenses</td>
                        <td>500.00</td>
                    </tr>
                    <tr class="total">
                        <td>Total Operating Expenses</td>
                        <td>7,550.00</td>
                    </tr>
                </tbody>
            </table>

            <h2>Other Expenses</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="section-title">
                        <td>Financial Expenses</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Interest Expense on Loan</td>
                        <td>200.00</td>
                    </tr>
                    <tr class="section-title">
                        <td>Tax Expenses</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Income Tax Payable</td>
                        <td>800.00</td>
                    </tr>
                    <tr class="total">
                        <td>Total Other Expenses</td>
                        <td>1,000.00</td>
                    </tr>
                </tbody>
            </table>

            <h2>Income Statement Summary</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Revenues</td>
                        <td>5,600.00</td>
                    </tr>
                    <tr>
                        <td>Total COGS</td>
                        <td>(1,200.00)</td>
                    </tr>
                    <tr class="total">
                        <td>Gross Profit</td>
                        <td>4,400.00</td>
                    </tr>
                    <tr>
                        <td>Total Operating Expenses</td>
                        <td>(7,550.00)</td>
                    </tr>
                    <tr>
                        <td>Total Other Expenses</td>
                        <td>(1,000.00)</td>
                    </tr>
                    <tr class="total">
                        <td>Net Income (Loss)</td>
                        <td>(4,150.00)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Balance Sheet Tab -->
        <div class="tab-pane fade" id="balance-sheet" role="tabpanel" aria-labelledby="balance-sheet-tab">


            <!-- <h1>Balance Sheet</h1> -->
            <div class="statement-section">
                <!-- <h2>Balance Sheet</h2> -->
                <h3>Assets</h3>
                <table class="table table-light table-striped w-75 mx-auto">
                    <thead>
                        <tr>
                            <th>Assets</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cash</td>
                            <td>$6,000.00</td> <!-- Based on transactions like cash received, deposits -->
                        </tr>
                        <tr>
                            <td>Accounts Receivable</td>
                            <td>$1,500.00</td> <!-- Receivables from customer payments -->
                        </tr>
                        <tr>
                            <td>Raw Materials</td>
                            <td>$500.00</td> <!-- Raw materials purchase -->
                        </tr>
                        <tr>
                            <td>Finished Goods Inventory</td>
                            <td>$3,000.00</td> <!-- Finished goods inventory addition -->
                        </tr>
                        <tr>
                            <td>Prepaid Expenses</td>
                            <td>$600.00</td> <!-- Payment for prepaid expenses -->
                        </tr>
                        <tr>
                            <td>Fixed Assets</td>
                            <td>$2,000.00</td> <!-- Purchase of fixed assets -->
                        </tr>
                    </tbody>
                </table>

                <h3>Liabilities</h3>
                <table class="table table-light table-striped w-75 mx-auto">
                    <thead>
                        <tr>
                            <th>Liabilities</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accounts Payable</td>
                            <td>$1,000.00</td> <!-- Accounts payable to suppliers -->
                        </tr>
                        <tr>
                            <td>Short-term Loan</td>
                            <td>$3,000.00</td> <!-- Short-term loan received -->
                        </tr>
                        <tr>
                            <td>Long-term Loan</td>
                            <td>$5,000.00</td> <!-- Long-term loan received -->
                        </tr>
                        <tr>
                            <td>Accrued Liabilities</td>
                            <td>$1,000.00</td> <!-- Accrued liabilities (taxes, wages, expenses) -->
                        </tr>
                    </tbody>
                </table>

                <h3>Equity</h3>
                <table class="table table-light table-striped w-75 mx-auto">
                    <thead>
                        <tr>
                            <th>Equity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Owner's Equity</td>
                            <td>$5,000.00</td> <!-- Owner's equity capital contribution -->
                        </tr>
                        <tr>
                            <td>Retained Earnings</td>
                            <td>$1,000.00</td> <!-- Retained earnings from last year -->
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>

        <!-- Cash Flow Statement Tab -->
        <div class="tab-pane fade" id="cash-flow" role="tabpanel" aria-labelledby="cash-flow-tab">
            <!-- <h4 class="mb-1">Cash Flow Statement</h4>
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
            </table> -->

            <!-- <h1>Cash Flow Statement</h1> -->

            <h2>Operating Activities</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Activity Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cash Received from Customers</td>
                        <td>1,000.00</td>
                    </tr>
                    <tr>
                        <td>Cash Payments to Suppliers (Raw Materials)</td>
                        <td>(1,200.00)</td>
                    </tr>
                    <tr>
                        <td>Cash Payments for Operating Expenses</td>
                        <td>(6,750.00)</td>
                    </tr>
                    <tr>
                        <td>Cash Payments for Interest</td>
                        <td>(200.00)</td>
                    </tr>
                    <tr>
                        <td>Cash Payments for Taxes</td>
                        <td>(800.00)</td>
                    </tr>
                    <tr class="total">
                        <td>Net Cash from Operating Activities</td>
                        <td>(7,950.00)</td>
                    </tr>
                </tbody>
            </table>

            <h2>Investing Activities</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Activity Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Purchase of Fixed Assets (Machine and Equipment)</td>
                        <td>(2,000.00)</td>
                    </tr>
                    <tr class="total">
                        <td>Net Cash Used in Investing Activities</td>
                        <td>(2,000.00)</td>
                    </tr>
                </tbody>
            </table>

            <h2>Financing Activities</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Activity Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Owner's Equity Capital Contribution</td>
                        <td>5,000.00</td>
                    </tr>
                    <tr>
                        <td>Short-Term Loan Received</td>
                        <td>3,000.00</td>
                    </tr>
                    <tr>
                        <td>Long-Term Loan Received</td>
                        <td>5,000.00</td>
                    </tr>
                    <tr class="total">
                        <td>Net Cash from Financing Activities</td>
                        <td>13,000.00</td>
                    </tr>
                </tbody>
            </table>

            <h2>Cash Flow Summary</h2>
            <table class="table table-light table-striped w-75 mx-auto">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Net Cash from Operating Activities</td>
                        <td>(7,950.00)</td>
                    </tr>
                    <tr>
                        <td>Net Cash Used in Investing Activities</td>
                        <td>(2,000.00)</td>
                    </tr>
                    <tr>
                        <td>Net Cash from Financing Activities</td>
                        <td>13,000.00</td>
                    </tr>
                    <tr class="total">
                        <td>Net Change in Cash</td>
                        <td>3,050.00</td>
                    </tr>
                    <tr>
                        <td>Cash at Beginning of Period</td>
                        <td>0.00</td>
                    </tr>
                    <tr class="total">
                        <td>Cash at End of Period</td>
                        <td>3,050.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Chart Of Accounts Tab -->
        <div class="tab-pane fade" id="chartOfAccounts" role="tabpanel" aria-labelledby="chartOfAccounts-tab">
            <h4 class="mb-1">Chart Of Accounts</h4>
            <a href="{{ route('chart.of.accounts.pdf') }}" class="btn btn-danger mb-3">Print PDF</a>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th colspan="1">Code</th>
                                <th colspan="4">Account Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups??[] as $group)
                            <tr class="table-primary">
                                <td colspan="1"><strong>{{ $group->code }}</strong></td>
                                <td colspan="4"><strong>{{ $group->name }} ({{ $group->code }})</strong></td>
                            </tr>
                            @foreach($group->accounts as $account)
                            <tr>
                                <td colspan="1">{{ $account->code }}</td>
                                <td colspan="4">{{ $account->name }}( {{ $account->code }})</td>
                            </tr>
                            @endforeach
                            @foreach($group->children as $child)
                            <tr class="table-secondary">
                                <td colspan="1"><strong>{{ $child->code }}</strong></td>
                                <td colspan="4"><strong>{{ $child->name }} ({{ $child->code }})</strong></td>
                            </tr>
                            @foreach($child->accounts as $account)
                            <tr>
                                <td colspan="1">{{ $account->code }}</td>
                                <td colspan="4">{{ $account->name }} ({{ $account->code }})</td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

@endsection
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