@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .details {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
        }

        .details div {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .thead-primary {
            background-color: grey;
            color: white;
        }

        .title {
            margin-bottom: 16px;
            text-align: center;
        }

        .text {
            color: purple;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="title">Order Invoice <strong class="text">#{{ $order->order_number }}</strong></h2>
        <table style="border: none; width: 100%; border-collapse: collapse;">
            <tr>
                <td style="border: none; padding: 10px;">
                    <h4 class="mb-2">Buyer Details</h4>
                    <p class="my-1"><strong>Name: </strong>{{ $buyer->first_name . ' ' . $buyer->last_name }}</p>
                    <p class="my-1"><strong>Email: </strong>{{ $buyer->email }}</p>
                    <p class="my-1"><strong>Phone: </strong>{{ $buyer->phone }}</p>
                    <p class="my-1"><strong>Address: </strong>{{ $buyer->shipping_address . ',' . $buyer->country }}
                    </p>
                </td>
                <td style="border: none; padding: 10px;">
                    <h4 class="mb-2">Order Details</h4>
                    <p class="my-1"><strong>Order Number: </strong>{{ $order->order_number }}</p>
                    <p class="my-1"><strong>Order Date:
                        </strong>{{ Carbon::parse($order->created_at)->format('d M, Y') }}</p>
                    <p class="my-1"><strong>Delivery Date:
                        </strong>{{ Carbon::parse($order->delivery_date)->format('d M, Y') }}</p>
                    <p class="my-1"><strong>Current Date: </strong>{{ Carbon::parse(now())->format('d M, Y') }}</p>
                </td>
            </tr>
        </table>

        <table>
            <thead class="thead-primary">
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($orderDetails as $detail)
                    @php
                        $sizeId = $detail->size->id;
                        $materialCost = $sizeData[$sizeId]['material_cost'] ?? 0;
                        $operatingCost = $sizeData[$sizeId]['operating_cost'] ?? 0;
                        $subTotal = ($materialCost + $operatingCost) * $detail->qty;
                        $total += $subTotal;
                    @endphp
                    <tr>
                        <td>{{ $detail->product->name ?? 'N/A' }}</td>
                        <td>{{ $detail->size->name ?? 'N/A' }}</td>
                        <td>{{ $detail->color->name ?? 'N/A' }}</td>
                        <td>{{ $detail->qty }} (pcs)</td>
                        <td>{{ $materialCost + $operatingCost ?? 0 }}</td>
                        <td>{{ number_format($subTotal, 2) }}</td>
                    </tr>
                @endforeach
                @php
                    $vat = $total * 0.05;
                @endphp
                <tr>
                    <td class="text-end" colspan="5">Total</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-end" colspan="5">Vat (5%)</td>
                    <td>{{ number_format($vat, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-end" colspan="5">Grand Total</td>
                    <td>{{ number_format($total + $vat, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
