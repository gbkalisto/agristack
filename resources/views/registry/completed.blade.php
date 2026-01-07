@extends('layouts.app')
@section('content')
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Farmer Registry
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white fw-bold">
                        <i class="bx bx-check-circle"></i>
                        Farmer Registry Completed
                    </div>

                    <div class="card-body">

                        <p class="mb-3">
                            Your farmer registry has been successfully completed.
                            You can view or print your registry details below.
                        </p>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">Farmer Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Registry ID</th>
                                    <td>{{ $user->uuid }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-success">
                                            Completed
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">
                                <i class="bx bx-show"></i> View Registry
                            </a>

                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bx bx-printer"></i> Print
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
