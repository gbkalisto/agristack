@extends('admin.layouts.app')
@section('title', 'Documents Upload')

@section('content')
    <div class="page-content">

        @include('admin.farmer.stepper', ['currentStep' => 6])

        <div class="card">
            <form method="POST" action="{{ route('admin.farmers.store.documents') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">

                    <h6 class="text-primary fw-bold mb-3">Documents Upload</h6>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Aadhaar Card</label>
                        <div class="col-sm-9">
                            <input type="file" name="aadhaar_file" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Land Papers</label>
                        <div class="col-sm-9">
                            <input type="file" name="land_papers" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Bank Passbook</label>
                        <div class="col-sm-9">
                            <input type="file" name="bank_passbook" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Passport Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            I declare that the information provided is correct.
                        </label>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">Submit Farmer Profile</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
