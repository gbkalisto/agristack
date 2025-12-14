@extends('admin.layouts.app')
@section('title', 'Edit District')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.districts.index') }}">Districts</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit District</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <a href="{{ route('admin.districts.index') }}" class="btn btn-secondary btn-sm">Back to list</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.districts.update', $district->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body p-4">

                            {{-- Division select --}}
                            <div class="row mb-3">
                                <label for="division_id" class="col-sm-3 col-form-label">
                                    Select Division (Mandal) <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id"
                                        class="form-control @error('division_id') is-invalid @enderror">

                                        <option value="">-- Select Division --</option>

                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ old('division_id', $district->division_id) == $division->id ? 'selected' : '' }}>
                                                {{ $division->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('division_id')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- District Name --}}
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">
                                    District Name <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-map"></i>
                                        </span>

                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name"
                                            id="name"
                                            value="{{ old('name', $district->name) }}"
                                            placeholder="District Name">
                                    </div>

                                    @error('name')
                                        <div class="text-danger mt-1">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Buttons --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>

                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit"
                                            class="btn btn-primary submit-btn px-4 justify-content-center">
                                            <span class="submit-text">Update</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"
                                                role="status" aria-hidden="true"></span>
                                        </button>

                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                    </div>
                                </div>
                            </div>

                        </div> {{-- card-body --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
