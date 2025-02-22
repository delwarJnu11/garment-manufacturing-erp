<div>
    <select name="statuses_id" id="statuses_id"  class="form-select">
        <option value="" >Select a Department </option>
        @foreach ($status as $data)
            <option value="{{ $data->id }}">{{ $data->name }}</option>
        @endforeach
    </select>
</div>
