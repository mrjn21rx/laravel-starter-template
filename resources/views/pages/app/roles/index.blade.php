@extends('layouts.app')

@section('title', 'Blank Page')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Hak Akses</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Hak Akses</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('app.roles.index') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="q"
                                            placeholder="cari berdasarkan nama permissions">
                                        <button class="btn btn-primary input-group-text" type="submit">
                                            <i class="fa fa-search me-2 text-white"></i>
                                        </button>
                                        <button class="btn btn-primary input-group-text" onclick="resetPage()">
                                            <i class="fas fa-sync-alt me-2 text-white"></i>
                                        </button>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-m">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%">No</th>
                                                <th scope="col">Nama Hak Akses</th>
                                                <th scope="col">Nama Hak Izin</th>
                                                <th scope="col" style="width: 15%">Pilihan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $no => $role)
                                                <tr>
                                                    <th scope="row">
                                                        {{ ++$no + ($roles->currentPage() - 1) * $roles->perPage() }}
                                                    </th>
                                                    <td>
                                                        {{ $role->name }}
                                                    </td>
                                                    <td>
                                                        @foreach ($role->permissions as $permission)
                                                            <span
                                                                class="badge badge-primary shadow border-0 ms-2 mb-1 mt-1">
                                                                {{ $permission->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">

                                                        @can('roles.edit')
                                                            <a href="#" class="btn btn-success btn-sm">
                                                                <i class="fa fa-pencil-alt me-1" title="Edit Hak Akses">
                                                                </i>
                                                            </a>
                                                        @endcan
                                                        @can('roles.delete')
                                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                                    title="Hapus Hak Akses"></i>
                                                            </button>
                                                        @endcan

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer pull-right">
                                {{ $roles->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Hak Akses</h4>
                            </div>
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Message</label>
                                        <textarea class="form-control" data-height="150" required=""></textarea>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                        <button class="btn btn-sm btn-warning" type="reset">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        function resetPage() {
            window.location.reload();
        }
    </script>
    <!-- Page Specific JS File -->
@endpush
