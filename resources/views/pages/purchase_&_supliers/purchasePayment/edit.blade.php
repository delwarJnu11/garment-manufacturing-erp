@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        {{-- <x-page-header heading="Edit Payment - PO-{{ $purchaseOrder->id }}" /> --}}
                {{-- <x-page-header heading="Edit Payment - PO-{{ $purchaseOrder->id }}" btnText="Update Payment" /> --}}
                    <x-page-header heading="Edit Payment - PO-{{ $purchaseOrder->id }}" btnText="{{ $btnText }}" />
        <form action="{{ route('payments.update', $purchaseOrder->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="paid_amount">Paid Amount</label>
                <input type="number" name="paid_amount" id="paid_amount" class="form-control" 
                       value="{{ old('paid_amount', $purchaseOrder->paid_amount) }}" step="0.01" min="0" 
                       max="{{ $purchaseOrder->total_amount }}" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="Cash" {{ $purchaseOrder->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Bank Transfer" {{ $purchaseOrder->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="Credit Card" {{ $purchaseOrder->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Payment</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
