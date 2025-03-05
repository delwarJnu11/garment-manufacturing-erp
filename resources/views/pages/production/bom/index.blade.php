@extends('layout.backend.main');


@section('page_content')
    <x-message-banner />

    <x-page-header heading="Bill Of materials" btnText="BOM" href="{{ route('bom.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order ID</th>
                    <th>Buyer Name</th>
                    <th>Product Name</th>
                    @foreach ($sizes as $size)
                        <th>{{ $size->name }}(&#2547;)</th>
                    @endforeach
                    <th>Labour Cost</th>
                    <th>Overhead Cost</th>
                    <th>Utility Cost</th>
                    <th>Total Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($boms as $bom)
                    <tr>
                        <td>{{ $bom['order_id'] }}</td>
                        <td>{{ $bom['buyer_name'] }}</td>
                        <td>{{ $bom['product_name'] }}</td>
                        @foreach ($bom as $key => $value)
                            @if (Str::startsWith($key, 'size_'))
                                <td>{{ number_format(ceil($value), 2) }}</td>
                            @endif
                        @endforeach

                        <td>{{ number_format($bom['labour_cost'], 2) }}</td>
                        <td>{{ number_format($bom['overhead_cost'], 2) }}</td>
                        <td>{{ number_format($bom['utility_cost'], 2) }}</td>
                        <td>{{ number_format(ceil($bom['total_cost']), 2) }}</td>
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
