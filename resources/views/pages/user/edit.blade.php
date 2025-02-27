@extends('layout.backend.main')

@section('page_content')
    <div class="account-content">
        <?php
            // echo '<pre>';
            // print_r($roles);
            // print_r($user);
            // die();
        ?>
        <div class="login-wrapper register-wrap" style="margin: 10px 0;">
            <div class="login-content"
                style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                <form action="{{ route('users.update', $user->id) }}" method="POST" style="width: 100%;">
                    @csrf
                    @method('PUT')
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <a href="index.html" class="login-logo logo-white">
                            <img src="assets/img/logo-white.png" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Update User</h3>
                            <h4>Update user's details Garments ERP Account</h4>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-12">
                                <label>Name</label>
                                <div class="form-addons">
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                    <img src="{{ asset('assets') }}/img/icons/user-icon.svg" alt="img">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-login col-md-12">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                    <img src="{{ asset('assets') }}/img/icons/mail.svg" alt="img">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">User Role</label>
                                    <select class="select form-control" name="role_id">
                                        <option>Select User Role</option>
                                        @forelse ($roles as $role)
                                            <option {{ $user->role_id === $role->id ? 'selected' : '' }}
                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                        @empty
                                            <option>No Role Found!</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <x-form-button>Update User</x-form-button>
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
