@extends('layout.backend.main')
@section('page_content')
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
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="chartOfAccounts-tab" data-bs-toggle="tab" href="#chartOfAccounts" role="tab" aria-controls="chartOfAccounts" aria-selected="false">Chart Of Account</a>
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
                            @foreach($groups as $group)
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