@extends('layouts.app')

@section('content')
<div class="page-content">

    @include('registry.partials.stepper', ['currentStep' => 6])

    <div class="card">
        <div class="card-header fw-bold">
            Step 6 of 6 – Document Upload
        </div>

        @php
            $documents = $user->documents;
        @endphp

        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body p-4">

                {{-- <h6 class="text-primary fw-bold mb-4">Document Upload</h6> --}}

                {{-- Aadhaar --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Aadhaar Card</label>
                    <div class="col-sm-9">

                        @if (optional($documents)->aadhaar_file)
                            <a href="{{ asset('storage/' . $documents->aadhaar_file) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mb-2">
                                View Existing Aadhaar
                            </a>
                        @else
                            <span class="badge bg-danger mb-2">N/A</span>
                        @endif

                        <input type="file" name="aadhaar_file"
                            class="form-control @error('aadhaar_file') is-invalid @enderror">
                        <small class="text-muted">Upload only if you want to replace</small>

                        @error('aadhaar_file')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Land Papers --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Land Papers</label>
                    <div class="col-sm-9">

                        @if (optional($documents)->land_papers)
                            <a href="{{ asset('storage/' . $documents->land_papers) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mb-2">
                                View Existing Land Papers
                            </a>
                        @else
                            <span class="badge bg-danger mb-2">N/A</span>
                        @endif

                        <input type="file" name="land_papers"
                            class="form-control @error('land_papers') is-invalid @enderror">

                        @error('land_papers')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Bank Passbook --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Bank Passbook</label>
                    <div class="col-sm-9">

                        @if (optional($documents)->bank_passbook)
                            <a href="{{ asset('storage/' . $documents->bank_passbook) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mb-2">
                                View Existing Passbook
                            </a>
                        @else
                            <span class="badge bg-danger mb-2">N/A</span>
                        @endif

                        <input type="file" name="bank_passbook"
                            class="form-control @error('bank_passbook') is-invalid @enderror">

                        @error('bank_passbook')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Photo --}}
                <div class="row mb-4">
                    <label class="col-sm-3 col-form-label">Passport Photo</label>
                    <div class="col-sm-9">

                        @if (optional($documents)->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $documents->photo) }}"
                                     class="img-thumbnail"
                                     style="height:80px">
                            </div>
                        @else
                            <span class="badge bg-danger mb-2">N/A</span>
                        @endif

                        <input type="file" name="photo"
                            class="form-control @error('photo') is-invalid @enderror">

                        @error('photo')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                {{-- Declaration --}}
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="confirm"
                        {{ old('confirm') ? 'checked' : '' }} checked required>
                    <label class="form-check-label" for="confirm">
                        I confirm that the information provided is correct.
                    </label>
                </div>

                {{-- Submit --}}
                <div class="text-end">
                    <button class="btn btn-success px-4">
                        Save & Finish
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
