@extends('layouts.app')

@section('content')
    <div class="page-content">
        @include('registry.partials.stepper', ['currentStep' => 4])
        <div class="card">
            {{-- Progress Bar --}}
            @include('registry.partials.progress', ['currentStep' => 4])
            <div class="card-header fw-bold">
                Step 4 of 6 – Crop Details
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('registry.store', 4) }}">
                    @csrf

                    <div class="mb-3">
                        <label>Main Crop</label>
                        <input type="text" name="crop_name" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">
                        Save & Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
