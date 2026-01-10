@extends('layouts.app')

@section('content')
<div class="page-content">

    @include('registry.partials.stepper', ['currentStep' => 5])

    <div class="card">
        <div class="card-header fw-bold">
            Step 5 of 6 – Bank Details
        </div>

        @php
            $bank = $user->bankDetail;
        @endphp

        <form method="POST" action="{{ route('bank.store') }}">
            @csrf

            <div class="card-body p-4">

                <h6 class="text-danger mb-3">Fields marked with an asterisk (*) are required.</h6>

                {{-- Bank Name --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Bank Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="bank_name"
                            value="{{ old('bank_name', optional($bank)->bank_name) }}"
                            class="form-control @error('bank_name') is-invalid @enderror">
                        @error('bank_name')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Account Holder Name --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Account Holder Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="account_holder_name"
                            value="{{ old('account_holder_name', optional($bank)->account_holder_name) }}"
                            class="form-control @error('account_holder_name') is-invalid @enderror">
                        @error('account_holder_name')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Account Number --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Account Number <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="account_number"
                            value="{{ old('account_number', optional($bank)->account_number) }}"
                            class="form-control @error('account_number') is-invalid @enderror">
                        @error('account_number')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- IFSC Code --}}
                <div class="row mb-4">
                    <label class="col-sm-3 col-form-label">IFSC Code <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="ifsc_code"
                            value="{{ old('ifsc_code', optional($bank)->ifsc_code) }}"
                            class="form-control @error('ifsc_code') is-invalid @enderror">
                        @error('ifsc_code')
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
