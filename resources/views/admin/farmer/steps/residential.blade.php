@extends('admin.layouts.app')
@section('title', 'Residential Details')

@section('content')
    <div class="page-content">

        @include('admin.farmer.stepper', ['currentStep' => 2])

        <div class="card">
            <form method="POST" action="{{ route('admin.farmers.store.residential') }}">
                @csrf

                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Residential Details</h6>

                    {{-- Residential Type --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Residential Type</label>
                        <div class="col-sm-9">
                            <select name="residential_type"
                                class="form-control @error('residential_type') is-invalid @enderror">
                                <option value="rural" {{ old('residential_type') == 'rural' ? 'selected' : '' }}>Rural
                                </option>
                                <option value="urban" {{ old('residential_type') == 'urban' ? 'selected' : '' }}>Urban
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Address English --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (English)</label>
                        <div class="col-sm-9">
                            <textarea name="address_english" class="form-control @error('residential_type') is-invalid @enderror" rows="2">{{ old('address_english') }}</textarea>
                        </div>
                    </div>

                    {{-- Address Local --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Address (Local Language)</label>
                        <div class="col-sm-9">
                            <textarea name="address_local" class="form-control " rows="2">{{ old('address_local') }}</textarea>
                        </div>
                    </div>

                    {{-- Division --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                            <select name="division_id" id="division_id"
                                class="form-control  @error('division_id') is-invalid @enderror">
                                <option value="">--select--</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ old('division_id', $division->id) }}">{{ ucfirst($division->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="district_id" id="district_id"
                                class="form-control @error('district_id') is-invalid @enderror" required>
                                <option value="">--select--</option>
                            </select>
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
                        </div>
                    </div>

                    {{-- Village --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Village </label>
                        <div class="col-sm-9">
                            <input type="text" name="village" class="form-control @error('village') is-invalid @enderror"
                                value="{{ old('village') }}" required>
                        </div>
                    </div>

                    {{-- Pincode --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">PIN Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="pincode" value="{{ old('pincode') }}"
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
                // $.get(`/admin/districtsby/${divisionId}`, function(data) {
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
