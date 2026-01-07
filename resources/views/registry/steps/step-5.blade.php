@extends('layouts.app')

@section('content')
    <div class="page-content">
           @include('registry.partials.stepper', ['currentStep' => 5])
        <div class="card">
            <div class="card-header fw-bold">
                Step 5 of 6 – Bank Details
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('registry.store', 5) }}">
                    @csrf

                    <div class="mb-3">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Account Number</label>
                        <input type="text" name="account_number" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">
                        Save & Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
