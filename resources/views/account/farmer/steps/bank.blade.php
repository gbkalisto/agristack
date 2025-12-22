@extends('account.layouts.app')
@section('title', 'Bank Details')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 5])

        <div class="card">
            <form method="POST" action="{{ route('account.farmers.store.bank') }}">
                @csrf
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Bank Details</h6>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Account Holder Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_holder_name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Account Number</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_number" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">IFSC Code</label>
                        <div class="col-sm-9">
                            <input type="text" name="ifsc_code" class="form-control">
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
