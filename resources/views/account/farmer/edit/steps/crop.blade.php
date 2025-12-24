@extends('account.layouts.app')
@section('title', 'Crop Details')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 4])

        <div class="card">
            <form method="POST" action="{{ route('account.farmers.update.crop', $farmer->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Edit Crop Information</h6>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Main Crop <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="main_crop" class="form-control"
                                value="{{ old('main_crop', $crop->main_crop) }}">
                            @error('main_crop')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Secondary Crop</label>
                        <div class="col-sm-9">
                            <input type="text" name="secondary_crop" class="form-control"
                                value="{{ old('secondary_crop', $crop->secondary_crop) }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Season <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="season" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="rabi" {{ old('season', $crop->season) == 'rabi' ? 'selected' : '' }}>Rabi
                                </option>
                                <option value="kharif" {{ old('season', $crop->season) == 'kharif' ? 'selected' : '' }}>
                                    Kharif</option>
                                <option value="zaid" {{ old('season', $crop->season) == 'zaid' ? 'selected' : '' }}>Zaid
                                </option>
                            </select>
                            @error('season')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">Update & Continue</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
