@extends('admin.layouts.app')
@section('title', 'Create Admin User')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Admin User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="input49" class="col-sm-3 col-form-label">Enter User Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="input49" placeholder="User Name"
                                            value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label for="input51" class="col-sm-3 col-form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('email') border border-danger text-danger @enderror">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="input51" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="row mb-3">
                                <label for="input50" class="col-sm-3 col-form-label">Phone No <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('phone') border border-danger text-danger @enderror">
                                            <i class="bx bx-microphone"></i>
                                        </span>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="input50" placeholder="Phone No"
                                            value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="row mb-3">
                                <label for="inputAddress" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-map"></i></span>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
                                            placeholder="Address">{{ old('address') }}</textarea>
                                    </div>
                                    @error('address')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Profile Picture --}}
                            <div class="row mb-3">
                                <label for="input53" class="col-sm-3 col-form-label">Profile Picture</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('profile_picture') border border-danger text-danger @enderror">
                                            <i class="bx bx-image"></i>
                                        </span>
                                        <input type="file"
                                            class="form-control @error('profile_picture') is-invalid @enderror"
                                            name="profile_picture" id="input53">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    @error('profile_picture')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row mb-3">
                                <label for="input52" class="col-sm-3 col-form-label">Choose Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('password') border border-danger text-danger @enderror">
                                            <i class="bx bx-lock-open"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="input52" placeholder="Choose Password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Active Checkbox --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_active" type="checkbox" value="1"
                                            id="input54" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="input54">Active the user</label>
                                    </div>
                                </div>
                            </div>


                            {{-- Roles Checkbox Group --}}
                            <div class="row mb-3">
                                <label for="input52" class="col-sm-3 col-form-label">Roles <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($roles as $role)
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" name="roles[]"
                                                    value="{{ $role->name }}" id="role_{{ $role->id }}"
                                                    {{ (isset($admin) && $admin->hasRole($role->name)) || (is_array(old('roles')) && in_array($role->name, old('roles'))) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Show error --}}
                                    @error('roles')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{-- Submit Buttons --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        {{-- <button type="submit" class="btn btn-primary px-4">Submit</button> --}}
                                        <button type="submit"
                                            class="btn btn-primary submit-btn px-4 justify-content-center">
                                            <span class="submit-text">Submit</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"
                                                role="status" aria-hidden="true"></span>
                                        </button>
                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
