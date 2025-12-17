@extends('admin.layouts.app')
@section('title', 'Create Admin Account')

@section('content')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create Admin Account
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <form action="{{ route('admin.accounts.store') }}" method="POST">
                        @csrf

                        <div class="card-body p-4">

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text @error('name') border-danger text-danger @enderror">
                                            <i class="bx bx-user"></i>
                                        </span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Full Name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Username --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('user_name') border-danger text-danger @enderror">
                                            <i class="bx bx-id-card"></i>
                                        </span>
                                        <input type="text" name="user_name"
                                            class="form-control @error('user_name') is-invalid @enderror"
                                            placeholder="Enter Username" value="{{ old('user_name') }}">
                                    </div>
                                    @error('user_name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text @error('email') border-danger text-danger @enderror">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Phone <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text @error('mobile') border-danger text-danger @enderror">
                                            <i class="bx bx-phone"></i>
                                        </span>
                                        <input type="tel" name="mobile"
                                            class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}"
                                            pattern="[0-9]{10}"
                                                    maxlength="10" placeholder="Enter 10-digit mobile number"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('mobile')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('password') border-danger text-danger @enderror">
                                            <i class="bx bx-lock"></i>
                                        </span>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter Password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Role --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    Role <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="role" id="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                        <option value="">-- Select Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="division_admin">Division Admin</option>
                                        <option value="district_admin">District Admin</option>
                                        <option value="block_admin">Block Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Division --}}
                            <div class="row mb-3 location division d-none">
                                <label class="col-sm-3 col-form-label">Division</label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id" class="form-control">
                                        <option value="">-- Select Division --</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>

                            {{-- District --}}
                            <div class="row mb-3 location district d-none">
                                <label class="col-sm-3 col-form-label">District</label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control"></select>
                                    @error('district_id')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Block --}}
                            <div class="row mb-3 location block d-none">
                                <label class="col-sm-3 col-form-label">Block</label>
                                <div class="col-sm-9">
                                    <select name="block_id" id="block_id" class="form-control"></select>
                                    @error('block_id')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Submit --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid gap-3">
                                        <button type="submit" class="btn btn-primary submit-btn px-4">
                                            <span class="submit-text">Submit</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"></span>
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
{{-- @push('scripts')
    <script>
        $(document).ready(function() {

            function resetLocations() {
                $('.location').addClass('d-none');
                $('#division_id').val('');
                $('#district_id').empty();
                $('#block_id').empty();
            }

            // Role change handler
            $('#role').on('change', function() {
                let role = $(this).val();
                resetLocations();

                if (role === 'division_admin') {
                    $('.division').removeClass('d-none');
                }

                if (role === 'district_admin') {
                    $('.division, .district').removeClass('d-none');
                }

                if (role === 'block_admin') {
                    $('.division, .district, .block').removeClass('d-none');
                }
            });

            // When Division changes → fetch Districts
            $('#division_id').on('change', function() {
                let divisionId = $(this).val();
                $('#district_id').html('<option value="">Loading...</option>');
                $('#block_id').empty();

                if (!divisionId) {
                    $('#district_id').html('<option value="">-- Select District --</option>');
                    return;
                }

                $.get(`/admin/districtsby/${divisionId}`, function(data) {
                    let options = '<option value="">-- Select District --</option>';
                    data.forEach(function(district) {
                        options +=
                            `<option value="${district.id}">${district.name}</option>`;
                    });
                    $('#district_id').html(options);
                });
            });

            // When District changes → fetch Blocks
            $('#district_id').on('change', function() {
                let districtId = $(this).val();
                $('#block_id').html('<option value="">Loading...</option>');

                if (!districtId) {
                    $('#block_id').html('<option value="">-- Select Block --</option>');
                    return;
                }

                $.get(`/admin/blocksby/${districtId}`, function(data) {
                    let options = '<option value="">-- Select Block --</option>';
                    data.forEach(function(block) {
                        options += `<option value="${block.id}">${block.name}</option>`;
                    });
                    $('#block_id').html(options);
                });
            });

        });
    </script>
@endpush --}}

@push('scripts')
    <script>
        $(document).ready(function() {

            // OLD VALUES FROM LARAVEL (important)
            const oldRole = "{{ old('role') }}";
            const oldDivision = "{{ old('division_id') }}";
            const oldDistrict = "{{ old('district_id') }}";
            const oldBlock = "{{ old('block_id') }}";

            function hideAll() {
                $('.location').addClass('d-none');
            }

            function showByRole(role) {
                hideAll();

                if (role === 'division_admin') {
                    $('.division').removeClass('d-none');
                }

                if (role === 'district_admin') {
                    $('.division, .district').removeClass('d-none');
                }

                if (role === 'block_admin') {
                    $('.division, .district, .block').removeClass('d-none');
                }
            }

            /* ------------------------------
               PAGE LOAD HANDLING (ERROR SAFE)
            --------------------------------*/
            if (oldRole) {
                // show correct fields
                showByRole(oldRole);

                // set division
                if (oldDivision) {
                    $('#division_id').val(oldDivision);
                    loadDistricts(oldDivision, oldDistrict);
                }

                // set district
                if (oldDistrict) {
                    loadBlocks(oldDistrict, oldBlock);
                }
            }

            /* ------------------------------
               ROLE CHANGE
            --------------------------------*/
            $('#role').on('change', function() {
                const role = $(this).val();
                showByRole(role);

                // Reset only when role actually changes
                $('#division_id').val('');
                $('#district_id').html('');
                $('#block_id').html('');
            });

            /* ------------------------------
               DIVISION → DISTRICTS
            --------------------------------*/
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                $('#district_id').html('<option value="">Loading...</option>');
                $('#block_id').html('');

                if (!divisionId) {
                    $('#district_id').html('<option value="">-- Select District --</option>');
                    return;
                }

                loadDistricts(divisionId);
            });

            /* ------------------------------
               DISTRICT → BLOCKS
            --------------------------------*/
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                $('#block_id').html('<option value="">Loading...</option>');

                if (!districtId) {
                    $('#block_id').html('<option value="">-- Select Block --</option>');
                    return;
                }

                loadBlocks(districtId);
            });

            /* ------------------------------
               AJAX HELPERS
            --------------------------------*/
            function loadDistricts(divisionId, selectedDistrict = null) {
                $.get(`/admin/districtsby/${divisionId}`, function(data) {
                    let options = '<option value="">-- Select District --</option>';
                    data.forEach(function(district) {
                        const selected = selectedDistrict == district.id ? 'selected' : '';
                        options +=
                            `<option value="${district.id}" ${selected}>${district.name}</option>`;
                    });
                    $('#district_id').html(options);
                });
            }

            function loadBlocks(districtId, selectedBlock = null) {
                $.get(`/admin/blocksby/${districtId}`, function(data) {
                    let options = '<option value="">-- Select Block --</option>';
                    data.forEach(function(block) {
                        const selected = selectedBlock == block.id ? 'selected' : '';
                        options += `<option value="${block.id}" ${selected}>${block.name}</option>`;
                    });
                    $('#block_id').html(options);
                });
            }

        });
    </script>
@endpush
