@extends('layouts.app')

@section('content')
    <div class="page-content">
           @include('registry.partials.stepper', ['currentStep' => 3])
        <div class="card">

            <div class="card-header fw-bold">
                Step 3 of 6 – Land Details
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('registry.store', 3) }}">
                    @csrf

                    <div class="mb-3">
                        <label>Total Land (in acres)</label>
                        <input type="number" name="total_land" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">
                        Save & Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
