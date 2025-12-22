@extends('account.layouts.app')
@section('title', 'Farmer Land Details')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 3])

        <div class="card">
            <form method="POST" action="{{ route('account.farmers.store.land') }}">
                @csrf
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Land Details</h6>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Khata Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="khata_number" class="form-control" value="{{ old('khata_number') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Plot Number(s)</label>
                        <div class="col-sm-9">
                            <input type="text" name="plot_numbers" class="form-control"
                                value="{{ old('plot_numbers') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Total Land (Acres)</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01" name="total_land" class="form-control"
                                value="{{ old('total_land') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Irrigation Source</label>
                        <div class="col-sm-9">
                            <select name="irrigation_source" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="canal" {{ old('irrigation_source') == 'canal' ? 'selected' : '' }}>Canal
                                </option>
                                <option value="tubewell" {{ old('irrigation_source') == 'tubewell' ? 'selected' : '' }}>
                                    Tubewell</option>
                                <option value="rainfed" {{ old('irrigation_source') == 'rainfed' ? 'selected' : '' }}>
                                    Rainfed</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Ownership Type</label>
                        <div class="col-sm-9">
                            <select name="ownership_type" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="owner" {{ old('ownership_type') == 'owner' ? 'selected' : '' }}>Owner
                                </option>
                                <option value="lease" {{ old('ownership_type') == 'lease' ? 'selected' : '' }}>Lease
                                </option>
                                <option value="sharecrop" {{ old('ownership_type') == 'sharecrop' ? 'selected' : '' }}>
                                    Sharecrop</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary px-4">Save & Continue</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
