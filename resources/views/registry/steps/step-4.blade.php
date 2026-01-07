@extends('layouts.app')

@section('content')
    <div class="page-content">

        @include('registry.partials.stepper', ['currentStep' => 4])

        <div class="card">
            <div class="card-header fw-bold">
                Step 4 of 6 – Crop Details
            </div>

            @php
                $crop = $user->cropDetail;
            @endphp

            <form method="POST" action="{{ route('crop.store') }}">
                @csrf

                <div class="card-body p-4">

                    {{-- <h6 class="text-primary fw-bold mb-3">Crop Information</h6> --}}

                    {{-- Main Crop --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Main Crop</label>
                        <div class="col-sm-9">
                            <input type="text" name="main_crop"
                                value="{{ old('main_crop', optional($crop)->main_crop) }}"
                                class="form-control @error('main_crop') is-invalid @enderror">
                            @error('main_crop')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Secondary Crop --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Secondary Crop</label>
                        <div class="col-sm-9">
                            <input type="text" name="secondary_crop"
                                value="{{ old('secondary_crop', optional($crop)->secondary_crop) }}"
                                class="form-control @error('secondary_crop') is-invalid @enderror">
                            @error('secondary_crop')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    {{-- Season --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Season</label>
                        <div class="col-sm-9">
                            <select name="season" class="form-control @error('season') is-invalid @enderror">
                                <option value="">-- Select --</option>
                                <option value="rabi"
                                    {{ old('season', optional($crop)->season) == 'rabi' ? 'selected' : '' }}>
                                    Rabi
                                </option>
                                <option value="kharif"
                                    {{ old('season', optional($crop)->season) == 'kharif' ? 'selected' : '' }}>
                                    Kharif
                                </option>
                                <option value="zaid"
                                    {{ old('season', optional($crop)->season) == 'zaid' ? 'selected' : '' }}>
                                    Zaid
                                </option>
                            </select>
                            @error('season')
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
