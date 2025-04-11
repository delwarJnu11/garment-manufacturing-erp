@extends('layout.backend.main')

@section('page_content')
    <div class="account-content">
        <div class="login-wrapper register-wrap" style="margin: 10px 0;">
            <div class="login-content"
                style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                <form action="{{ route('product_types.store') }}" method="POST" style="width: 100%;" >
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <a href="index.html" class="login-logo logo-white">
                            <img src="assets/img/logo-white.png" alt="">
                        </a>
                        <div class="login-userheading">
                            <h4>Create New Product type</h4>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-12">
                                <div class="form-addons">
                                    <div class="mb-3">
                                        <label class="form-label">Product Type name</label>
                                       <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        {{-- <div class="form-login col-md-12">
                            <label> Category Type</label>
                            <div class="form-addons">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                               
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div> --}}
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Submit</button>
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
