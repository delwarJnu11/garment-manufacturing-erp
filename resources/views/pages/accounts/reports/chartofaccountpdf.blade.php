<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart of Accounts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .group-header { background-color: #d3d3d3; font-weight: bold; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Garments Manufacturing ERP</h2>
    <h2 style="text-align: center;">Chart of Accounts</h2>
    

    <table class="table table-striped table-light w-75 mx-auto ">
        <thead>
            <tr>
                <th colspan="1">Account Code</th>
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

</body>
</html>
