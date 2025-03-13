<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trial Balance ({{ $start_date }} to {{ $end_date }})</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .table-secondary { background-color: #d3d3d3; font-weight: bold; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Trial Balance ({{ $start_date }} to {{ $end_date }})</h2>

    <table>
        <thead>
            <tr>
                <th>Account Code</th>
                <th>Account Name</th>
                <th>Total Debit</th>
                <th>Total Credit</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trialBalance as $account)
                <tr>
                    <td>{{ $account->code }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ number_format($account->total_debit, 2) }}</td>
                    <td>{{ number_format($account->total_credit, 2) }}</td>
                    <td>{{ number_format($account->balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
