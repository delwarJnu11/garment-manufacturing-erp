@extends('layout.backend.main')

@section('page_content')
    <div class="account-content">
        <div class="login-wrapper register-wrap" style="margin: 10px 0;">
            <div class="login-content"
                style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                <form action="{{ route('users.store') }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <a href="index.html" class="login-logo logo-white">
                            <img src="assets/img/logo-white.png" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Register</h3>
                            <h4>Create New Garments ERP Account</h4>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <label>Name</label>
                                <div class="form-addons">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    <img src="{{ asset('assets') }}/img/icons/user-icon.svg" alt="img">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-login col-md-6">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                    <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password" value="{{ old('password') }}">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-login col-md-6">
                                <label>Confirm Passworrd</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-inputs" name="password_confirmation" required
                                        autocomplete="new-password">
                                    <span class="fas toggle-passwords fa-eye-slash"></span>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">User Role</label>
                                    <select class="select form-control" name="role_id">
                                        <option>Select User Role</option>
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @empty
                                            <option>No Role Found!</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-login">
                                <label>Upload Image</label>
                                <input style="padding: 8px 0" type="file" name="image" class="form-control">
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="custom-control custom-checkbox justify-content-start">
                                        <div class="custom-control custom-checkbox">
                                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>I agree to the <a href="#"
                                                    class="hover-a">Terms &amp; Privacy</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Register User</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="customizer-links" id="setdata">
        <ul class="sticky-sidebar">
            <li class="sidebar-icons">
                <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-original-title="Theme">
                    <i data-feather="settings" class="feather-five"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection
