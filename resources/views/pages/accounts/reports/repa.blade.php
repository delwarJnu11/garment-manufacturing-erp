@extends('layout.backend.main')
@section('page_content')
    <style>
        /* Additional styling for table */
        table th, table td {
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
    <h1 class="text-center my-4">Accounts Payable & Receivable Report</h1>

    <div class="row mb-3">
        <!-- Search and Filter Options -->
        <div class="col-md-6">
            <input type="text" class="form-control" id="searchInput" placeholder="Search by Vendor/Customer">
        </div>
        <div class="col-md-3">
            <select class="form-select" id="filterStatus">
                <option value="">Filter by Status</option>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <!-- Accounts Payable Table -->
        <h3>Accounts Payable</h3>
        <table class="table table-striped table-bordered" id="accountsPayableTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Invoice Number</th>
                    <th>Due Date</th>
                    <th>Amount (USD)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Vendor A</td>
                    <td>INV12345</td>
                    <td>2025-03-10</td>
                    <td>500.00</td>
                    <td>Unpaid</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Vendor B</td>
                    <td>INV12346</td>
                    <td>2025-02-28</td>
                    <td>300.00</td>
                    <td>Paid</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Vendor C</td>
                    <td>INV12347</td>
                    <td>2025-03-05</td>
                    <td>200.00</td>
                    <td>Unpaid</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-container">
        <!-- Accounts Receivable Table -->
        <h3>Accounts Receivable</h3>
        <table class="table table-striped table-bordered" id="accountsReceivableTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Invoice Number</th>
                    <th>Due Date</th>
                    <th>Amount (USD)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Customer A</td>
                    <td>INV12348</td>
                    <td>2025-03-12</td>
                    <td>800.00</td>
                    <td>Unpaid</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Customer B</td>
                    <td>INV12349</td>
                    <td>2025-03-02</td>
                    <td>1200.00</td>
                    <td>Paid</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Customer C</td>
                    <td>INV12350</td>
                    <td>2025-03-06</td>
                    <td>350.00</td>
                    <td>Unpaid</td>
                </tr>
            </tbody>
        </table>
    </div>
<!-- jQuery Script for search and filter -->
<script>
    $(document).ready(function() {
        // Search function
        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            
            $('#accountsPayableTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
            
            $('#accountsReceivableTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
        });

        // Filter by Status
        $('#filterStatus').on('change', function() {
            var statusFilter = $(this).val();
            
            $('#accountsPayableTable tbody tr').filter(function() {
                var status = $(this).find('td:last').text();
                $(this).toggle(statusFilter === "" || status === statusFilter);
            });

            $('#accountsReceivableTable tbody tr').filter(function() {
                var status = $(this).find('td:last').text();
                $(this).toggle(statusFilter === "" || status === statusFilter);
            });
        });
    });
</script>
@endsection