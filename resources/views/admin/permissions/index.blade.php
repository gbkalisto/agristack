@extends('admin.layouts.app')
@section('title', 'Permissions Management')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Permissions</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <!-- Add permission Button -->
                        @can('create permissions')
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Add Permission</a>
                        @endcan
                        <!-- Search Form -->
                        <form method="GET" class="d-flex" role="search">
                            <input type="search" name="search" class="form-control" placeholder="Search Permission..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary ms-2" type="submit">Search</button>
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-danger ms-2">Reset</a>
                        </form>


                    </div>
                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $permission->name }}</td>

                                        <td>
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                class="btn btn-sm btn-primary" title="Edit"><i class="bx bx-edit"></i></a>
                                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this permission?')"
                                                    class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- apply pagination  --}}
                            @if ($permissions->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $permissions->links('pagination::bootstrap-5') }}
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
