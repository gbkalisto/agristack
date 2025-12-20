@extends('account.layouts.app')
@section('title', 'Residential Details')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 6])

        <div class="card">
            <form method="POST" action="{{ route('account.farmers.store.residential') }}">
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
                            <input type="text" class="form-control  @error('division_id') is-invalid @enderror"
                                name="division_id" value="1" readonly>
                        </div>
                    </div>

                    {{-- District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">District <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="district_id"
                                class="form-control @error('district_id') is-invalid @enderror"
                                value="{{ old('district_id') }}" required>
                        </div>
                    </div>

                    {{-- Sub District --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Block <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="block_id"
                                class="form-control @error('block_id') is-invalid @enderror" value="{{ old('block_id') }}"
                                required>
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
                            <input type="text" name="pincode" value="{{ old('pincode') }}" class="form-control @error('pincode') is-invalid @enderror"
                                maxlength="6">
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
