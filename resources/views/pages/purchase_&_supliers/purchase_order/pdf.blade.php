<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Invoice</h1>
    <p><strong>Invoice ID:</strong> #INV-{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</p>
    <p><strong>Purchase Date:</strong> {{ $invoice->purchase_date }}</p>
    <p><strong>Supplier:</strong> {{ $invoice->inv_supplier->first_name }} {{ $invoice->inv_supplier->last_name }}</p>
    <p><strong>Shipping Address:</strong> {{ $invoice->shipping_address }}</p>
    <p><strong>Notes:</strong> {{ $invoice->description }}</p>

    <h3>Product Details</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>VAT</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->purchaseDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>${{ number_format($detail->price, 2) }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ $detail->discount }}%</td>
                <td>{{ $detail->vat }}%</td>
                <td>
                    ${{ number_format(
                        ($detail->price * $detail->quantity) - 
                        ($detail->discount / 100 * $detail->price * $detail->quantity) +
                        ($detail->vat / 100 * $detail->price * $detail->quantity),
                        2
                    ) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="total">Total: ${{ number_format($invoice->total_amount, 2) }}</h3>
    <h5 class="total">Paid: ${{ number_format($invoice->paid_amount, 2) }}</h5>
    <h5 class="total">Grand Total: ${{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }}</h5>
</body>
</html>
