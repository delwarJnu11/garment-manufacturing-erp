@extends('layout.backend.main')

@section('page_content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('buyers.update', $buyer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                value="{{ $buyer->first_name }}">
                        </div>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                value="{{ $buyer->last_name }}">
                        </div>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $buyer->email }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ $buyer->phone }}">
                        </div>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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
                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" name="country" id="country" class="form-control"
                                    value="{{ $buyer->country }}">
                            </div>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control" accept="image/*">

                                <!-- Display existing photo -->
                                @if ($buyer->photo && $buyer->photo !== 'default.png')
                                    <img src="{{ asset('uploads/buyers/' . $buyer->photo) }}" width="100" height="100"
                                        alt="Buyer Image" style="border-radius: 50%; margin-top: 10px;">
                                @else
                                    <img src="{{ asset('uploads/buyers/default.png') }}" width="100" height="100"
                                        alt="Default Buyer Image" style="border-radius: 50%; margin-top: 10px;">
                                @endif
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- Shipping Address -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Shipping Address <span
                                        class="text-danger">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3">{{ $buyer->shipping_address }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                        </div>

                        <!-- Billing Address -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="billing_address" class="form-label">Billing Address</label>
                                <textarea name="billing_address" id="billing_address" class="form-control" rows="3">{{ $buyer->billing_address }}</textarea>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Buyer</button>
                    </div>

            </form>
        </div>
    </div>
@endsection
