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
                        <label class="col-sm-3 col-form-label">Bank Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_name"
                                class="form-control @error('bank_name') is-invalid @enderror" {{ old('bank_name') }}>
                            @error('bank_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Account Holder Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="account_holder_name"
                                class="form-control  @error('account_holder_name') is-invalid @enderror" value="{{ old('account_holder_name') }}">
                            @error('account_holder_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Account Number <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="account_number"
                                class="form-control  @error('account_number') is-invalid @enderror"  value="{{ old('account_number') }}">
                            @error('account_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">IFSC Code <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror" value="{{ old('ifsc_code') }}">
                            @error('ifsc_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
