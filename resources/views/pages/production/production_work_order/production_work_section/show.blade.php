@extends('layout.backend.main');


<?php use Carbon\Carbon; ?>
@section('page_content')
    <x-page-header href="{{ route('production_work_sections.create') }}" heading="Production Section Details View"
        btnText="Status" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Production Section Name</th>
                            <th>Created Date</th>
                            <th>Created Time</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                {{ $productionWorkSection->id }}
                            </td>
                            <td>{{ $productionWorkSection->name }}</td>
                            <td>{{ Carbon::parse($productionWorkSection->created_at)->format('d M, Y') }}</td>
                            <td>{{ Carbon::parse($productionWorkSection->created_at)->format('h.i A') }}</td>
                            <td class="action-table-data">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print"
                                    data-bs-original-title="Print"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-printer feather-rotate-ccw">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path
                                            d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                        </path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
