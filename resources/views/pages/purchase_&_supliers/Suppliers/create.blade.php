@extends('layout.backend.main')

@section('page_content')
    <x-page-header href="{{ route('suppliers.index') }}" heading="Add Supplier" btnText="Back to List" />

    <div class="card">
        <div class="card-body">

            {{-- Global error alert --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Please fix the following errors:
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Bank Account -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bank_account_id" class="form-label">Bank Account <span
                                            class="text-danger">*</span></label>
                                    <select name="bank_account_id" id="bank_account_id" class="form-select">
                                        @forelse ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}"
                                                {{ old('bank_account_id') == $bankAccount->id ? 'selected' : '' }}>
                                                {{ $bankAccount->name }}
                                            </option>
                                        @empty
                                            <option value="">No bank accounts available</option>
                                        @endforelse
                                    </select>
                                    @error('bank_account_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Photo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="photo" class="form-control"
                                        accept="image/*" required>
                                    @error('photo')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Supplier</button>
                </div>
            </form>
        </div>
    </div>
@endsection
