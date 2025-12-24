@extends('account.layouts.app')
@section('title', 'Documents Upload')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 6])

        <div class="card">

            <form method="POST" action="{{ route('account.farmers.update.documents', $farmer->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-4">Edit Documents</h6>

                    {{-- Aadhaar Card --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            Aadhaar Card <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">

                            @if (!empty($documents->aadhaar_file))
                                <a href="{{ asset('storage/' . $documents->aadhaar_file) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Aadhaar
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="aadhaar_file"
                                class="form-control @error('aadhaar_file') is-invalid @enderror"
                                accept=".pdf,.jpg,.jpeg,.png">

                            <small class="text-muted">
                                Upload only if you want to replace · Max 2MB
                            </small>

                            @error('aadhaar_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Land Papers --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Land Papers</label>
                        <div class="col-sm-9">

                            @if (!empty($documents->land_papers))
                                <a href="{{ asset('storage/' . $documents->land_papers) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Land Papers
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="land_papers"
                                class="form-control @error('land_papers') is-invalid @enderror"
                                accept=".pdf,.jpg,.jpeg,.png">

                            <small class="text-muted">
                                PDF / JPG / PNG · Max 2MB
                            </small>

                            @error('land_papers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Bank Passbook --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Bank Passbook</label>
                        <div class="col-sm-9">

                            @if (!empty($documents->bank_passbook))
                                <a href="{{ asset('storage/' . $documents->bank_passbook) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Passbook
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="bank_passbook"
                                class="form-control @error('bank_passbook') is-invalid @enderror"
                                accept=".pdf,.jpg,.jpeg,.png">

                            <small class="text-muted">
                                PDF / JPG / PNG · Max 2MB
                            </small>

                            @error('bank_passbook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Passport Photo --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Passport Photo</label>
                        <div class="col-sm-9">

                            @if (!empty($documents->photo))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $documents->photo) }}" class="img-thumbnail"
                                        style="height:80px">
                                </div>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                                accept="image/jpeg,image/png">

                            <small class="text-muted">
                                JPG / PNG only · Max 1MB
                            </small>

                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Declaration --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="declaration" required checked>
                        <label class="form-check-label" for="declaration">
                            I confirm that the updated information is correct.
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div class="text-end">
                        <button class="btn btn-success px-4">
                            Update Documents
                        </button>
                    </div>

                </div>
            </form>


        </div>
    </div>
@endsection
