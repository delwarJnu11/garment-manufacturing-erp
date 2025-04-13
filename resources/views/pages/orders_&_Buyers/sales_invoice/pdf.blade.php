<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sales Invoice PDF</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 100%;
      margin: 0 auto;
    }
    .card {
      border: 1px solid #dee2e6;
      margin-top: 20px;
      background-color: #ffffff;
    }
    .card-header {
      background-color: #007bff;
      color: white;
      padding: 10px;
      font-size: 20px;
      text-align: center;
    }
    .card-body {
      padding: 20px;
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .table th, .table td {
      padding: 8px;
      text-align: left;
      border: 1px solid #dee2e6;
    }
    .badge {
      padding: 5px 10px;
      border-radius: 5px;
      background-color: #ffc107;
      color: white;
    }
    .text-end {
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3>Sales Invoice Details</h3>
      </div>
      <div class="card-body">
        <div style="width: 50%; float: left;">
          <h5>Order Details:</h5>
          <p><strong>Order Number:</strong> 
            @foreach ($salesInvoice->salesInvoiceDetails as $details )
              
            @endforeach
            {{ $details->order->order_number ?? 'N/A' }}</p>
          <p><strong>Name:</strong> {{ $salesInvoice->buyer->first_name . ' ' . $salesInvoice->buyer->last_name ?? 'N/A' }}</p>
        </div>
        <div style="width: 50%; float: right; text-align: right;">
          <h5>Invoice Details:</h5>
          <p><strong>Invoice ID:</strong> #INV-{{ str_pad($salesInvoice->id, 6, '0', STR_PAD_LEFT) }}</p>
          <p><strong>Sale Date:</strong> {{ $salesInvoice->sale_date->format('d M, Y') ?? 'N/A' }}</p>
          <p><strong>Status:</strong> <span class="badge">{{ $salesInvoice->invoice_status->name ?? 'N/A' }}</span></p>
        </div>
        <div style="clear: both; padding-top: 20px;"></div>
        <h5>Product Details</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Size</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>VAT</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($salesInvoice->salesInvoiceDetails ?? [] as $item)
              <tr>
                <td>{{ optional($item->order->orderDetails->first()->product)->name ?? 'N/A' }}</td>
                <td>@foreach ($item->order->orderDetails as $detail) {{ $detail->size->name ?? 'N/A' }} @endforeach</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->vat, 2) }}</td>
                <td>{{ number_format($item->discount, 2) }}</td>
                <td>{{ number_format(($item->unit_price * $item->qty) - $item->discount, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div style="clear: both; padding-top: 20px;"></div>
        <div style="width: 50%; float: left;">
          <p><strong>Total Amount:</strong> {{ number_format($salesInvoice->total_amount, 2) }}</p>
          <p><strong>Paid Amount:</strong> {{ number_format($salesInvoice->paid_amount, 2) }}</p>
        </div>
        <div style="width: 50%; float: right; text-align: right;">
          <h4>Total: {{ number_format($salesInvoice->total_amount, 2) }}</h4>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
