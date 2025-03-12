@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />
    <x-page-header heading="Production Cutting" btnText="Cutting Section"
        href="{{ route('production-work-orders.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order No.</th>
                    <th>Total Qty</th>
                    <th>Fabrics Used (m)</th>
                    <th>Wastage (m)</th>
                    <th>Target Qty</th>
                    <th>Actual Qty</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuttingOrders as $cutting)
                    <tr>
                        <td>{{ $cutting->workOrder && $cutting->workOrder->order ? $cutting->workOrder->order->order_number : 'N/A' }}
                        </td>
                        <td id="qty">{{ $cutting->total_quantity }} (pcs)</td>
                        <td>{{ $cutting->total_fabric_used }} (m)</td>
                        <td>{{ $cutting->wastage }} (m)</td>
                        <td>{{ $cutting->target_quantity }} (pcs)</td>
                        <td>{{ $cutting->actual_quantity }} (pcs)</td>
                        <td>{{ $cutting->cutting_start_date }}</td>
                        <td>
                            <span class="badge badges-warning">
                                {{ $cutting->cutting_status }}
                            </span>
                        </td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-eye action-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a id="approved" class="me-2 p-2" data-cutting-id="{{ $cutting->id }}"
                                    data-work-order-id="{{ $cutting->work_order_id }}">
                                    <i data-feather="check" class="feather-edit" style="font-size: 20px; color: green"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#approved').on('click', function() {
                const cutting_id = $(this).data('cutting-id');
                const work_order_id = $(this).data('work-order-id');
                const actual_quantity = parseInt($('#qty').text());

                // console.log(cutting_id, work_order_id, actual_quantity)

                const url = "{{ url('/api/production-stages/cutting/update-status') }}/" + cutting_id;
                // console.log(url)

                $.ajax({
                    url: url,
                    type: "PUT",
                    contentType: "application/json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: JSON.stringify({
                        actual_quantity: actual_quantity,
                        work_order_id: work_order_id
                    }),
                    success: function(response) {
                        window.location.assign("{{ route('cutting.completed') }}");
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Error updating Cutting information");
                    }
                });
            });

        })
    </script>
@endsection
