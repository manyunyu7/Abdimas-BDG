@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">RT
                {{ $rw->kode }}</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html">Manage Tanda Tangan</a>
                        </li>
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
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->


    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

    <div class="col-md-12">
        @include('components.message')
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white rounded-top">
                <h4 class="mb-0 "> Upload Tanda Tangan Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('rw/new-ttd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_rw" value="{{ $rw->id }}">

                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="photo" class="form-control-file" id="exampleInputFile"
                                accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>

                    <button type="submit" class="btn  waves-effect waves-light  btn-rounded btn-outline-success">Simpan
                        Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white rounded-top">
                <h4 class="mb-0 ">Ketentuan Tanda Tangan (PENTING)</h4>
            </div>

            <div class="mt-4">
                <ol>
                    <li>
                        Tanda tangan yang akan digunakan pada surat warga adalah tanda tangan dengan tanggal terbaru
                    </li>

                    <li>Tanda Tangan harus <strong>tidak memiliki background warna apapun (transparan) </strong>seperti pada gambar dibawah <br>
                        <img style="border-radius:10px !important" class="center-cropped rounded"
                            src="{{ url('/') }}/static_img/example_ttd.png" alt=""
                            onerror="this.onerror=null;this.src='{{ url('/') }}img/onerror.png';">

                    </li>

                    <li>
                        Untuk Pengarsipan, Tanda Tangan yang sudah diinput tidak dapat dihapus, pastikan mengupload tanda
                        tangan yang sesuai
                    </li>
                    <li>
                        Untuk membuat tanda tangan dengan background transparan, anda dapat menggunakan situs 
                        <a href="https://onlinesignature.com/draw-a-signature-online">Ini</a>
                    </li>
          
                </ol>
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white rounded-top">
                <h4 class="mb-0 ">Arsip Tanda Tangan</h4>
            </div>
            <div class="card-body">
                <table id="table_data" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($ttd as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    <img style="border-radius:10px !important" class="center-cropped rounded"
                                        src="{{ url('/') }}{{ $item->path }}" alt=""
                                        onerror="this.onerror=null;this.src='{{ url('/') }}img/onerror.png';">
                                </td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Belum Ada Data</strong>
                            </div>

                            <script>
                                $(".alert").alert();

                            </script>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
@endsection

@section('app-script')
{{-- @include('admin.dashboard.script') --}}
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
</script>
<script>
    $(function() {
        var table = $('#table_data').DataTable({
            processing: true,
            columnDefs: [{
                orderable: true,
                targets: 0
            }],
            dom: 'T<"clear">lfrtip<"bottom"B>',
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            buttons: [
                'copyHtml5',
                {
                    extend: 'excelHtml5',
                    title: 'Data Tanda Tangan {{ \Carbon\Carbon::now()->year }}'
                },
                'csvHtml5',
            ],

        });




    });

</script>

@endsection
