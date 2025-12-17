@extends('admin.layouts.app')
@section('title', 'Edit Admin Account')

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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.accounts.index') }}">Admin Accounts</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Admin Account
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body p-4">

                            {{-- Full Name --}}
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
                                            value="{{ old('name', $account->name) }}">
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
                                            value="{{ old('user_name', $account->user_name) }}">
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
                                            value="{{ old('email', $account->email) }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Mobile --}}
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
                                            class="form-control @error('mobile') is-invalid @enderror"
                                            value="{{ old('mobile', $account->mobile) }}"
                                            pattern="[0-9]{10}"
                                                    maxlength="10" placeholder="Enter 10-digit mobile number"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('mobile')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password (optional) --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    New Password
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('password') border-danger text-danger @enderror">
                                            <i class="bx bx-lock"></i>
                                        </span>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Leave blank to keep current password">
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
                                        <option value="admin" {{ $account->role == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="division_admin"
                                            {{ $account->role == 'division_admin' ? 'selected' : '' }}>Division Admin
                                        </option>
                                        <option value="district_admin"
                                            {{ $account->role == 'district_admin' ? 'selected' : '' }}>District Admin
                                        </option>
                                        <option value="block_admin"
                                            {{ $account->role == 'block_admin' ? 'selected' : '' }}>Block
                                            Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Division --}}
                            <div class="row mb-3 location division {{ $account->division_id ? '' : 'd-none' }}">
                                <label class="col-sm-3 col-form-label">Division</label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id" class="form-control">
                                        <option value="">-- Select Division --</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ $account->division_id == $division->id ? 'selected' : '' }}>
                                                {{ $division->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- District --}}
                            <div class="row mb-3 location district {{ $account->district_id ? '' : 'd-none' }}">
                                <label class="col-sm-3 col-form-label">District</label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control">
                                        @if ($account->district)
                                            <option value="{{ $account->district->id }}" selected>
                                                {{ $account->district->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- Block --}}
                            <div class="row mb-3 location block {{ $account->block_id ? '' : 'd-none' }}">
                                <label class="col-sm-3 col-form-label">Block</label>
                                <div class="col-sm-9">
                                    <select name="block_id" id="block_id" class="form-control">
                                        @if ($account->block)
                                            <option value="{{ $account->block->id }}" selected>
                                                {{ $account->block->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid gap-3">
                                        <button type="submit" class="btn btn-primary submit-btn px-4">
                                            <span class="submit-text">Update</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"></span>
                                        </button>
                                        <a href="{{ route('admin.accounts.index') }}"
                                            class="btn btn-light px-4">Cancel</a>
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

            const currentRole = "{{ $account->role }}";
            const currentDivision = "{{ $account->division_id }}";
            const currentDistrict = "{{ $account->district_id }}";
            const currentBlock = "{{ $account->block_id }}";

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

            // Initial load (page load)
            showByRole(currentRole);

            // Load districts if division exists
            if (currentDivision) {
                loadDistricts(currentDivision, currentDistrict);
            }

            // Load blocks if district exists
            if (currentDistrict) {
                loadBlocks(currentDistrict, currentBlock);
            }

            // Role change
            $('#role').on('change', function() {
                const role = $(this).val();
                showByRole(role);

                // Reset dependent dropdowns
                if (role === 'admin') {
                    $('#division_id').val('');
                    $('#district_id').empty();
                    $('#block_id').empty();
                }
            });

            // Division change → fetch districts
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                $('#district_id').html('<option value="">Loading...</option>');
                $('#block_id').empty();

                if (!divisionId) {
                    $('#district_id').html('<option value="">-- Select District --</option>');
                    return;
                }

                loadDistricts(divisionId);
            });

            // District change → fetch blocks
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                $('#block_id').html('<option value="">Loading...</option>');

                if (!districtId) {
                    $('#block_id').html('<option value="">-- Select Block --</option>');
                    return;
                }

                loadBlocks(districtId);
            });

            // Fetch districts
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

            // Fetch blocks
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
@endpush --}}

@push('scripts')
    <script>
        $(document).ready(function() {

            // EXISTING DATA FROM DB
            const currentRole = "{{ $account->role }}";
            const currentDivision = "{{ old('division_id', $account->division_id) }}";
            const currentDistrict = "{{ old('district_id', $account->district_id) }}";
            const currentBlock = "{{ old('block_id', $account->block_id) }}";

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

            /* ---------------------------------
               INITIAL LOAD (IMPORTANT)
            --------------------------------- */
            showByRole(currentRole);

            if (currentDivision) {
                $('#division_id').val(currentDivision);
                loadDistricts(currentDivision, currentDistrict);
            }

            if (currentDistrict) {
                loadBlocks(currentDistrict, currentBlock);
            }

            /* ---------------------------------
               ROLE CHANGE
            --------------------------------- */
            $('#role').on('change', function() {
                const role = $(this).val();
                showByRole(role);

                // Reset lower-level selections
                if (role === 'admin') {
                    $('#division_id').val('');
                    $('#district_id').html('');
                    $('#block_id').html('');
                }
            });

            /* ---------------------------------
               DIVISION → DISTRICTS
            --------------------------------- */
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

            /* ---------------------------------
               DISTRICT → BLOCKS
            --------------------------------- */
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                $('#block_id').html('<option value="">Loading...</option>');

                if (!districtId) {
                    $('#block_id').html('<option value="">-- Select Block --</option>');
                    return;
                }

                loadBlocks(districtId);
            });

            /* ---------------------------------
               AJAX HELPERS
            --------------------------------- */
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
