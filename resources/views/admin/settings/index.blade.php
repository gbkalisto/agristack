@extends('admin.layouts.app')
@section('title', 'Admin Settings')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Settings</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">
                            {{-- ================== GENERAL SETTINGS ================== --}}
                            <h5 class="mb-3">General Settings</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Site Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="site_name" class="form-control"
                                        value="{{ $settings['site_name'] ?? '' }}" placeholder="Site Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Site URL</label>
                                <div class="col-sm-9">
                                    <input type="text" name="site_url" class="form-control"
                                        value="{{ $settings['site_url'] ?? '' }}" placeholder="https://example.com">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Site Logo</label>
                                <div class="col-sm-9">
                                    @if (!empty($settings['logo']) && Storage::disk('public')->exists($settings['logo']))
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Site Logo"
                                                height="60">
                                        </div>
                                    @endif
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Favicon</label>
                                <div class="col-sm-9">
                                    @if (!empty($settings['favicon']) && Storage::disk('public')->exists($settings['favicon']))
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon"
                                                height="32">
                                        </div>
                                    @endif
                                    <input type="file" name="favicon" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Default Language</label>
                                <div class="col-sm-9">
                                    <input type="text" name="default_language" class="form-control"
                                        value="{{ $settings['default_language'] ?? 'en' }}" placeholder="en / fr / de">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Timezone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="timezone" class="form-control"
                                        value="{{ $settings['timezone'] ?? config('app.timezone') }}"
                                        placeholder="Asia/Kolkata">
                                </div>
                            </div>

                            {{-- ================== EMAIL SETTINGS ================== --}}
                            <h5 class="my-4">Email Settings</h5>
                            @php
                                $emailKeys = [
                                    'mail_driver',
                                    'mail_host',
                                    'mail_port',
                                    'mail_username',
                                    'mail_password',
                                    'mail_encryption',
                                    'mail_from_address',
                                    'mail_from_name',
                                ];
                            @endphp
                            @foreach ($emailKeys as $key)
                                <div class="row mb-3">
                                    <label
                                        class="col-sm-3 col-form-label">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="{{ $key }}" class="form-control"
                                            value="{{ $settings[$key] ?? '' }}" placeholder="{{ $key }}">
                                    </div>
                                </div>
                            @endforeach

                            {{-- ================== SECURITY SETTINGS ================== --}}
                            <h5 class="my-4">Security Settings</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Maintenance Mode</label>
                                <div class="col-sm-9">
                                    <select name="maintenance_mode" class="form-select">
                                        <option value="off"
                                            {{ ($settings['maintenance_mode'] ?? 'off') == 'off' ? 'selected' : '' }}>Off
                                        </option>
                                        <option value="on"
                                            {{ ($settings['maintenance_mode'] ?? 'off') == 'on' ? 'selected' : '' }}>On
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password Min Length</label>
                                <div class="col-sm-9">
                                    <input type="number" name="password_min_length" class="form-control"
                                        value="{{ $settings['password_min_length'] ?? 8 }}" placeholder="Minimum Length">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Max Login Attempts</label>
                                <div class="col-sm-9">
                                    <input type="number" name="max_login_attempts" class="form-control"
                                        value="{{ $settings['max_login_attempts'] ?? 5 }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Lockout Duration (min)</label>
                                <div class="col-sm-9">
                                    <input type="number" name="lockout_duration" class="form-control"
                                        value="{{ $settings['lockout_duration'] ?? 15 }}">
                                </div>
                            </div>

                            {{-- ================== USER SETTINGS ================== --}}
                            <h5 class="my-4">User Settings</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Default User Role</label>
                                <div class="col-sm-9">
                                    <input type="text" name="default_user_role" class="form-control"
                                        value="{{ $settings['default_user_role'] ?? 'user' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Allow Registration</label>
                                <div class="col-sm-9">
                                    <select name="allow_user_registration" class="form-select">
                                        <option value="yes"
                                            {{ ($settings['allow_user_registration'] ?? 'yes') == 'yes' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="no"
                                            {{ ($settings['allow_user_registration'] ?? 'yes') == 'no' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email Verification</label>
                                <div class="col-sm-9">
                                    <select name="user_email_verification" class="form-select">
                                        <option value="yes"
                                            {{ ($settings['user_email_verification'] ?? 'yes') == 'yes' ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="no"
                                            {{ ($settings['user_email_verification'] ?? 'yes') == 'no' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div>
                            </div>

                            {{-- ================== SEO SETTINGS ================== --}}
                            <h5 class="my-4">SEO Settings</h5>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Meta Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ $settings['meta_title'] ?? '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea name="meta_description" rows="3" class="form-control">{{ $settings['meta_description'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Meta Keywords</label>
                                <div class="col-sm-9">
                                    <input type="text" name="meta_keywords" class="form-control"
                                        value="{{ $settings['meta_keywords'] ?? '' }}">
                                </div>
                            </div>

                            {{-- ================== ACTION BUTTONS ================== --}}
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        {{-- <button type="submit" class="btn btn-primary px-4">Save Settings</button> --}}
                                        <button type="submit"
                                            class="btn btn-primary submit-btn px-4 justify-content-center">
                                            <span class="submit-text">Save Settings</span>
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
