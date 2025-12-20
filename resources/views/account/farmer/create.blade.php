@extends('account.layouts.app')
@section('title', 'Create Farmer')

@section('content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('account.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('account.farmers.index') }}">Farmers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create Farmer
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <a href="{{ route('account.farmers.index') }}" class="btn btn-secondary btn-sm">
                    Back to list
                </a>
            </div>
        </div>

        <!-- Stepper -->
        @include('account.farmer.stepper', ['currentStep' => 1])

        <!-- Step Content -->
        @include('account.farmer.steps.basic')

    </div>
@endsection
