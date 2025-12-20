@extends('admin.layouts.app')
@section('title', 'Farmers')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Account</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Farmers</li>
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
                        <!-- LEFT: Action Buttons -->
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Add Farmer</a>
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Import Block
                            </button> --}}
                        </div>
                        <!-- Search Form -->
                        <form method="GET" class="d-flex" role="search">
                            <input type="search" name="search" class="form-control" placeholder="Search blocks..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary ms-2" type="submit">Search</button>
                            <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-danger ms-2">Reset</a>
                        </form>


                    </div>



                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Filled By</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($farmers as $farmer)
                                {{-- @php
                                    dd($farmer);
                                @endphp --}}
                                    <tr>
                                        <th scope="row"> {{ $farmer->id }} </th>
                                        <td>{{ ucfirst($farmer->name) }}</td>
                                        <td>{{ $farmer->phone }}</td>
                                        <td>{{ ucfirst($farmer->gender) }}</td>
                                        <td>{{ ucfirst($farmer->category) }}</td>
                                        <td>{{ ucfirst($farmer->dob) }}</td>
                                        <td>{{ ucfirst($farmer->district->name) }}</td>
                                        <td>{{ ucfirst($farmer->filledByAdmin->name) }}</td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-sm btn-primary" title="Edit"><i class="bx bx-edit"></i></a>
                                            <form action="#" method="POST"
                                                class="d-inline">
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
                            @if ($farmers->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $farmers->links('pagination::bootstrap-5') }}
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
