@extends('layout.backend.main')
@section('page_content')

<div class="container my-5">
    <h2>Create Transaction</h2>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="voucher_ref" class="form-label">Voucher Reference</label>
            <input type="text" class="form-control" id="voucher_ref" name="voucher_ref" required>
        </div>

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Transaction Date</label>
            <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
        </div>

        <div class="mb-3">
            <label for="account_id" class="form-label">Account ID</label>
            <input type="number" class="form-control" id="account_id" name="account_id" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="transaction_against" class="form-label">Transaction Against</label>
            <input type="number" class="form-control" id="transaction_against" name="transaction_against">
        </div>

        <div class="mb-3">
            <label for="debit" class="form-label">Debit</label>
            <input type="number" step="0.01" class="form-control" id="debit" name="debit" value="0.00" required>
        </div>

        <div class="mb-3">
            <label for="credit" class="form-label">Credit</label>
            <input type="number" step="0.01" class="form-control" id="credit" name="credit" value="0.00" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection