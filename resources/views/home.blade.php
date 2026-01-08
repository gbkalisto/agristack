@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in ') . Auth::user()->name}}!


                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card shadow-sm">

                    <div class="card-header bg-success text-white fw-bold">
                        Farmer Registration Status
                    </div>

                    <div class="card-body">

                        {{-- ✅ COMPLETED MESSAGE --}}
                        @if (!empty($user) && $user->is_profile_completed == true)
                            <div class="alert alert-success">
                                <strong>Registration Completed Successfully!</strong><br>
                                Your farmer registration process has been completed.
                                You may review or update your details below.
                            </div>

                            {{-- REVIEW SUMMARY --}}
                            <table class="table table-bordered table-striped mb-4">
                                <tr>
                                    <th width="30%">Applicant Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Registration Status</th>
                                    <td>
                                        <span class="badge bg-success">Completed</span>
                                    </td>
                                </tr>
                            </table>

                            {{-- EDIT OPTIONS --}}
                            <div class="mb-3 fw-bold text-primary">
                                Edit / Review Details
                            </div>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=1') }}" class="btn btn-outline-primary w-100">
                                        Edit Personal Details
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=2') }}" class="btn btn-outline-primary w-100">
                                        Edit Residential Details
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=3') }}" class="btn btn-outline-primary w-100">
                                        Edit Land Details
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=4') }}" class="btn btn-outline-primary w-100">
                                        Edit Crop Details
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=5') }}" class="btn btn-outline-primary w-100">
                                        Edit Bank Details
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{ url('/registry?edit_step=6') }}" class="btn btn-outline-primary w-100">
                                        Edit Documents
                                    </a>
                                </div>

                            </div>

                            {{-- FINAL ACTION --}}
                            <div class="mt-4 text-center">
                                <a href="#" class="btn btn-success px-5">
                                    PrintZ
                                </a>
                            </div>
                        @else
                            {{-- ❌ FALLBACK (SHOULD RARELY HAPPEN) --}}
                            <div class="alert alert-warning">
                                Your registration is in progress. Please continue to complete it.
                            </div>
                            <a href="{{ url('/registry') }}" class="btn btn-primary">
                                Continue Registration
                            </a>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
