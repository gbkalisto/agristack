@extends('layouts.app')

@section('content')
    <div class="page-content">
        {{-- Stepper --}}
        @include('registry.partials.stepper', ['currentStep' => 1])
        <div class="card">
            <div class="card-header fw-bold">
                Step 1 of 6 – Basic Details
            </div>
            <form method="POST" action="#">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body p-4">

                        {{-- <h6 class="fw-bold text-primary mb-3">Edit Basic Details </h6> --}}

                        {{-- $user Name --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                $user Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter $user name"
                                    value="{{ old('name', $user->name) }}">
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
                                <input type="text" name="father_name" class="form-control"
                                    placeholder="Father / Husband name"
                                    value="{{ old('father_name', $user->father_name) }}">
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
                                    placeholder="10 digit mobile number" value="{{ old('mobile', $user->phone) }}">
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
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email address"
                                    value="{{ old('email', $user->email) }}">
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
                                <input type="text" name="aadhaar" class="form-control" placeholder="12 digit Aadhaar"
                                    value="{{ old('aadhaar', $user->aadhaar) }}">
                            </div>
                        </div>

                        {{-- DOB --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Date of Birth
                            </label>
                            <div class="col-sm-9">
                                <input type="date" name="dob" class="form-control"
                                    value="{{ old('dob', $user->dob) }}">
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
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                    <option value="other"
                                        {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other
                                    </option>
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
                                    <option value="SC"
                                        {{ old('category', $user->category) == 'SC' ? 'selected' : '' }}>SC
                                    </option>
                                    <option value="ST"
                                        {{ old('category', $user->category) == 'ST' ? 'selected' : '' }}>ST
                                    </option>
                                    <option value="OBC"
                                        {{ old('category', $user->category) == 'OBC' ? 'selected' : '' }}>OBC
                                    </option>
                                    <option value="General"
                                        {{ old('category', $user->category) == 'General' ? 'selected' : '' }}>General
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Full Address
                            </label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="2" class="form-control" placeholder="Complete address">{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>

                        {{-- District --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                District <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                                    <option value="">-- Select District --</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', $user->district_id) == $district->id ? 'selected' : '' }}>
                                            {{ ucfirst($district->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success px-4">
                                Save
                            </button>
                        </div>

                    </div>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>
@endsection
