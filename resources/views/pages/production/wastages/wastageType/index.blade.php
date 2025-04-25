@extends('layout.backend.main')

<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-message-banner />
    <x-page-header href="{{ route('wastage-types.create') }}" heading="Wastage Types" btnText="Wasatge Type" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table table-striped table-bordered">
                    <thead class="thead-primary">
                        <tr>
                            <th>ID</th>
                            <th>Wastage Type Name</th>
                            <th>Created Date</th>
                            <th>Created Time</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wastageTypes as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ Carbon::parse($type->created_at)->format('d M, Y') }}</td>
                                <td>{{ Carbon::parse($type->created_at)->format('h.i A') }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <!-- Show -->
                                        <a class="me-2 p-2 mb-0" href="{{ route('wastage-types.show', $type->id) }}">
                                            <i data-feather="eye" class="feather-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a class="me-2 p-2" href="{{ route('wastage-types.edit', $type->id) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <x-delete action="{{ route('wastage-types.destroy', $type->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="5" class="text-danger">No type found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
