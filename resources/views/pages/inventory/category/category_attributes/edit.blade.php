@extends('layout.backend.main')

@section('page_content')
    <div class="account-content">
        <div class="login-wrapper register-wrap" style="margin: 10px 0;">
            <div class="login-content"
                style="background-color: #fff; border-radius: 5px; box-shadow: 2px 2px 5px 2px #dedede;">
                <form action="{{ route('category.update',$category_attribute['id']) }}" method="POST" style="width: 100%;" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
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
                                    <input type="text" name="category_id" value="{{$category_attribute['category_id']}}" class="form-control">
                                    
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="form-login col-md-6">
                                <label>Category Type</label>
                                <div class="form-addons">
                                    <input type="text" class="form-control" name="category_type" value="{{$category_attribute['category_type_id']}}">
                                   
                                </div>
                                <x-input-error :messages="$errors->get('category_type')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-login col-md-6">
                                <label>Category Attribute</label>
                                <div class="pass-group">
                                    <input type="text" class="pass-input" name="name" value="{{$category_attribute['name']}}">
                                   
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                          
                        </div>

                        <div class="form-login col-md-6">
                            <label> Attribute Value</label>
                            <div class="form-addons">
                                <input type="text" name="attribute_value" value="{{$category_attribute['attribute_value']}}" class="form-control">
                               
                            </div>
                            <x-input-error :messages="$errors->get('attribute_value')" class="mt-2" />
                        </div>
                        

                        {{-- <div class="row">
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
