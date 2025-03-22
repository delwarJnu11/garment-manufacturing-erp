@extends('layout.backend.main')
@section('page_content')

<div class="">
    <h1 class="my-4">Transactions</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Create New Transaction</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <!-- <th>Voucher Ref</th> -->
                <th>Transaction Date</th>
                <th>Account</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <!-- <td>{{ $transaction->voucher_ref }}</td> -->
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->account->name }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="text-end">{{ $transaction->debit>0? $transaction->debit: "" }}</td>
                    <td class="text-end">{{ $transaction->credit>0? $transaction->credit: "" }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection