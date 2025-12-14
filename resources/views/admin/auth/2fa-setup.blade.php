@extends('admin.layouts.app')
@section('title', 'Enable Two-Factor Authentication')

@section('content')
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Security</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Enable 2FA</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Enable 2FA Card -->
        <div class="card shadow border-0">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    <i class="bx bx-lock me-2 text-primary"></i>Enable Two-Factor Authentication
                </h4>

                <div class="alert alert-info">
                    <strong>Security Tip:</strong> Two-Factor Authentication (2FA) adds an extra layer of protection.
                    You will be required to enter a 6-digit code from your
                    <strong>Google Authenticator app</strong> each time you log in.
                </div>

                <p class="mb-4">
                    Scan the QR code below using your Google Authenticator or any TOTP-compatible app.
                    Once scanned, click <strong>“Enable 2FA”</strong> to secure your admin account.
                </p>

                <div class="text-center mb-4">
                    <div class="d-inline-block p-2 border rounded bg-light">
                        {!! $qrCode !!}
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.2fa.setup.store') }}" class="text-center">
                    @csrf
                    <div class="from-group row">
                        <div class="col-sm-4 mx-auto">
                            <input type="text" name="code" maxlength="6" inputmode="numeric" autocomplete="one-time-code"  pattern="\d{6}" oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,6);"
                                class="form-control @error('code') border border-danger text-danger @enderror"
                                placeholder="Enter 6 digit code from authenticator app">
                            @error('code')
                                <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <div class="from-group mt-2">
                        <button class="btn btn-success px-4" type="submit">
                            <i class="bx bx-shield-plus me-1"></i> Enable 2FA
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <small class="text-muted">Didn’t scan yet? Open your Authenticator app and scan now before
                        enabling.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
