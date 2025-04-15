@extends('layout.backend.main')
@section('page_content')
<style>
    /* Additional styling for table */
    table th,
    table td {
        text-align: center;
    }

    .table-container {
        margin-top: 20px;
    }
</style>
<h1 class="text-center my-4">General Ledger Report</h1>

<!-- Filter Section -->
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by Account Name or Description">
    </div>
    <div class="col-md-3">
        <input type="date" class="form-control" id="startDate" placeholder="Start Date">
    </div>
    <div class="col-md-3">
        <input type="date" class="form-control" id="endDate" placeholder="End Date">
    </div>
</div>

<div class="table-container">
    <!-- General Ledger Table -->
    <table class="table table-striped table-bordered" id="generalLedgerTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Account Name</th>
                <th>Account Number</th>
                <th>Date</th>
                <th>Description</th>
                <th>Debit (USD)</th>
                <th>Credit (USD)</th>
                <th>Balance (USD)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Cash</td>
                <td>101</td>
                <td>2025-02-01</td>
                <td>Opening Balance</td>
                <td>1,000.00</td>
                <td>0.00</td>
                <td>1,000.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Accounts Receivable</td>
                <td>103</td>
                <td>2025-02-03</td>
                <td>Sale to Customer</td>
                <td>500.00</td>
                <td>0.00</td>
                <td>1,500.00</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Accounts Payable</td>
                <td>201</td>
                <td>2025-02-05</td>
                <td>Purchase from Vendor</td>
                <td>0.00</td>
                <td>300.00</td>
                <td>1,200.00</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Cash</td>
                <td>101</td>
                <td>2025-02-07</td>
                <td>Payment from Customer</td>
                <td>0.00</td>
                <td>500.00</td>
                <td>700.00</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Accounts Receivable</td>
                <td>103</td>
                <td>2025-02-10</td>
                <td>Payment Received</td>
                <td>0.00</td>
                <td>500.00</td>
                <td>1,000.00</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- jQuery Script for search and filter -->

@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Search functionality
        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('#generalLedgerTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
        });

        // Filter by Date Range
        $('#startDate, #endDate').on('change', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            $('#generalLedgerTable tbody tr').filter(function() {
                var rowDate = $(this).find('td:nth-child(4)').text(); // Get Date from 4th column
                $(this).toggle(
                    (startDate === "" || rowDate >= startDate) &&
                    (endDate === "" || rowDate <= endDate)
                );
            });
        });
    });
</script>
@endsection