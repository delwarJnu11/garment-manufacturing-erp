@extends('layout.backend.main');

@section('page_content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        use Carbon\Carbon;
    @endphp
    <x-message-banner />
    <x-page-header heading="Packaging" btnText="Packaging" href="{{ route('packaging.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order No.</th>
                    <th>Product Name</th>
                    <th>Manager</th>
                    <th>Total Qty (pcs)</th>
                    <th>Completed (pcs)</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packageItems as $item)
                    <tr>
                        <td>{{ $item->order->order_number }}
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->total_quantity }} (pcs)</td>
                        <td>{{ $item->packaged_quantity }} (pcs)</td>
                        <td>{{ Carbon::parse($item->packaging_end)->format('d F, Y') }}</td>
                        <td>
                            <span class="badge badges-warning">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <!-- Show -->
                                <a class="me-2 p-2 mb-0" href="{{ route('packaging.show', $item->id) }}">
                                    <i data-feather="eye" class="feather-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a class="me-2 p-2" href="{{ route('packaging.edit', $item->id) }}">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>

                                <!-- Delete -->
                                <x-delete action="{{ route('packaging.destroy', $item->id) }}" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-danger" colspan="9">No Packaging Items Found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
