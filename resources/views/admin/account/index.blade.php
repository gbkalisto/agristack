@extends('admin.layouts.app')
@section('title', 'Admin Users')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admins</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Users</li>
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
                        <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">Create Account</a>
                        <!-- Search Form -->
                        <form method="GET" class="d-flex" role="search">
                            <input type="search" name="search" class="form-control" placeholder="Search Accounts..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary ms-2" type="submit">Search</button>
                            <a href="{{ route('admin.accounts.index') }}" class="btn btn-outline-danger ms-2">Reset</a>
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
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <th scope="row">{{ $account->id }}</th>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->user_name }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->mobile }}</td>
                                        <td>{{ $account->role }}</td>
                                        <td>{{ $account->division->name ?? '-' }}</td>
                                        <td>{{ $account->district->name ?? '-' }}</td>
                                        <td>{{ $account->block->name ?? '-' }}</td>

                                        <td>
                                            <a href="{{ route('admin.accounts.edit', $account->id) }}"
                                                class="btn btn-sm btn-primary" title="Edit"><i class="bx bx-edit"></i></a>
                                            <form action="{{ route('admin.accounts.destroy', $account->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
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
@endsection
