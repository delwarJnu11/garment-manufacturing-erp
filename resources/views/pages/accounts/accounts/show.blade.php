@extends('layout.backend.main')
@section('css')
<style>
    @media Print{
        .ledger{
            display: none;
            visibility: hidden;
        }
    }
</style>

@endsection
@section('page_content')
<div class="row">
		<div class="card">
		<div class="card-body">
			<form action="{{ url('ledgers') }}" method ="get" enctype="multipart/form-data" class="ledger">
				@csrf
				<div class="row">
				<div class="col-sm-4">
				
					<select class="form-control" name="account_id" id="account_id">
						@foreach ($accounts??[] as $account)
							<option value="{{ $account->id }}">{{ $account->code }}-{{ $account->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-3">
					<input class="form-control" type="date" name="start_date">
				</div>
				<div class="col-sm-3">
					<input class="form-control" type="date" name="end_date">
				</div>
			
				<div class="col-sm-2">
					<button class="btn btn-primary" type="submit">Generate</button>
				</div>
			</div>
			</form>

            
		</div>
		</div>
	</div>
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
            <h1 class="text-center">Ledger</h1>

                <table class='table table-striped text-nowrap'>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Naretion</th>
                            <th>Dabit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php

                            $debit = 0;
                            $credit = 0;
                        @endphp
                        @forelse ($transactions??[] as $item)
                            <tr>
                                <td>{{ $item->transaction_date }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->debit }}</td>
                                <td>{{ $item->credit }}</td>
                            </tr>
                            @php
                                $debit += $item->debit;
                                $credit += $item->credit;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="4">Data Not found</td>
                            </tr>
                        @endforelse
                        @php
                            $closing_balance = $debit - $credit;
                        @endphp
                        <tr>
                            <td></td>
                            <td>Closing Balance </td>
                            <td>{{ $closing_balance > 0 ? $closing_balance : 0.0 }}</td>
                            <td>{{ $closing_balance < 0 ? abs($closing_balance) : 0.0 }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection