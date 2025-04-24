@extends('layout.backend.main')

<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-message-banner />
    <x-page-header href="{{ route('wastage.create') }}" heading="Wastage List" btnText="Wasatge" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table table-striped table-bordered">
                    <thead class="thead-primary">
                        <tr>
                            <th>Order Number</th>
                            <th>Product Name</th>
                            <th>Wastage Type</th>
                            <th>Sell Status</th>
                            <th>Section</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Created Date</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wastageProducts as $wastage)
                            <tr>
                                <td>{{ $wastage->order->order_number }}</td>
                                <td>{{ $wastage->product->name }}</td>
                                <td>{{ $wastage->wastageType->name }}</td>
                                <td>{{ $wastage->is_sellable ? 'Yes' : 'No' }}</td>
                                <td>{{ $wastage->section }}</td>
                                <td>{{ $wastage->quantity }} (pcs)</td>
                                <td>{{ $wastage->unit_price }}</td>
                                <td>{{ $wastage->unit_price * $wastage->quantity }}</td>
                                <td>{{ Carbon::parse($wastage->created_at)->format('d M, Y') }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <!-- Show -->
                                        <a class="me-2 p-2 mb-0" href="{{ route('wastage.show', $wastage->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a class="me-2 p-2" href="{{ route('wastage.edit', $wastage->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <x-delete action="{{ route('wastage.destroy', $wastage->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="5" class="text-danger">No wastage found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
