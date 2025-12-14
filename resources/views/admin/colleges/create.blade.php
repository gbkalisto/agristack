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
                        <li class="breadcrumb-item active" aria-current="page">Create New College</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.colleges.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="input49" class="col-sm-3 col-form-label">Enter College Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="input49" placeholder="College Name"
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

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="input49" class="col-sm-3 col-form-label">Domain Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('domain_name') border border-danger text-danger @enderror">
                                            <i class="bx bx-globe"></i>
                                        </span>
                                        <input type="text" class="form-control @error('domain_name') is-invalid @enderror"
                                            name="domain_name" id="input49" placeholder="Domain Name"
                                            value="{{ old('domain_name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>


                            {{-- Phone --}}
                            {{-- <div class="row mb-3">
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
                            </div> --}}



                            {{-- Profile Picture --}}
                            {{-- <div class="row mb-3">
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
                            </div> --}}

                            {{-- Password --}}
                            <div class="row mb-3">
                                <label for="input52" class="col-sm-3 col-form-label">Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('password') border border-danger text-danger @enderror">
                                            <i class="bx bx-lock-open"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="input52" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Password --}}
                            <div class="row mb-3">
                                <label for="input52" class="col-sm-3 col-form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('password_confirmation') border border-danger text-danger @enderror">
                                            <i class="bx bx-lock-open"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Active Checkbox --}}
                            {{-- <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_active" type="checkbox" value="1"
                                            id="input54" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="input54">Active the college</label>
                                    </div>
                                </div>
                            </div> --}}




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
