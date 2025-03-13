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
                        <td>{{ $sweing->target_quantity }} (pcs)</td>
                        <td>{{ $sweing->swen_complete }} (pcs)</td>
                        <td>{{ $sweing->actual_quantity }} (pcs)</td>
                        <td>
                            <div class="progress mt-2">
                                <div id="efficiency_progress" class="progress-bar" role="progressbar" style="width: 0%;"
                                    aria-valuenow={{ $sweing->efficiency }} aria-valuemin="0" aria-valuemax="100">
                                    0%
                                </div>
                            </div>
                        </td>
                        {{-- <td>{{ $sweing->efficiency ?? 0 }}</td> --}}
                        <td>{{ $sweing->wastage }} (pcs)</td>
                        <td>
                            <span class="badge badges-warning">
                                {{ $sweing->sewing_status }}
                            </span>
                        </td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href={{ route('sweing.edit', $sweing->id) }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-eye action-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a class="me-2 p-2" href={{ route('sweing.edit', $sweing->id) }}>
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

@section('css')
    <style>
        .progress {
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
            background: linear-gradient(to right, #ff0000, #f53d1d);
        }

        .progress-bar.medium {
            background: linear-gradient(to right, #ecbf0a, #ff9900);
        }

        .progress-bar.high {
            background: linear-gradient(to right, #28a745, #04fd6c);
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const efficiencyBar = document.getElementById('efficiency_progress');
            let efficiency = parseFloat(efficiencyBar.getAttribute('aria-valuenow')) || 0;

            // Update progress bar width
            efficiencyBar.style.width = efficiency + "%";
            efficiencyBar.setAttribute("aria-valuenow", efficiency);
            efficiencyBar.textContent = efficiency + "%";

            // Assign color class based on efficiency
            if (efficiency < 40) {
                efficiencyBar.classList.add("low");
            } else if (efficiency < 70) {
                efficiencyBar.classList.add("medium");
            } else {
                efficiencyBar.classList.add("high");
            }
        });
    </script>
@endsection
