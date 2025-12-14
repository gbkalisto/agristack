@extends('admin.layouts.app')
@section('title', 'Create Role')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="card-body p-4">

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="input49" class="col-sm-3 col-form-label">Enter Role Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text @error('name') border border-danger text-danger @enderror">
                                            <i class="bx bx-user-check"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Role Name" id="roleName"
                                            value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Active Checkbox --}}
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Assign Permissions</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="select_all" id="select_all">
                                        <label class="form-check-label" for="select_all"><b>Select All</b></label>
                                    </div>
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" name="permissions[]" type="checkbox"
                                                value="{{ $permission->name }}" id="permission_{{ $permission->id }}">
                                            <label class="form-check-label"
                                                for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Active Checkbox --}}

                            {{-- Submit Buttons --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit"
                                            class="btn btn-primary submit-btn px-4 justify-content-center">
                                            <span class="submit-text">Submit</span>
                                            <span class="spinner-border spinner-border-sm d-none submit-spinner"
                                                role="status" aria-hidden="true"></span>
                                        </button>
                                        <button type="reset" class="btn btn-light px-4">Reset</button>
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
