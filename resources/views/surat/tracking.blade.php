@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Surat Pengantar</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Surat Pengajuan</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tracking Status Surat</li>
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
    @include('components.message')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-2">Tracking Status Surat</h2>
            <h6 class="card-subtitle mt-2">
                Lihat Status Persetujuan Surat Pengantar
            </h6>
            {{-- <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data Santri Baru</button> --}}

            <div class="table-responsive">
                <table id="table_data" class="table table-hover table-bordered display no-wrap" style="width:100%">
                    <thead class=" ">
                        <tr>
                            <th>No</th>
                            <th>Anggota Keluarga</th>
                            <th>Keperluan Surat</th>
                            <th>Keterangan</th>
                            <th>Sudah Disetujui RT ?</th>
                            <th>Sudah Disetujui RW ?</th>
                            <th>Edit/Hapus</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($surat != null)

                        @endif
                        @forelse ($surat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->keperluan }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if ($item->is_rt_approved == 0)
                                        <button type="button"
                                            class="btn waves-effect waves-light btn-rounded btn-outline-danger">Belum
                                            Disetujui</button>
                                    @endif
                                    @if ($item->is_rt_approved == 1)
                                        <button type="button"
                                            class="btn waves-effect waves-light btn-rounded btn-outline-success">Disetujui</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_rw_approved == 0)
                                        <button type="button"
                                            class="btn waves-effect waves-light btn-rounded btn-outline-danger">Belum
                                            Disetujui</button>
                                    @endif
                                    @if ($item->is_rw_approved == 1)
                                        <button type="button"
                                            class="btn waves-effect waves-light btn-rounded btn-outline-success">Disetujui</button>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::guard('keluarga')->check())
                                        @if ($item->is_rt_approved == 1 && $item->is_rw_approved == 1)
                                            <p>Surat Yang Sudah Disetujui RT/RW Tidak Dapat Dibatalkan</p>
                                        @else
                                            <div class="d-flex">
                                                <a href='{{ url("/keluarga/$item->id_keluarga/surat/$item->id/edit") }}'>
                                                    <button type="button" class="btn btn-warning btn-circle-lg mr-2"><i
                                                            class="fas fa-pencil-alt"></i> </button>
                                                </a>
                                                <button type="button" class="btn btn-warning btn-circle-lg "><i
                                                        class="fa fa-trash"></i> </button>
                                            </div>
                                        @endif

                                    @else
                                        <a href='{{ url("surat/$item->id/edit") }}'>
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Lihat
                                                Surat</button>
                                        </a>

                                    @endif

                                </td>
                                <td>
                                    @if($item->is_rt_approved == 1 && $item->is_rw_approved == 1)                                 
                                    <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#download-modal">Download
                                        Surat</button>
                                @else
                                    <button class="btn btn-secondary">Tidak Dapat Download</button>
                                @endif
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


    <!-- Destroy Modal -->
    <div class="modal fade" id="download-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Anda ingin mendownload file ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Download file sesuai kebutuhan anda</h5>
                </div>
                <div class="modal-footer">
                <a href='{{url("keluarga/download/raw/$item->id")}}'>
                    <button type="button" class="btn btn-primary">Download Mentah</button>
                </a>
                <a href='{{url("keluarga/download/$item->id")}}'>
                    <button type="button" class="btn btn-success">Download beserta Validasi</button>
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->



@endsection


@section('app-script')
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




<script type="text/javascript">
    function imgError(image) {
        image.onerror = "";
        image.src = window.location.origin + "/static_img/error.jpg"
        return true;
    }

    $(function() {
        var table = $('#table_data').DataTable({
            processing: true,
            serverSide: false,
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
                    title: 'Data RT {{ \Carbon\Carbon::now()->year }}'
                },
                'csvHtml5',
            ],

        });



        $('body').on("click", ".btn-delete", function() {
            var id = $(this).attr("id")
            $(".btn-destroy").attr("id", id)
            $("#destroy-modal").modal("show")
        });


    });

</script>




@endsection
