@extends('account.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Account Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        @if ($account->profile_picture)
                                            <img src="{{ asset('storage/' . $account->profile_picture) }}" alt="Admin"
                                                class="rounded-circle p-1 bg-primary" width="110">
                                        @else
                                            <img src="{{ asset('theme') }}/images/avatars/avatar-2.png" alt="Admin"
                                                class="rounded-circle p-1 bg-primary" width="110">
                                        @endif
                                        <div class="mt-3">
                                            <h4>{{ $account->name }}</h4>
                                            <p class="text-secondary mb-1">{{ $account->email }}</p>
                                            <p class="text-muted font-size-sm">{{ $account->address }}</p>
                                            {{-- <button class="btn btn-primary">Follow</button> --}}
                                            <button class="btn btn-outline-primary">Active</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $account->name) }}">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">User Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="user_name"
                                                    class="form-control @error('user_name') is-invalid @enderror"
                                                    value="{{ old('user_name', $account->user_name) }}">
                                                @error('user_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $account->email) }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="tel"
                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                    name="mobile" value="{{ old('mobile', $account->mobile) }}"
                                                    pattern="[0-9]{10}" maxlength="10"
                                                    placeholder="Enter 10-digit mobile number"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                @error('mobile')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Role</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select name="role" id="role" class="form-control ">
                                                    <option value="admin" {{ $account->role == 'admin' ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="division_admin" {{ $account->role == 'division_admin' ? 'selected' : '' }}>Division Admin
                                                    </option>
                                                    <option value="district_admin" {{ $account->role == 'district_admin' ? 'selected' : '' }}>District Admin
                                                    </option>
                                                    <option value="block_admin" {{ $account->role == 'block_admin' ? 'selected' : '' }}>Block
                                                        Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Profile picture</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control" type="file" name="profile_picture"
                                                    accept=".jpg, .png, image/jpeg, image/png" multiple>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="********">
                                                <small class="text-danger">leave blank if you do not want to update</small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit"
                                                    class="btn btn-primary submit-btn px-4 justify-content-center">
                                                    <span class="submit-text">Save Changes</span>
                                                    <span class="spinner-border spinner-border-sm d-none submit-spinner"
                                                        role="status" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-12">
                                    <div class="card shadow border-0" id="two-fa-box">
                                        <div class="card-body">
                                            <h5 class="mb-3 d-flex align-items-center text-primary">
                                                <i class="bx bx-shield-quarter me-2 fs-4"></i> Two-Factor Authentication
                                            </h5>

                                            <p class="mb-2">Add an extra layer of security to your admin account by
                                                enabling Two-Factor Authentication (2FA).</p>
                                            <p class="text-muted">
                                                Once enabled, you will be prompted to enter a 6-digit code from your
                                                <strong>Google Authenticator</strong> app
                                                in addition to your password when logging in.
                                            </p>

                                            <div id="fa-status">
                                                @if ($account->google2fa_secret)
                                                    <div class="alert alert-success d-flex align-items-center gap-2 py-2"
                                                        role="alert">
                                                        <i class="bx bx-check-shield fs-5 text-success"></i>
                                                        <div>Two-Factor Authentication is currently
                                                            <strong>enabled</strong>.
                                                        </div>
                                                    </div>
                                                    <form id="disable2faForm" method="POST">
                                                        @csrf
                                                        <button type="submit" id="disable2faBtn"
                                                            class="btn btn-outline-danger">
                                                            <span class="btn-text"><i class="bx bx-shield-x me-1"></i>
                                                                Disable 2FA</span>
                                                            <span class="spinner-border spinner-border-sm d-none"
                                                                role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <div class="alert alert-warning d-flex align-items-center gap-2 py-2"
                                                        role="alert">
                                                        <i class="bx bx-error-circle fs-5 text-warning"></i>
                                                        <div>Two-Factor Authentication is currently
                                                            <strong>disabled</strong>.
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('admin.2fa.enable') }}" method="GET"
                                                        class="mt-3">
                                                        @csrf
                                                        <button class="btn btn-primary">
                                                            <i class="bx bx-shield-plus me-1"></i> Enable 2FA
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('disable2faForm');
                if (!form) return;

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const btn = document.getElementById('disable2faBtn');
                    const text = btn.querySelector('.btn-text');
                    const spinner = btn.querySelector('.spinner-border');

                    text.classList.add('d-none');
                    spinner.classList.remove('d-none');

                    try {
                        const response = await fetch("{{ route('admin.2fa.disable') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                                'Accept': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            // Replace the content of #fa-status with updated status
                            document.getElementById('fa-status').innerHTML = `
                    <div class="alert alert-warning d-flex align-items-center gap-2 py-2" role="alert">
                        <i class="bx bx-error-circle fs-5 text-warning"></i>
                        <div>Two-Factor Authentication is now <strong>disabled</strong>.</div>
                    </div>
                    <form action="{{ route('admin.2fa.enable') }}" method="GET" class="mt-3">
                        @csrf
                        <button class="btn btn-primary">
                            <i class="bx bx-shield-plus me-1"></i> Enable 2FA
                        </button>
                    </form>
                `;
                        } else {
                            alert(result.message || 'Failed to disable 2FA. Please try again.');
                        }
                    } catch (error) {
                        alert('An error occurred. Please check your connection or try again.');
                    } finally {
                        text.classList.remove('d-none');
                        spinner.classList.add('d-none');
                    }
                });
            });
        </script>
    @endpush
@endsection
