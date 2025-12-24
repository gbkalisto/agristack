@extends('admin.layouts.app')
@section('title', 'Crop Details')

@section('content')
    <div class="page-content">

        @include('admin.farmer.stepper', ['currentStep' => 4])

        <div class="card">
            <form method="POST" action="{{ route('admin.farmers.store.crop') }}">
                @csrf
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Crop Information</h6>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Main Crop</label>
                        <div class="col-sm-9">
                            <input type="text" name="main_crop" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Secondary Crop</label>
                        <div class="col-sm-9">
                            <input type="text" name="secondary_crop" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Season</label>
                        <div class="col-sm-9">
                            <select name="season" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="rabi">Rabi</option>
                                <option value="kharif">Kharif</option>
                                <option value="zaid">Zaid</option>
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
