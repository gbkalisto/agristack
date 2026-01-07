@extends('layouts.app')

@section('content')
    <div class="page-content">
        @include('registry.partials.stepper', ['currentStep' => 6])
        <div class="card">
            <div class="card-header fw-bold">
                Step 6 of 6 – Document Upload
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('registry.store', 6) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Aadhaar Document</label>
                        <input type="file" name="aadhaar_document" class="form-control" required>
                    </div>

                    <button class="btn btn-success btn-lg">
                        Submit & Complete Registry
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
