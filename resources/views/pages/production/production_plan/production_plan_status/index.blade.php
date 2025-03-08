@extends('layout.backend.main')

<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-page-header href="{{ route('production_plan_status.create') }}" heading="Production Status" btnText="Status" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table table-striped table-bordered">
                    <thead class="thead-primary">
                        <tr>
                            <th>ID</th>
                            <th>Production Status Name</th>
                            <th>Created Date</th>
                            <th>Created Time</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($production_plan_status as $status)
                            <tr>
                                <td>{{ $status->id }}</td>
                                <td>{{ $status->name }}</td>
                                <td>{{ Carbon::parse($status->created_at)->format('d M, Y') }}</td>
                                <td>{{ Carbon::parse($status->created_at)->format('h.i A') }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <!-- Show -->
                                        <a class="me-2 p-2 mb-0"
                                            href="{{ route('production_plan_status.show', $status->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a class="me-2 p-2" href="{{ route('production_plan_status.edit', $status->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <x-delete action="{{ route('production_plan_status.destroy', $status->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="5" class="text-danger">No status found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
