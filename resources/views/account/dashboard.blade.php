@extends('account.layouts.app')
@section('title', 'Dashboard')

@section('content')
    @php
        $role = auth('account')->user()->role;
    @endphp
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <a href="{{ route('account.farmers.index') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Farmers</p>
                                    <h4 class="my-1 text-info">{{ $farmerCount }}</h4>
                                    {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class='bx bxs-user'></i>
                                </div>
                            </div>
                    </a>
                </div>
            </div>
        </div>
        @if ($role == 'block_admin')
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="{{ route('account.farmers.create') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Farmer Registration</p>
                                    <h4 class="my-1 text-danger">+</h4>
                                    {{-- <p class="mb-0 font-13">+5.4% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                    <i class='bx bxs-card'></i>
                                </div>
                            </div>
                    </a>
                </div>
            </div>
        @endif

        @if ($role == 'district_admin' || $role == 'division_admin' || $role == 'admin')
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="{{ route('account.below.accounts') }}">
                    </a>
                    <div class="card-body"><a href="{{ route('account.below.accounts') }}">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Accounts</p>
                                    <h4 class="my-1 text-danger">{{ $accountsCount }}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                    <i class="bx bxs-card"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
    </div><!--end row-->
    </div>
@endsection
