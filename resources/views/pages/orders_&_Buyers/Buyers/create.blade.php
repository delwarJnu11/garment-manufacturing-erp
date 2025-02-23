@extends('layout.backend.main')

@section('page_content')
{{-- <x-page-header href="{{ route('buyers.buyer') }}" heading="Add " btnText="Back to List" /> --}}

    <div class="card">
        <div class="card-body">
            <form action="{{ route('buyers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <span>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </span>
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
                    <!-- Country -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" name="country" id="country" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                <input type="file" name="photo" id="photo" class="form-control" accept="image/*"
                                    required>
                            </div>
                        </div>
                        <!-- Shiping Address -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label">Shipping Address <span
                                            class="text-danger">*</span></label>
                                    <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                            <!-- Shiping Address -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="billing_address" class="form-label">Billing Address <span
                                            class="text-danger">*</span></label>
                                    <textarea name="billing_address" id="billing_address" class="form-control" rows="3" required></textarea>
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
