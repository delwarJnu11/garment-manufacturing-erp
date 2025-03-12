@extends('layout.backend.main')

@section('page_content')
    <h2>Production Sweing Lists</h2>
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order No.</th>
                    <th>Total Qty (pcs)</th>
                    <th>Target Qty (pcs)</th>
                    <th>Actual Qty</th>
                    <th>Wastage (pcs)</th>
                    <th>Efficiency (%)</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sweings as $sweing)
                    <tr>
                        <td>{{ $sweing->workOrder && $sweing->workOrder->order ? $sweing->workOrder->order->order_number : 'N/A' }}
                        </td>
                        <td id="qty">{{ $sweing->total_quantity }} (pcs)</td>
                        <td>{{ $sweing->target_quantity }} (pcs)</td>
                        <td>{{ $sweing->actual_quantity }} (pcs)</td>
                        <td>{{ $sweing->wastage }} (pcs)</td>
                        <td>{{ $sweing->efficiency ?? 0 }}</td>
                        <td>{{ $sweing->sewing_start_date }}</td>
                        <td>
                            <span class="badge badges-warning">
                                {{ $sweing->sewing_status }}
                            </span>
                        </td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="{{ route('sweing.edit') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-eye action-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a class="me-2 p-2" href="">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>
                                <x-delete />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
