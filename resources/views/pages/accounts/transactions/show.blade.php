@extends('layout.backend.main')
@section('page_content')
<div class="container my-5">
    <h2>Transaction Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Voucher Ref</th>
            <td>{{ $transaction->voucher_ref }}</td>
        </tr>
        <tr>
            <th>Transaction Date</th>
            <td>{{ $transaction->transaction_date }}</td>
        </tr>
        <tr>
            <th>Account ID</th>
            <td>{{ $transaction->account_id }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $transaction->amount }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $transaction->description }}</td>
        </tr>
        <tr>
            <th>Transaction Against</th>
            <td>{{ $transaction->transaction_against }}</td>
        </tr>
        <tr>
            <th>Debit</th>
            <td>{{ $transaction->debit }}</td>
        </tr>
        <tr>
            <th>Credit</th>
            <td>{{ $transaction->credit }}</td>
        </tr>
    </table>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection