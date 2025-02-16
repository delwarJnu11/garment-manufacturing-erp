@if ($status->id == 1)
    <span class="badge badge-success">{{ $status->name }}</span>
@else
    <span class="badge badge-danger">{{ $status->name }}</span>
@endif
