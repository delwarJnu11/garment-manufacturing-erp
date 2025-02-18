@extends('layout.backend.main')

@section('page_content')
    <div class="account-content">
        <div class="login-wrapper register-wrap" style="margin: 10px 0;">
            <div class="login-content"
                style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                {{-- <form action="{{ route('category.store') }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
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
                            <h4>Create New Category value</h4>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <label>Category Name</label>
                                <div class="form-addons">
                                    <input type="text" name="category_id" value="{{ old('category_id') }}" class="form-control">
                                    
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="form-login col-md-6">
                                <label>Category Type</label>
                                <div class="form-addons">
                                    <input type="text" class="form-control" name="category_type" value="{{ old('category_type') }}">
                                   
                                </div>
                                <x-input-error :messages="$errors->get('category_type')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <label>Category Attribute</label>
                                <div class="pass-group">
                                    <input type="text" class="pass-input" name="name" value="{{ old('name') }}">
                                   
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                          
                        </div>

                        <div class="form-login col-md-6">
                            <label> Attribute Value</label>
                            <div class="form-addons">
                                <input type="text" name="attribute_value" value="{{ old('attribute_value') }}" class="form-control">
                               
                            </div>
                            <x-input-error :messages="$errors->get('attribute_value')" class="mt-2" />
                        </div>
                        
                        
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Submit</button>
                        </div>
                        
                    </div>
                </form> --}}
                <tbody>
                    <tr><th>Id</th><td>{{$categoryattribute->id}}</td></tr>
                    <tr><th>Category Id</th><td>{{$categoryattribute->category_id}}</td></tr>
                    <tr><th>Category Type Id</th><td>{{$categoryattribute->category_type_id}}</td></tr>
                    <tr><th>Name</th><td>{{$categoryattribute->name}}</td></tr>
                    <tr><th>Attribute Value</th><td>{{$categoryattribute->attribute_value}}</td></tr>
                    <tr><th>Created At</th><td>{{$categoryattribute->created_at}}</td></tr>
                    <tr><th>Updated At</th><td>{{$categoryattribute->updated_at}}</td></tr>
            
            </tbody>

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
