@extends('layout.backend.main');

@section('page_content')
    <x-message-banner />

    <x-page-header heading="Production Plans" btnText="Production Plan" href="{{ route('production-plans.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order Number</th>
                    <th>Production Line</th>
                    <th>Daily Target</th>
                    <th>Machines</th>
                    <th>Workers</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->order->order_number }}</td>
                        <td>{{ $plan->production_line }}</td>
                        <td>{{ $plan->daily_target }}</td>
                        <td>{{ $plan->allocated_machines }}</td>
                        <td>{{ $plan->allocated_workers }}</td>
                        <td>{{ $plan->start_date }}</td>
                        <td>{{ $plan->end_date }}</td>
                        <td>{{ $plan->status->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
