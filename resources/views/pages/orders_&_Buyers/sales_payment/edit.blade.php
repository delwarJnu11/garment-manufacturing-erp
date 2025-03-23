@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="row">
        <div class="card flex-fill">
            <x-page-header heading="Edit Payment - PO-{{ $salesInvoice->id }}" btnText="{{ $btnText }}" />

            <form action="{{ route('payments.update', $salesInvoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="paid_amount">Paid Amount</label>
                    <input type="number" name="paid_amount" id="paid_amount" class="form-control"
                           value="{{ old('paid_amount', $salesInvoice->paid_amount) }}" step="0.01" min="0"
                           max="{{ $salesInvoice->total_amount }}" required>
                </div>

                <div class="form-group">
                    <label for="payment_method_id">Payment Method</label>
                    <select name="payment_method_id" id="payment_method_id" class="form-control">
                        <option value="">Select Method</option>
                        @foreach ($salesPayments as $salesPayment)
                            @if (isset($salesPayment->payment_method->name))
                                <option value="{{ $salesPayment->payment_method->id }}" 
                                    {{ old('payment_method_id', $salesInvoice->payment_method_id) == $salesPayment->payment_method->id ? 'selected' : '' }}>
                                    {{ $salesPayment->payment_method->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Payment</button>
                <a href="{{ url('salesPayments') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
