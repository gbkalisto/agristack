<form method="POST" action="{{ route('admin.farmers.update.basic', $farmer->id) }}">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body p-4">

            <h6 class="fw-bold text-primary mb-3">Edit Basic Details </h6>

            {{-- Farmer Name --}}
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Farmer Name <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter farmer name" value="{{ old('name', $farmer->name) }}">
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
                    <input type="text" name="father_name" class="form-control" placeholder="Father / Husband name"
                        value="{{ old('father_name', $farmer->father_name) }}">
                </div>
            </div>

            {{-- Mobile --}}
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Mobile Number <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                        placeholder="10 digit mobile number" value="{{ old('mobile', $farmer->phone) }}">
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
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email address" value="{{ old('email', $farmer->email) }}">
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
                        value="{{ old('aadhaar', $farmer->aadhaar) }}">
                </div>
            </div>

            {{-- DOB --}}
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Date of Birth
                </label>
                <div class="col-sm-9">
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $farmer->dob) }}">
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
                        <option value="male" {{ old('gender', $farmer->gender) == 'male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="female" {{ old('gender', $farmer->gender) == 'female' ? 'selected' : '' }}>
                            Female
                        </option>
                        <option value="other" {{ old('gender', $farmer->gender) == 'other' ? 'selected' : '' }}>Other
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
                        <option value="SC" {{ old('category', $farmer->category) == 'SC' ? 'selected' : '' }}>SC
                        </option>
                        <option value="ST" {{ old('category', $farmer->category) == 'ST' ? 'selected' : '' }}>ST
                        </option>
                        <option value="OBC" {{ old('category', $farmer->category) == 'OBC' ? 'selected' : '' }}>OBC
                        </option>
                        <option value="General"
                            {{ old('category', $farmer->category) == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                </div>
            </div>

            {{-- Address --}}
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Full Address
                </label>
                <div class="col-sm-9">
                    <textarea name="address" rows="2" class="form-control" placeholder="Complete address">{{ old('address', $farmer->address) }}</textarea>
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
                                {{ old('district_id', $farmer->district_id) == $district->id ? 'selected' : '' }}>
                                {{ ucfirst($district->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('district_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    <h6 class="mb-0">Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="input-group-text" id="basic-addon2"><i class='bx bx-hide'
                                id="togglePassword"></i></span>
                    </div>
                    <small class="text-danger">leave blank if you do not want to update</small>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-success px-4">
                    Update & Continue
                </button>
            </div>

        </div>
    </div>
</form>
@push('scripts')
    <script>
        $("#togglePassword").click(function(e) {
            e.preventDefault();
            const passwordField = $(this).closest('.input-group').find('input');
            const icon = $(this);

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('bx-hide').addClass('bx-show');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bx-show').addClass('bx-hide');
            }
        })
    </script>
@endpush
