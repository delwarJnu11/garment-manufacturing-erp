@extends('layout.backend.main')

@section('page_content')
    <h2 class="mb-2">Production Sweing Lists</h2>
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order No.</th>
                    <th>Total Qty (pcs)</th>
                    <th>Swen Completed</th>
                    <th>Actual Qty</th>
                    <th>Efficiency (%)</th>
                    <th>Wastage (pcs)</th>
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
                        <td>{{ $sweing->swen_complete }} (pcs)</td>
                        <td>{{ $sweing->actual_quantity }} (pcs)</td>
                        <td>
                            <div class="progress mt-2">
                                <div class="progress-bar efficiency-bar" role="progressbar" style="width: 0%;"
                                    data-efficiency="{{ round($sweing->efficiency) }}" aria-valuemin="0" aria-valuemax="100">
                                    0%
                                </div>
                            </div>
                        </td>
                        {{-- <td>{{ $sweing->efficiency ?? 0 }}</td> --}}
                        <td>{{ $sweing->wastage }} (pcs)</td>
                        <td>
                            <span class="badge badges-success">
                                {{ $sweing->sewing_status }}
                            </span>
                        </td>
                        <td class="action-table-data">
                            <button class="btn btn-secondary btn-check-qc"
                                data-work-order-id="{{ $sweing->work_order_id }}">
                                {{ $sweing->qc_exists ? 'QC Added' : 'Check QC' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-end p-3">
            {{ $sweings->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

@section('css')
    <style>
        .progress {
            background: #c1bebe;
            height: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .progress-bar {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            line-height: 25px;
            transition: width 1s ease-in-out;
        }

        .progress-bar.low {
            background: linear-gradient(to right, #f8452d77, #fc2727);
        }

        .progress-bar.medium {
            background: linear-gradient(to right, #ecbf0a, #ff9900);
        }

        .progress-bar.high {
            background: linear-gradient(to right, #20bb44, #016411);
        }
    </style>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bars = document.querySelectorAll('.efficiency-bar');

            bars.forEach(function(bar) {
                let efficiency = parseFloat(bar.dataset.efficiency) || 0;
                bar.style.width = efficiency + "%";
                bar.textContent = efficiency + "%";
                bar.setAttribute("aria-valuenow", efficiency);

                if (efficiency < 40) {
                    bar.classList.add("low");
                } else if (efficiency < 70) {
                    bar.classList.add("medium");
                } else {
                    bar.classList.add("high");
                }
            });
        });

        // Jquery
        $(function() {
            $('tbody').on('click', '.btn-check-qc', function() {
                const workOrderId = $(this).data('work-order-id');
                const button = $(this);

                $.ajax({
                    url: "{{ route('qc.store') }}",
                    method: "POST",
                    data: {
                        work_order_id: workOrderId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert("Something went wrong.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("Error occurred. Check console.");
                    }
                });
            })
        });
    </script>
@endsection
