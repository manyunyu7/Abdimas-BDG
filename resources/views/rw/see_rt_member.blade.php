@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-12 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Keluarga di RT</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">RW {{ $rw->kode }}</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Daftar Rukun Tetangga</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">Daftar Rukun Tetangga di RW {{ $rw->kode }}</h2>
            {{-- <h6 class="card-subtitle mt-2">
        Edit Data Anggota Keluarga
        </h6> --}}
            {{-- <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data Santri Baru</button> --}}

            <div class="table-responsive mt-4">
                <table id="table_data" class="table table-hover table-success table-bordered display no-wrap"
                    style="width:100%">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>No</th>
                            <th>Kode RT</th>
                            <th>Kontak RT</th>
                            <th>Alamat</th>
                            <th>Lihat Keluarga</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($rt as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->kontak }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href='{{url("rt/$item->id/keluarga")}}'>
                                        <button type="button" class="btn btn-warning">Lihat Keluarga</button>
                                    </a>
                                </td>
                            </tr>
                        @empty

                        @endforelse



                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('app-script')
{{-- @include('admin.dashboard.script') --}}
@endsection
