@extends('layouts.app')

@section('content')
<div class="page-content">

    @include('registry.partials.stepper', ['currentStep' => 3])

    <div class="card">
        <div class="card-header fw-bold">
            Step 3 of 6 – Land Details
        </div>

        @php
            $land = $user->landDetail;
        @endphp

        <form method="POST" action="{{ route('land.store') }}">
            @csrf

            <div class="card-body p-4">

                <h6 class="text-danger mb-3">Fields marked with an asterisk (*) are required.</h6>

                {{-- Khata Number --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Khata Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="khata_number"
                            value="{{ old('khata_number', optional($land)->khata_number) }}"
                            class="form-control @error('khata_number') is-invalid @enderror">
                        @error('khata_number')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Plot Numbers --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Plot Number(s) <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="plot_numbers"
                            value="{{ old('plot_numbers', optional($land)->plot_numbers) }}"
                            class="form-control @error('plot_numbers') is-invalid @enderror">
                        @error('plot_numbers')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Total Land --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Total Land (Acres) <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" name="total_land"
                            value="{{ old('total_land', optional($land)->total_land) }}"
                            class="form-control @error('total_land') is-invalid @enderror">
                        @error('total_land')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Irrigation Source --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Irrigation Source <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="irrigation_source"
                            class="form-control @error('irrigation_source') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="canal"
                                {{ old('irrigation_source', optional($land)->irrigation_source) == 'canal' ? 'selected' : '' }}>
                                Canal
                            </option>
                            <option value="tubewell"
                                {{ old('irrigation_source', optional($land)->irrigation_source) == 'tubewell' ? 'selected' : '' }}>
                                Tubewell
                            </option>
                            <option value="rainfed"
                                {{ old('irrigation_source', optional($land)->irrigation_source) == 'rainfed' ? 'selected' : '' }}>
                                Rainfed
                            </option>
                        </select>
                        @error('irrigation_source')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Ownership Type --}}
                <div class="row mb-4">
                    <label class="col-sm-3 col-form-label">Ownership Type</label>
                    <div class="col-sm-9">
                        <select name="ownership_type"
                            class="form-control @error('ownership_type') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            <option value="owner"
                                {{ old('ownership_type', optional($land)->ownership_type) == 'owner' ? 'selected' : '' }}>
                                Owner
                            </option>
                            <option value="lease"
                                {{ old('ownership_type', optional($land)->ownership_type) == 'lease' ? 'selected' : '' }}>
                                Lease
                            </option>
                            <option value="sharecrop"
                                {{ old('ownership_type', optional($land)->ownership_type) == 'sharecrop' ? 'selected' : '' }}>
                                Sharecrop
                            </option>
                        </select>
                        @error('ownership_type')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
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
