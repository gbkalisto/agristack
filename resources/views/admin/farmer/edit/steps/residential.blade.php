@extends('admin.layouts.app')
@section('title', 'Residential Details')

@section('content')
    <div class="page-content">

        @include('admin.farmer.stepper', ['currentStep' => 2])

        <div class="card">
            <form method="POST" action="{{ route('admin.farmers.update.residential', $farmer->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Edit Residential Details</h6>

                    {{-- Residential Type --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Residential Type</label>
                        <div class="col-sm-9">
                            <select name="residential_type"
                                class="form-control @error('residential_type') is-invalid @enderror">
                                <option value="rural"
                                    {{ old('residential_type', $residential->residential_type) == 'rural' ? 'selected' : '' }}>
                                    Rural
                                </option>
                                <option value="urban"
                                    {{ old('residential_type', $residential->residential_type) == 'urban' ? 'selected' : '' }}>
                                    Urban
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Address English --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (English)</label>
                        <div class="col-sm-9">
                            <textarea name="address_english" class="form-control @error('residential_type') is-invalid @enderror" rows="2">{{ old('address_english', $residential->address_english) }}</textarea>
                        </div>
                    </div>

                    {{-- Address Local --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (Local Language)</label>
                        <div class="col-sm-9">
                            <textarea name="address_local" class="form-control " rows="2">{{ old('address_local', $residential->address_local) }}</textarea>
                        </div>
                    </div>

                    {{-- Division --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Division <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="division_id" id="division_id"
                                class="form-control  @error('division_id') is-invalid @enderror">
                                <option value="">--select--</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ old('division_id', $residential->division_id) == $division->id ? 'selected' : '' }}>
                                        {{ ucfirst($division->name) }}</option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="district_id" id="district_id"
                                class="form-control @error('district_id') is-invalid @enderror">
                                <option value="">--select--</option>
                            </select>
                            @error('district_id')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Sub District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Block <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="block_id" id="block_id"
                                class="form-control @error('block_id') is-invalid @enderror">
                                <option value="">--select--</option>
                            </select>
                            @error('block_id')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Village --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Village </label>
                        <div class="col-sm-9">
                            <input type="text" name="village" class="form-control @error('village') is-invalid @enderror"
                                value="{{ old('village', $residential->village) }}" >
                        </div>
                    </div>

                    {{-- Pincode --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">PIN Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="pincode" value="{{ old('pincode', $residential->pincode) }}"
                                class="form-control @error('pincode') is-invalid @enderror" maxlength="6">
                        </div>
                    </div>

                    {{-- Latest checkbox --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" id="is_latest" type="checkbox" name="is_latest" value="1"
                            checked>
                        <label class="form-check-label" for="is_latest">
                            Insert latest residential details
                        </label>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">
                            Save & Finish
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            const savedDivision = "{{ old('division_id', $residential->division_id) }}";
            const savedDistrict = "{{ old('district_id', $residential->district_id) }}";
            const savedBlock = "{{ old('block_id', $residential->block_id) }}";

            /* ------------------------------
               ON PAGE LOAD (EDIT MODE)
            --------------------------------*/
            if (savedDivision) {
                loadDistricts(savedDivision, savedDistrict);

                if (savedDistrict) {
                    loadBlocks(savedDistrict, savedBlock);
                }
            }

            /* ------------------------------
               DIVISION → DISTRICT
            --------------------------------*/
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                $('#district_id').html('<option value="">Loading...</option>');
                $('#block_id').html('<option value="">-- Select Block --</option>');

                if (!divisionId) {
                    $('#district_id').html('<option value="">-- Select District --</option>');
                    return;
                }

                loadDistricts(divisionId);
            });

            /* ------------------------------
               DISTRICT → BLOCK
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
                $.get(`/districtsby/${divisionId}`, function(data) {
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
                $.get(`/blocksby/${districtId}`, function(data) {
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
