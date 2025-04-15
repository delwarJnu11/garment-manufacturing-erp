@extends('layout.backend.main')
@section('title','Create Transaction')
@section('css')


@endsection
@section('page_content')
<a class='btn btn-success' href="{{route('transactions.index')}}">Manage</a>
<form action="{{route('transactions.store')}}" method ="post" enctype="multipart/form-data">
@csrf
<div class="row mb-3">
            <label for="voucher_ref" class="col-sm-2 col-form-label">Voucher Ref</label>
            <div class="col-sm-4">
                <input type = "text" class="form-control" name="voucher_ref" id="voucher_ref" placeholder="Voucher Ref">
            </div>

            <label for="transaction_date" class="col-sm-2 col-form-label">Transaction Date</label>
            <div class="col-sm-4">
                <input type = "date" class="form-control" name="transaction_date" id="transaction_date"
                    placeholder="Transaction Date">
            </div>
        </div>

		{{--  first Account --}}
        <div class="row mb-3">
            <label for="account_id" class="col-sm-2 col-form-label">Account</label>
            <div class="col-sm-2">
                <select class="form-control" name="account_id" id="account_id">
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->code }}-{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <label for="description" class="col-sm-1 col-form-label">Naretion</label> --}}
            <div class="col-sm-2">
                <input class="form-control" name="description" id="description" placeholder="Naretion" />
            </div>


            {{-- <label for="debit" class="col-sm-1 col-form-label">Debit</label> --}}
            <div class="col-sm-2">
                <input type = "text" class="form-control" name="debit" id="debit" placeholder="Debit">
            </div>

            {{-- <label for="credit" class="col-sm-1 col-form-label">Credit</label> --}}
            <div class="col-sm-2">
                <input type = "text" class="form-control" name="credit" id="credit" placeholder="Credit">
            </div>
        </div>
		{{--  second Account --}}
        <div class="row mb-3">
            <label for="account_id" class="col-sm-2 col-form-label">Account</label>
            <div class="col-sm-2">
                <select class="form-control" name="transaction_against_id" id="account_id">
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->code }}-{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <label for="description" class="col-sm-1 col-form-label">Naretion</label> --}}
            <div class="col-sm-2">
                <input class="form-control" name="t_a_description" id="description" placeholder="Naretion" />
            </div>


            {{-- <label for="debit" class="col-sm-1 col-form-label">Debit</label> --}}
            <div class="col-sm-2">
                <input type = "text" class="form-control" name="t_a_debit" id="debit" placeholder="Debit">
            </div>

            {{-- <label for="credit" class="col-sm-1 col-form-label">Credit</label> --}}
            <div class="col-sm-2">
                <input type = "text" class="form-control" name="t_a_credit" id="credit" placeholder="Credit">
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
@section('script')


@endsection
