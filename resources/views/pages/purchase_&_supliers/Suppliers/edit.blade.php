@extends('layout.backend.main')

@section('page_content')
    <x-page-header href="{{ route('suppliers.index') }}" heading="Edit Supplier" btnText="Back to List" />

    <div class="card">
        <div class="card-body">
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- This is to specify the update method -->

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $supplier->first_name) }}" required>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $supplier->last_name) }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $supplier->email) }}" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}" required>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', $supplier->address) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label f class="form-label">Bank Account <span class="text-danger">*</span></label>
                                <select name="bank_account_id" id="" class="form-select form-controll">
                                    @forelse ($bankAccounts as $bankAccount)
                                        <option value="{{ $bankAccount->id }}"
                                            {{ $buyer->bank_account_id == $bankAccount->id ? 'selected' : '' }}>
                                            {{ $bankAccount->name }}
                                        </option>
                                    @empty
                                        <option value="">No bank accounts available</option>
                                    @endforelse
                                </select>
    
                            </div>
                        </div>
                    </div>

                    <!-- Photo (optional) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                            <!-- Display existing photo -->
                            @if ($supplier->photo && $supplier->photo !== 'default.png')
                                <img src="{{ asset('uploads/suppliers/' . $supplier->photo) }}" width="100" height="100" alt="Supplier Image" style="border-radius: 50%; margin-top: 10px;">
                            @else
                                <img src="{{ asset('uploads/suppliers/default.png') }}" width="100" height="100" alt="Default Supplier Image" style="border-radius: 50%; margin-top: 10px;">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
