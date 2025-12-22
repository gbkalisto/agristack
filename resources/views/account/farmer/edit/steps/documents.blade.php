@extends('account.layouts.app')
@section('title', 'Edit Documents')

@section('content')
    <div class="page-content">

        @include('account.farmer.stepper', ['currentStep' => 6])

        <div class="card">
            <form method="POST" action="{{ route('account.farmers.update.documents', $farmer->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{-- @php
    dd($documents);
@endphp --}}
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-4">Edit Documents</h6>

                    {{-- Aadhaar --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Aadhaar Card</label>
                        <div class="col-sm-9">

                            @if ($documents->aadhaar_file)
                                <a href="{{ asset('storage/' . $documents->aadhaar_file) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Aadhaar
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="aadhaar_file" class="form-control">
                            <small class="text-muted">Upload only if you want to replace</small>
                        </div>
                    </div>

                    {{-- Land Papers --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Land Papers</label>
                        <div class="col-sm-9">

                            @if ($documents->land_papers)
                                <a href="{{ asset('storage/' . $documents->land_papers) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Land Papers
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="land_papers" class="form-control">
                        </div>
                    </div>

                    {{-- Bank Passbook --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Bank Passbook</label>
                        <div class="col-sm-9">

                            @if ($documents->bank_passbook)
                                <a href="{{ asset('storage/' . $documents->bank_passbook) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    View Existing Passbook
                                </a>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="bank_passbook" class="form-control">
                        </div>
                    </div>

                    {{-- Photo --}}
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Passport Photo</label>
                        <div class="col-sm-9">

                            @if ($documents->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $documents->photo) }}" class="img-thumbnail"
                                        style="height:80px">
                                </div>
                            @else
                                <span class="badge bg-danger mb-2">N/A</span>
                            @endif

                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    {{-- Declaration --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" checked id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
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
