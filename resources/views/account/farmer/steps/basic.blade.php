@extends('account.layouts.app')
@section('title', 'Create Farmer')

@section('content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('account.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('account.farmers.index') }}">Farmers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create Farmer
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <a href="{{ route('account.farmers.index') }}" class="btn btn-secondary btn-sm">
                    Back to list
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <form method="POST" action="{{ route('account.farmers.store.basic') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body p-4">

                            <!-- ================= BASIC DETAILS ================= -->
                            <h6 class="mb-3 text-primary fw-bold">
                                Farmer Basic Details
                            </h6>

                            {{-- Farmer Name --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Farmer Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter farmer name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Father Name --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Father / Husband Name
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror"
                                        placeholder="Father / Husband name" value="{{ old('father_name') }}">
                                </div>
                            </div>

                            {{-- Mobile --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Mobile Number <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        placeholder="10 digit mobile number" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Email
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email address" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Aadhaar --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Aadhaar Number
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="aadhaar" class="form-control @error('aadhaar') is-invalid @enderror" placeholder="12 digit Aadhaar"
                                        value="{{ old('aadhaar') }}">
                                </div>
                            </div>

                            {{-- DOB --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Date of Birth
                                </label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                                </div>
                            </div>

                            {{-- Gender --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Gender
                                </label>
                                <div class="col-sm-9">
                                    <select name="gender" class="form-control">
                                        <option value="">-- Select Gender --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Category
                                </label>
                                <div class="col-sm-9">
                                    <select name="category" class="form-control">
                                        <option value="">-- Select Category --</option>
                                        <option value="SC" {{ old('category') == 'SC' ? 'selected' : '' }}>SC</option>
                                        <option value="ST" {{ old('category') == 'ST' ? 'selected' : '' }}>ST</option>
                                        <option value="OBC" {{ old('category') == 'OBC' ? 'selected' : '' }}>OBC</option>
                                        <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Full Address
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="address" rows="2" class="form-control" placeholder="Complete address">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            {{-- District --}}
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label">
                                    District <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="district_id"
                                        class="form-control @error('district_id') is-invalid @enderror">
                                        <option value="">-- Select District --</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                                {{ ucfirst($district->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- ================= TRACKING ================= -->
                            <input type="hidden" name="filled_by" value="admin">

                            <!-- ================= BUTTONS ================= -->
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary px-4">
                                            Save & Continue
                                        </button>
                                        <button type="reset" class="btn btn-light px-4">
                                            Reset
                                        </button>
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
