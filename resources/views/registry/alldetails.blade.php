@extends('layouts.app')

@section('content')
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
                            Farmer Registry Details
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Page Content -->
        <div class="row">
            <div class="col-xl-12">

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white fw-bold">
                        Farmer Complete Details
                    </div>

                    <div class="card-body">

                        <!-- Personal / Residential Details -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Personal & Residential Details</span>
                                <a href="{{ url('registry/step/1') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <p><b>Name:</b> {{ $farmer->name ?? '-' }}</p>
                                <p><b>Father/Husband Name :</b> {{ $farmer->father_name ?? '-' }}</p>
                                <p><b>Mobile:</b> {{ $farmer->phone ?? '-' }}</p>
                                <p><b>Email:</b> {{ $farmer->email ?? '-' }}</p>
                                <p><b>Aadhaar :</b> {{ $farmer->aadhaar ?? '-' }}</p>
                                <p><b>DOB :</b> {{ $farmer->dob ?? '-' }}</p>
                                <p><b>Gender :</b> {{ $farmer->gender ?? '-' }}</p>
                                <p><b>Category :</b> {{ $farmer->category ?? '-' }}</p>
                                <p><b>Address :</b> {{ $farmer->address ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Residential Details -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Residential Information</span>
                                <a href="{{ url('registry/step/2') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <p><b>Residential Type:</b>
                                    {{ ucfirst($farmer->residentialDetail->residential_type) ?? '-' }}</p>
                                <p><b>Address (English):</b>
                                    {{ ucfirst($farmer->residentialDetail->address_english) ?? '-' }}</p>
                                <p><b>Address (Local):</b> {{ ucfirst($farmer->residentialDetail->address_local) ?? '-' }}
                                </p>
                                <p><b>Division:</b> {{ ucfirst($farmer->residentialDetail->division->name) ?? '-' }}</p>
                                <p><b>District :</b> {{ ucfirst($farmer->residentialDetail->district->name) ?? '-' }}</p>
                                <p><b>Block :</b> {{ ucfirst($farmer->residentialDetail->block->name) ?? '-' }}</p>
                                <p><b>Village :</b> {{ ucfirst($farmer->residentialDetail->village) ?? '-' }}</p>
                                <p><b>Vincode :</b> {{ ucfirst($farmer->residentialDetail->pincode) ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Land Details -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Land Details</span>
                                <a href="{{ url('registry/step/3') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">

                                <p><b>Khata Number:</b> {{ ucfirst($farmer->landDetail->khata_number) }}</p>
                                <p><b>Plot Numbers:</b> {{ ucfirst($farmer->landDetail->plot_numbers) }}</p>
                                <p><b>Total Land:</b> {{ ucfirst($farmer->landDetail->total_land) }}</p>
                                <p><b>Irrigation Source:</b> {{ ucfirst($farmer->landDetail->irrigation_source) }} </p>
                                <p><b>ownership Type:</b> {{ ucfirst($farmer->landDetail->ownership_type) }}</p>

                            </div>
                        </div>

                        <!-- Crop Details -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Crop Details</span>
                                <a href="{{ url('registry/step/4') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <p><b>Main Crop:</b> {{ ucfirst($farmer->cropDetail->main_crop) }} </p>
                                <p><b>Secondary Crop:</b> {{ ucfirst($farmer->cropDetail->secondary_crop) }} </p>
                                <p><b>Season:</b> {{ ucfirst($farmer->cropDetail->season) }}</p>
                            </div>
                        </div>

                        <!-- Bank Details -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Bank Details</span>
                                <a href="{{ url('registry/step/5') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <p><b>Bank:</b> {{ $farmer->bankDetail->bank_name ?? '-' }}</p>
                                <p><b>Holder Name:</b> {{ $farmer->bankDetail->account_holder_name ?? '-' }}</p>
                                <p><b>Account Number:</b> {{ $farmer->bankDetail->account_number ?? '-' }}</p>
                                <p><b>IFSC:</b> {{ $farmer->bankDetail->ifsc_code ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="card mb-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Documents</span>
                                <a href="{{ url('registry/step/6') }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <p><b>Aadhaar :</b> <a href="{{ asset('storage') }}/{{ $farmer->documents->aadhaar_file }}"
                                        target="_blank">View</a></p>
                                <p><b>Land Paper :</b> <a href="{{ asset('storage') }}/{{ $farmer->documents->land_papers }}" target="_blank">View</a></p>
                                <p><b>Bank Passbook :</b> <a href="{{ asset('storage') }}/{{ $farmer->documents->bank_passbook }}" target="_blank">View</a></p>
                                <p><b>Photo:</b> <a href="{{ asset('storage') }}/{{ $farmer->documents->photo }}" target="_blank">View</a></p>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
