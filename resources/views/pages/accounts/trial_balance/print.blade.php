<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    @media Print{
        .trialController{
            display: none;
            visibility: hidden;
        }

    }
</style>
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center">Trial Balance of GMERP</h2>
    <h6 class="mb-4 text-center">From {{ $start_date }} to {{ $end_date }}</h6>


    <form method="GET" action="{{ route('accounts.trialbalance') }}" class="mb-3 trialController mx-auto">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $start_date }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $end_date }}">
            </div>
            <div class="col-md-4 text-end pt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('accounts.trial.balance.pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-danger ml-2">Print PDF</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered w-100 mx-auto">
                <thead class="table-dark">
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
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{ number_format($trialBalance->sum('total_debit'), 2) }}</th>
                        <th>{{ number_format($trialBalance->sum('total_credit'), 2) }}</th>
                        <th>{{ number_format($trialBalance->sum('balance'), 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>