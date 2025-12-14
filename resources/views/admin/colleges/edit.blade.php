@extends('admin.layouts.app')
@section('title', 'Edit Admin User')

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
                        <li class="breadcrumb-item active" aria-current="page">Edit College</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.colleges.update', $college) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($college->id))
                            @method('PUT')
                        @endif

                        <div class="card-body p-4">

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="input49" class="col-sm-3 col-form-label">Enter College Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="input49" placeholder="College Name"
                                            value="{{ old('name', $college->name ?? '') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label for="input51" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('email') border border-danger text-danger @enderror">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="input51" placeholder="Email"
                                            value="{{ old('email', $college->email ?? '') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Domains --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Domain Name(s) <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    @forelse($college->domains as $index => $domain)
                                        <div class="input-group mb-2">
                                            <span
                                                class="input-group-text @error("domains.$index.domain") border border-danger text-danger @enderror">
                                                <i class="bx bx-globe"></i>
                                            </span>
                                            <input type="text" name="domains[{{ $index }}][domain]"
                                                class="form-control @error("domains.$index.domain") is-invalid @enderror"
                                                value="{{ old("domains.$index.domain", $domain->domain) }}"
                                                placeholder="Domain Name">
                                        </div>
                                    @empty
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="bx bx-globe"></i>
                                            </span>
                                            <input type="text" name="domains[0][domain]" class="form-control"
                                                placeholder="Domain Name">
                                        </div>
                                    @endforelse

                                    {{-- Optional: Empty input to add new domain --}}
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-plus"></i>
                                        </span>
                                        <input type="text" name="domains[{{ count($college->domains) }}][domain]"
                                            class="form-control" placeholder="Add another domain (optional)">
                                    </div>

                                    @error('domains.*.domain')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>


                            {{-- Password (optional in edit) --}}
                            <div class="row mb-3">
                                <label for="input52" class="col-sm-3 col-form-label">Password</label>
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
                                            class="input-group-text @error('password') border border-danger text-danger @enderror">
                                            <i class="bx bx-lock-open"></i>
                                        </span>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="input52" placeholder="Confirm Password">
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
                                            id="input54"
                                            {{ old('is_active', $college->is_active ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="input54">Activate the user</label>
                                    </div>
                                </div>
                            </div> --}}


                            {{-- Submit Buttons --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit"
                                            class="btn btn-primary submit-btn px-4 justify-content-center">
                                            <span class="submit-text">Update</span>
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
