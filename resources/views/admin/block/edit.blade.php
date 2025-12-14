@extends('admin.layouts.app')
@section('title', 'Edit Block')

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
                            <a href="{{ route('admin.blocks.index') }}">Blocks</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Block</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <a href="{{ route('admin.blocks.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.blocks.update', $block->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4">

                            {{-- Division Select --}}
                            <div class="row mb-3">
                                <label for="division_id" class="col-sm-3 col-form-label">
                                    Select Division (Mandal) <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id"
                                        class="form-control @error('division_id') is-invalid @enderror">
                                        <option value="">-- Select Division --</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ (old('division_id') ?? ($block->district->division_id ?? null)) == $division->id ? 'selected' : '' }}>
                                                {{ $division->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- District Select --}}
                            <div class="row mb-3">
                                <label for="district_id" class="col-sm-3 col-form-label">
                                    Select District <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id"
                                        class="form-control @error('district_id') is-invalid @enderror">
                                        <option value="">-- Select District --</option>

                                        {{-- Preload districts for the selected division --}}
                                        @php
                                            $selectedDivisionId = old('division_id') ?? ($block->district->division_id ?? null);
                                        @endphp

                                        @if ($selectedDivisionId)
                                            @php
                                                $selectedDivision = $divisions->where('id', $selectedDivisionId)->first();
                                            @endphp

                                            @if ($selectedDivision)
                                                @foreach ($selectedDivision->districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ (old('district_id') ?? $block->district_id) == $district->id ? 'selected' : '' }}>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endif
                                    </select>
                                    @error('district_id')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Block Name --}}
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">
                                    Enter Block Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-map"></i>
                                        </span>
                                        <input type="text"
                                            name="name"
                                            id="name"
                                            placeholder="Block Name"
                                            value="{{ old('name', $block->name) }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Buttons --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary submit-btn px-4">
                                            <span class="submit-text">Update</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"
                                                  role="status" aria-hidden="true"></span>
                                        </button>
                                        <a href="{{ route('admin.blocks.index') }}" class="btn btn-light px-4">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Helper to fetch and populate districts for a division
    function loadDistricts(divisionId, selectedDistrictId = null) {
        const districtDropdown = document.getElementById('district_id');
        districtDropdown.innerHTML = `<option value="">Loading...</option>`;

        if (!divisionId) {
            districtDropdown.innerHTML = `<option value="">-- Select District --</option>`;
            return;
        }

        fetch(`/admin/districtsby/${divisionId}`)
            .then(response => response.json())
            .then(data => {
                districtDropdown.innerHTML = `<option value="">-- Select District --</option>`;
                data.forEach(function (district) {
                    const selected = (selectedDistrictId && selectedDistrictId == district.id) ? 'selected' : '';
                    districtDropdown.innerHTML +=
                        `<option value="${district.id}" ${selected}>${district.name}</option>`;
                });
            })
            .catch(() => {
                districtDropdown.innerHTML = `<option value="">-- Select District --</option>`;
            });
    }

    // On division change, load districts
    document.getElementById('division_id').addEventListener('change', function () {
        loadDistricts(this.value);
    });

    // On page load, ensure districts for the pre-selected division are loaded (if any)
    document.addEventListener('DOMContentLoaded', function () {
        const selectedDivision = document.getElementById('division_id').value;
        const selectedDistrict = "{{ old('district_id', $block->district_id) }}";

        if (selectedDivision) {
            // If districts are already present in the DOM (preloaded), do nothing.
            // Otherwise fetch and select the current district.
            const hasOptions = document.getElementById('district_id').options.length > 1;
            if (!hasOptions) {
                loadDistricts(selectedDivision, selectedDistrict);
            }
        }
    });
</script>
@endpush
