@extends('admin.layouts.app')
@section('title', 'Roles Management')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Roles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
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
                        {{-- @can('create roles') --}}
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add Role</a>
                        {{-- @endcan --}}
                        <!-- Search Form -->
                        <form method="GET" class="d-flex" role="search">
                            <input type="search" name="search" class="form-control" placeholder="Search Roles..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary ms-2" type="submit">Search</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-danger ms-2">Reset</a>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td >{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge bg-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- apply pagination  --}}
                            @if ($roles->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $roles->links('pagination::bootstrap-5') }}
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
