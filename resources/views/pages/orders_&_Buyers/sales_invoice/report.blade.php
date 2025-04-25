@extends('layout.backend.main')

@section('page_content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4 style="color: white">Sales Invoice Report</h4>
            </div>
            {{-- {{ route('sales-invoice.report') }} --}}
            <div class="card-body">
                <form method="POST" action="{{ route('salesReport.post') }}" class="row g-3 mb-4">
                    @csrf
                    <div class="col-md-4">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" class="form-control" value="{{ $startDate ?? '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" class="form-control" value="{{ $endDate ?? '' }}" required>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Generate Report</button>
                    </div>
                </form>

               
                @if (!empty($salesReport) && count($salesReport) > 0)
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Invoice ID</th>
                                <th>Order Number</th>
                                <th>Buyer Name</th>
                                <th>Sale Date</th>
                                <th>Total Sales Amount</th>
                                <th>Total Cost (BOM)</th>
                                <th>Profit</th>
                            </tr>
                        </thead>


                        <tbody>
                            @php $serial = 1; @endphp
                            @foreach ($salesReport as $report)
                                
                                @php
                                    $totalBomCost = 0;
                                    $firstDetail = $report->salesInvoiceDetails->first();
                                    $order = $firstDetail->order ?? null;
                                    $buyer = $order?->buyer;

                                    if ($order && $order->bom) {
                                        $bomDetails = $order->bom->bomDetails ?? collect();

                                        foreach ($bomDetails as $bomDetail) {
                                            $qty = $bomDetail->quantity_used ?? 0;
                                            $price = $bomDetail->unit_price ?? 0;
                                            $totalBomCost += $qty * $price;
                                        }
                                    }

                                    $profit = $report->total_amount - $totalBomCost;
                                @endphp

                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>#INV-{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $order?->order_number ?? 'N/A' }}</td>
                                    <td>{{ $buyer?->first_name . ' ' . $buyer?->last_name ?? 'N/A' }}</td>
                                    <td>{{ $report->sale_date->format('d M, Y') }}</td>
                                    <td>${{ number_format($report->total_amount, 2) }}</td>
                                    <td>${{ number_format($totalBomCost, 2) }}</td>
                                    <td>${{ number_format($profit, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-4 text-center text-muted">No Sales found for the selected date range</p>
                @endif
                    <button class="mt-5 btn btn-primary" onclick="window.print()">Print Report</button>
               
            </div>
        </div>
    </div>
@endsection
