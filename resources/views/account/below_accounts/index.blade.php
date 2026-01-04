@extends('account.layouts.app')
@section('title', 'Blocks')

@section('content')
    @php
        $role = auth('account')->user()->role;
    @endphp
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Account</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Below Accounts</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <!-- Add User Button -->

                        <div class="d-flex gap-2">
                            @if ($role === 'block_admin')
                                <a href="{{ route('account.farmers.create') }}" class="btn btn-primary">Add Farmer</a>
                            @endif
                        </div>
                        <!-- Search Form -->
                        <form method="GET" class="d-flex" role="search">
                            <input type="search" name="search" class="form-control" placeholder="Search Accounts..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary ms-2" type="submit">Search</button>
                            <a href="{{ route('account.below.accounts') }}" class="btn btn-outline-danger ms-2">Reset</a>
                        </form>


                    </div>
                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Block</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <th scope="row"> {{ $account->id }} </th>
                                        <td>{{ ucfirst($account->name) }}</td>
                                        <td>{{ $account->user_name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->mobile }}</td>
                                        <td>
                                            @if ($account->role == 'Admin')
                                                <span class="badge bg-primary">Admin</span>
                                            @elseif($account->role == 'block_admin')
                                                <span class="badge bg-secondary">Block Admin</span>
                                            @elseif($account->role == 'district_admin')
                                                <span class="badge bg-success">District Admin</span>
                                            @elseif($account->role == 'division_admin')
                                                <span class="badge bg-warning text-dark">Division Admin</span>
                                            @else
                                                <span class="badge bg-info text-dark">{{ $account->role }}</span>
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($account->division->name ?? '-') }}</td>
                                        <td>{{ ucfirst($account->district->name ?? '-') }}</td>
                                        <td>{{ ucfirst($account->block->name ?? '-') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- apply pagination  --}}
                            @if ($accounts->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $accounts->links('pagination::bootstrap-5') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Import Blocks</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.blocks.import') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="from-control">
                            {{-- <label for="">Import Division</label> --}}
                            <input type="file" name="file" class="form-control" required accept=".xlsx,.xls,.csv">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
