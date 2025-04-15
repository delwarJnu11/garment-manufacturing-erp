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
        <h1 class="text-center my-4">Tax & Compliance Report</h1>

        <!-- Filter Section -->
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchInput" placeholder="Search by Tax Name or ID">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="startDate" placeholder="Start Date">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="endDate" placeholder="End Date">
            </div>
        </div>

        <div class="table-container">
            <!-- Tax & Compliance Report Table -->
            <table class="table table-striped table-bordered" id="taxComplianceTable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tax Name</th>
                        <th>Tax ID</th>
                        <th>Period</th>
                        <th>Due Date</th>
                        <th>Amount (USD)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sales Tax</td>
                        <td>TX101</td>
                        <td>Q1 2025</td>
                        <td>2025-04-15</td>
                        <td>10,000.00</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>VAT</td>
                        <td>TX102</td>
                        <td>Q1 2025</td>
                        <td>2025-04-20</td>
                        <td>5,000.00</td>
                        <td>Unpaid</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Corporate Tax</td>
                        <td>TX103</td>
                        <td>2024</td>
                        <td>2025-05-30</td>
                        <td>50,000.00</td>
                        <td>Unpaid</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Income Tax</td>
                        <td>TX104</td>
                        <td>Q4 2024</td>
                        <td>2025-03-10</td>
                        <td>8,000.00</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Withholding Tax</td>
                        <td>TX105</td>
                        <td>Q1 2025</td>
                        <td>2025-04-25</td>
                        <td>1,500.00</td>
                        <td>Paid</td>
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

                $('#taxComplianceTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            // Filter by Date Range
            $('#startDate, #endDate').on('change', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                $('#taxComplianceTable tbody tr').filter(function() {
                    var rowDate = $(this).find('td:nth-child(5)').text(); // Get Due Date from 5th column
                    $(this).toggle(
                        (startDate === "" || rowDate >= startDate) &&
                        (endDate === "" || rowDate <= endDate)
                    );
                });
            });
        });
    </script>
    
    @endsection