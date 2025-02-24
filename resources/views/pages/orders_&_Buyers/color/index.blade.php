@extends('layout.backend.main')

<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-page-header href="{{ route('colors.create') }}" heading="Color Name" btnText="Color Name" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Created Date</th>
                            <th>Created Time</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ Carbon::parse($color->created_at)->format('d M, Y') }}</td>
                                <td>{{ Carbon::parse($color->created_at)->format('h.i A') }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <!-- Show -->
                                        <a class="me-2 p-2 mb-0" href="{{ route('colors.show', $color->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a class="me-2 p-2" href="{{ route('colors.edit', $color->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <x-delete action="{{ route('colors.destroy', $color->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="5" class="text-danger">No color found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
