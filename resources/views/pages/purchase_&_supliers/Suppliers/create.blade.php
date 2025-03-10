@extends('layout.backend.main')

@section('page_content')
    <x-page-header href="{{ route('suppliers.store') }}" heading="Add Supplier" btnText="Back to List" />

    <div class="card">
        <div class="card-body">
            <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label f class="form-label">Bank Account <span class="text-danger">*</span></label>
                                    <select name="bank_account_id" id="" class="form-select form-controll">
                                        @forelse ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}">
                                                {{ $bankAccount->name }}
                                            </option>
                                        @empty
                                            <option value="">No bank accounts available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- Photo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="photo" class="form-control"
                                        accept="image/*" required>
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
