@extends('layouts.app')

@section('content')
    <div class="page-content">

        @include('registry.partials.stepper', ['currentStep' => 2])

        <div class="card">
            <div class="card-header fw-bold">
                Step 2 of 6 – Residential Details
            </div>

            @php
                $residential = $user->residentialDetail;
            @endphp

            <form method="POST" action="{{ route('residential.store') }}">
                @csrf

                <div class="card-body p-4">

                    {{-- Residential Type --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Residential Type</label>
                        <div class="col-sm-9">
                            <select name="residential_type"
                                class="form-control @error('residential_type') is-invalid @enderror">
                                <option value="rural"
                                    {{ old('residential_type', optional($residential)->residential_type) == 'rural' ? 'selected' : '' }}>
                                    Rural
                                </option>
                                <option value="urban"
                                    {{ old('residential_type', optional($residential)->residential_type) == 'urban' ? 'selected' : '' }}>
                                    Urban
                                </option>
                            </select>
                            @error('residential_type')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Address English --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (English)</label>
                        <div class="col-sm-9">
                            <textarea name="address_english" rows="2" class="form-control @error('address_english') is-invalid @enderror">{{ old('address_english', optional($residential)->address_english) }}</textarea>
                            @error('address_english')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Address Local --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (Local)</label>
                        <div class="col-sm-9">
                            <textarea name="address_local" rows="2" class="form-control">{{ old('address_local', optional($residential)->address_local) }}</textarea>
                        </div>
                    </div>

                    {{-- Division --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                            <select name="division_id" id="division_id"
                                class="form-control @error('division_id') is-invalid @enderror">
                                <option value="">-- Select Division --</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ old('division_id', optional($residential)->division_id) == $division->id ? 'selected' : '' }}>
                                        {{ ucfirst($division->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">District</label>
                        <div class="col-sm-9">
                            <select name="district_id" id="district_id"
                                class="form-control @error('district_id') is-invalid @enderror">
                                <option value="">-- Select District --</option>
                            </select>
                            @error('district_id')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Block --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Block</label>
                        <div class="col-sm-9">
                            <select name="block_id" id="block_id"
                                class="form-control @error('block_id') is-invalid @enderror">
                                <option value="">-- Select Block --</option>
                            </select>
                            @error('block_id')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Village --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Village</label>
                        <div class="col-sm-9">
                            <input type="text" name="village"
                                value="{{ old('village', optional($residential)->village) }}"
                                class="form-control @error('village') is-invalid @enderror">
                            @error('village')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Pincode --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">PIN Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="pincode" maxlength="6"
                                value="{{ old('pincode', optional($residential)->pincode) }}"
                                class="form-control @error('pincode') is-invalid @enderror">
                            @error('pincode')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Latest --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="is_latest" name="is_latest" value="1"
                            {{ old('is_latest', optional($residential)->is_latest) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_latest">
                            Insert latest residential details
                        </label>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">
                            Save & Continue
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

            const oldDivision = "{{ old('division_id', optional($residential)->division_id) }}";
            const oldDistrict = "{{ old('district_id', optional($residential)->district_id) }}";
            const oldBlock = "{{ old('block_id', optional($residential)->block_id) }}";

            /* ---------- PAGE LOAD ---------- */
            if (oldDivision) {
                loadDistricts(oldDivision, oldDistrict);

                if (oldDistrict) {
                    loadBlocks(oldDistrict, oldBlock);
                }
            }

            /* ---------- DIVISION → DISTRICT ---------- */
            $('#division_id').on('change', function() {
                const divisionId = $(this).val();
                $('#district_id').html('<option>Loading...</option>');
                $('#block_id').html('<option value="">-- Select Block --</option>');

                if (!divisionId) return;
                loadDistricts(divisionId);
            });

            /* ---------- DISTRICT → BLOCK ---------- */
            $('#district_id').on('change', function() {
                const districtId = $(this).val();
                $('#block_id').html('<option>Loading...</option>');

                if (!districtId) return;
                loadBlocks(districtId);
            });

            /* ---------- AJAX HELPERS ---------- */
            function loadDistricts(divisionId, selectedDistrict = null) {
                $.get(`/districtsby/${divisionId}`, function(data) {
                    let html = '<option value="">-- Select District --</option>';
                    data.forEach(d => {
                        html +=
                            `<option value="${d.id}" ${selectedDistrict == d.id ? 'selected' : ''}>${d.name}</option>`;
                    });
                    $('#district_id').html(html);
                });
            }

            function loadBlocks(districtId, selectedBlock = null) {
                $.get(`/blocksby/${districtId}`, function(data) {
                    let html = '<option value="">-- Select Block --</option>';
                    data.forEach(b => {
                        html +=
                            `<option value="${b.id}" ${selectedBlock == b.id ? 'selected' : ''}>${b.name}</option>`;
                    });
                    $('#block_id').html(html);
                });
            }

        });
    </script>
@endpush
