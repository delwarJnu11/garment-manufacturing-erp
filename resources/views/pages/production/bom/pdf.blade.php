<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bill of Materials</title>
    <style>
        /* Bootstrap Styles (Minimal for PDF) */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .highlight {
            color: purple;
            font-weight: bold;
        }

        .section-title {
            background: #002855;
            color: #fff;
            padding: 10px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-end {
            text-align: right;
            font-weight: bold;
        }

        .size {
            font-weight: bold;
            background: #002855;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Bill Of Material for Order <span class="highlight">#{{ $order->order_number }}</span></h2>

        <table style="width: 100%; border-collapse: collapse;" border="0">
            <tr>
                <!-- Buyer Details -->
                <td style="width: 50%; vertical-align: top; padding: 10px;">
                    <h4 style="margin-bottom: 5px;">Buyer Details</h4>
                    <p><strong>Name:</strong> {{ $buyer->name }}</p>
                    <p><strong>Email:</strong> {{ $buyer->email }}</p>
                    <p><strong>Phone:</strong> {{ $buyer->phone }}</p>
                    <p><strong>Address:</strong> {{ $buyer->address }}</p>
                </td>

                <!-- Order Details -->
                <td style="width: 50%; vertical-align: top; padding: 10px;">
                    <h4 style="margin-bottom: 5px;">Order Details</h4>
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                    <p><strong>Delivery Date:</strong> {{ $order->delivery_date }}</p>
                    <p><strong>Current Date:</strong> {{ now()->format('d M, Y') }}</p>
                </td>
            </tr>
        </table>


        @foreach ($data as $sizeData)
            <h4 class="size">Size: {{ $sizeData['size'] }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Quantity Used</th>
                        <th>Unit Price</th>
                        <th>Wastage (%)</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizeData['materials'] as $material)
                        <tr>
                            <td>{{ $material['material_name'] }}</td>
                            <td>{{ $material['quantity_used'] }}</td>
                            <td>{{ $material['unit_price'] }}</td>
                            <td>{{ $material['wastage'] }}</td>
                            <td>{{ ceil($material['total_price']) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end">Operating Cost</td>
                        <td><strong>{{ ceil($bom->labour_cost + $bom->overhead_cost + $bom->utility_cost) }}</strong>
                        </td>
                    </tr>
                    <tr class="total-cost">
                        <td colspan="4" class="text-end">Total Cost for {{ $sizeData['size'] }}</td>
                        <td><strong>{{ ceil($sizeData['total_cost'] + $bom->labour_cost + $bom->overhead_cost + $bom->utility_cost) }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>

</body>

</html>
