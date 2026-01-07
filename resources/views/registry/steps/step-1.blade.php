@extends('layouts.app')

@section('content')
    <div class="page-content">
        {{-- Stepper --}}
        @include('registry.partials.stepper', ['currentStep' => 1])
        <div class="card">
            <div class="card-header fw-bold">
                Step 1 of 6 – Basic Details
            </div>
            <form method="POST" action="{{ route('basic.store') }}">
                @csrf
                <div class="card">
                    <div class="card-body p-4">


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                $user Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ old('name', optional($user)->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Father / Husband Name
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="father_name"
                                    value="{{ old('father_name', optional($user)->father_name) }}"
                                    class="form-control @error('father_name') is-invalid @enderror">
                                @error('father_name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Mobile Number <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{ old('phone', optional($user)->phone) }}"
                                    class="form-control @error('mobile') is-invalid @enderror">
                                @error('phone')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Email
                            </label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="{{ old('email', optional($user)->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Aadhaar Number
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="aadhaar" value="{{ old('aadhaar', optional($user)->aadhaar) }}"
                                    class="form-control @error('aadhaar') is-invalid @enderror">
                                @error('aadhaar')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Date of Birth
                            </label>
                            <div class="col-sm-9">
                                <input type="date" name="dob" value="{{ old('dob', optional($user)->dob) }}"
                                    class="form-control @error('dob') is-invalid @enderror">
                                @error('dob')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Gender
                            </label>
                            <div class="col-sm-9">
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">-- Select --</option>
                                    <option value="male"
                                        {{ old('gender', optional($user)->gender) == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', optional($user)->gender) == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                    <option value="other"
                                        {{ old('gender', optional($user)->other) == 'rainfed' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Category
                            </label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    <option value="SC"
                                        {{ old('category', optional($user)->category) == 'SC' ? 'selected' : '' }}>SC
                                    </option>
                                    <option value="ST"
                                        {{ old('category', optional($user)->category) == 'ST' ? 'selected' : '' }}>ST
                                    </option>
                                    <option value="OBC"
                                        {{ old('category', optional($user)->category) == 'OBC' ? 'selected' : '' }}>OBC
                                    </option>
                                    <option value="General"
                                        {{ old('category', optional($user)->category) == 'General' ? 'selected' : '' }}>
                                        General
                                    </option>
                                </select>
                                @error('category')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Full Address
                            </label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="2" class="form-control" placeholder="Complete address">{{ old('address', optional($user)->address) }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                District <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                                    <option value="">-- Select District --</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', optional($user)->district_id) == $district->id ? 'selected' : '' }}>
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
        </div>
    </div>
@endsection
