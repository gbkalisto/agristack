@extends('account.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Farmer Detail</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-success" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#successhome"
                                                role="tab" aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Basic</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#successprofile" role="tab"
                                                aria-selected="true">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Residential</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#successcontact" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-unite font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Land</div>
                                                </div>
                                            </a>
                                        </li>

                                        {{-- <New> --}}
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#successcrop" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-aperture font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Crop</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#successbank" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-wallet-alt font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Bank</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#successdocument" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-icon"><i class="bx bx-file font-18 me-1"></i>
                                                    </div>
                                                    <div class="tab-title">Documents</div>
                                                </div>
                                            </a>
                                        </li>
                                        {{-- <New> --}}
                                    </ul>
                                    <div class="tab-content py-3">
                                        <div class="tab-pane active show" id="successhome" role="tabpanel">

                                            <div class="card-body p-0">
                                                <table class="table table-bordered table-striped mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th width="30%">Farmer Name</th>
                                                            <td>{{ $farmer->name ?? '-' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Father Name</th>
                                                            <td>{{ $farmer->father_name ?? '-' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Mobile Number</th>
                                                            <td>{{ $farmer->phone ?? '-' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Email</th>
                                                            <td>{{ $farmer->email ?? '-' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>District</th>
                                                            <td>{{ ucfirst($farmer->district->name ?? '-') }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Address</th>
                                                            <td>{{ ucfirst($farmer->address ?? '-') }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Registered On</th>
                                                            <td>{{ $farmer->created_at->format('d M Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade " id="successprofile" role="tabpanel">
                                            @if (empty($farmer->residentialDetail))
                                                <div class="alert alert-warning">
                                                    Residential details not available.
                                                </div>
                                            @else
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">Residential Type</th>
                                                                <td>{{ $farmer->residentialDetail->residential_type ?? '-' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Address English</th>
                                                                <td>{{ $farmer->residentialDetail->address_english ?? '-' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Address Local</th>
                                                                <td>{{ $farmer->residentialDetail->address_local ?? '-' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Division</th>
                                                                <td>{{ $farmer->residentialDetail->division->name ?? '-' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>District</th>
                                                                <td>{{ ucfirst($farmer->residentialDetail->district->name ?? '-') }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Block</th>
                                                                <td>{{ ucfirst($farmer->residentialDetail->block->name ?? '-') }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Village </th>
                                                                <td>{{ $farmer->residentialDetail->village ?? '-' }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Pin Code </th>
                                                                <td>{{ $farmer->residentialDetail->pincode ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Is Address Latest</th>
                                                                <td>{{ $farmer->residentialDetail->is_latest == '1' ? 'Yes' : 'No' }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="successcontact" role="tabpanel">
                                            @if (empty($farmer->landDetail))
                                                <div class="alert alert-warning">
                                                    land details not available.
                                                </div>
                                            @else
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">Khata Number</th>
                                                                <td>{{ $farmer->landDetail->khata_number ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Plot Numbers</th>
                                                                <td>{{ $farmer->landDetail->plot_numbers ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Total Land</th>
                                                                <td>{{ $farmer->landDetail->total_land ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Irrigation Source</th>
                                                                <td>{{ $farmer->landDetail->irrigation_source ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Ownership Type</th>
                                                                <td>{{ ucfirst($farmer->landDetail->ownership_type ?? 'Not Available') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <new> --}}
                                        <div class="tab-pane fade" id="successcrop" role="tabpanel">
                                            @if (empty($farmer->cropDetail))
                                                <div class="alert alert-warning">
                                                    Crop details not available.
                                                </div>
                                            @else
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">Main Crop</th>
                                                                <td>{{ $farmer->cropDetail->main_crop ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Secondary Crop</th>
                                                                <td>{{ $farmer->cropDetail->secondary_crop ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Total Land</th>
                                                                <td>{{ $farmer->cropDetail->total_land ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Season</th>
                                                                <td>{{ ucfirst($farmer->cropDetail->season ?? 'Not Available') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="successbank" role="tabpanel">
                                            @if (empty($farmer->bankDetail))
                                                <div class="alert alert-warning">
                                                    Crop details not available.
                                                </div>
                                            @else
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th width="30%">Bank Name</th>
                                                                <td>{{ $farmer->bankDetail->bank_name ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Account Holder Name </th>
                                                                <td>{{ $farmer->bankDetail->account_holder_name ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Account Number</th>
                                                                <td>{{ $farmer->bankDetail->account_number ?? 'Not Available' }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Ifsc Code</th>
                                                                <td>{{ ucfirst($farmer->bankDetail->ifsc_code ?? 'Not Available') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="successdocument" role="tabpanel">
                                            @if (empty($farmer->documents))
                                                <div class="alert alert-warning">
                                                    Document details not available.
                                                </div>
                                            @else
                                                <div class="card-body p-0">
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th>Passport Size Photo</th>
                                                                <td>
                                                                    @if (!empty($farmer->documents->photo))
                                                                        <div class="mb-2">
                                                                            <img src="{{ asset('storage/' . $farmer->documents->photo) }}"
                                                                                class="img-thumbnail" style="height:80px">
                                                                        </div>
                                                                    @else
                                                                        <span class="badge bg-danger mb-2">N/A</span>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">Aadhar</th>
                                                                <td>
                                                                    @if (!empty($farmer->documents->aadhaar_file))
                                                                        <a href="{{ asset('storage/' . $farmer->documents->aadhaar_file) }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-outline-primary mb-2">
                                                                            View Existing Aadhaar
                                                                        </a>
                                                                    @else
                                                                        <span class="badge bg-danger mb-2">N/A</span>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Land Paper </th>
                                                                <td>
                                                                    @if (!empty($farmer->documents->land_papers))
                                                                        <a href="{{ asset('storage/' . $farmer->documents->land_papers) }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-outline-primary mb-2">
                                                                            View Existing Land Papers
                                                                        </a>
                                                                    @else
                                                                        <span class="badge bg-danger mb-2">N/A</span>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Bank Passbook</th>
                                                                <td>
                                                                    @if (!empty($farmer->documents->bank_passbook))
                                                                        <a href="{{ asset('storage/' . $farmer->documents->bank_passbook) }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-outline-primary mb-2">
                                                                            View Existing Passbook
                                                                        </a>
                                                                    @else
                                                                        <span class="badge bg-danger mb-2">N/A</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <new> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
