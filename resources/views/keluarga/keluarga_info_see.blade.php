@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Keluarga</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Info</li>
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


    {{-- @if ($keluarga->photo_kartu_keluarga == null)
        <div class="alert alert-danger" role="alert">
            <strong>Silakan Lengkapi Foto Kartu Keluarga Sebelum Melanjutkan</strong>
        </div>
    @endif --}}

    @include('components.message')

    <section id="photoKK">

        <div class="card ">
            <div class="card-header bg-success">
                <h4 class="mb-0 text-white">Foto Kartu Keluarga</h4>
            </div>
            {{-- <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Foto Kartu Keluarga</h4>
        </div> --}}
            <img class="card-img-top img-fluid" style=" !important" src="{{ url('/') . $keluarga->photo_kartu_keluarga }}"
                alt="Card image cap"
                onerror="this.src='http://www.pallenz.co.nz/assets/camaleon_cms/image-not-found-4a963b95bf081c3ea02923dceaeb3f8085e1a654fc54840aac61a57a60903fef.png'">

            <div class="card-body">

                <form action="{{ url('/keluarga/changeKKPhoto') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="card-title">Foto Kartu Keluarga</h3>
                    <p class="card-text">Upload atau Ganti Foto Kartu Keluarga Dengan Mengupload Pada Tombol Dibawah</p>
                </form>

            </div>
        </div>

    </section>

    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Informasi Keluarga</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/keluarga/updateData') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::guard('keluarga')->id() }}">
                <h3 class="card-title">Data Keluarga Anda</h3>
                {{-- <p class="card-text">With supporting text below as a natural lead-in to additional
                    content.</p> --}}
                <div class="form-group">
                    <label for="">Nama Keluarga</label>
                    <input readonly type="text" class="form-control" name="nama" id="" value="{{ $keluarga->nama }}"
                        placeholder="Nama Keluarga">
                    <small class="form-text text-muted">Nama Kelurga</small>
                </div>
                <div class="form-group">
                    <label for="">Nomor KK</label>
                    <input readonly type="text" class="form-control" required name="no_kk" id=""
                        value="{{ $keluarga->no_kk }}" placeholder="Nomor Kartu Keluarga">
                    <small class="form-text text-muted">Nomor Kartu Keluarga</small>
                </div>

                <div class="form-group">
                    <label for="">Nomor Telepon ( Digunakan Untuk Login )</label>
                    <input readonly type="text" class="form-control" required name="kontak" id=""
                        value="{{ $keluarga->kontak }}" placeholder="Nomor Telepon">
                    <small class="form-text text-muted">Kontak</small>
                </div>

                <div class="form-group">
                    <label for="">Asal Yuridiksi RT</label>
                    <input readonly type="text"
                        value="{{ $keluarga->rt_detail->kode . '-' . $keluarga->rt_detail->rw_detail->kode }}"
                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                </div>


                <div class="form-group">
                    <label for="">Alamat Utama</label>
                    <textarea readonly class="form-control" name="alamat" id=""
                        rows="5">{{ $keluarga->alamat }}</textarea>
                </div>

            </form>
        </div>
    </div>

    <section id="photoKK">

        <div class="card ">
            <div class="card-header bg-success">
                <h4 class="mb-0 text-white">Anggota Keluarga</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="table_data" class="table table-hover table-success table-bordered display no-wrap"
                        style="width:100%">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>No</th>
                                <th>Foto KTP</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Gender</th>
                                <th>Tempat Lahir</th>
                                <th>Pekerjaan</th>
                                <th>Pendidikan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
    
                        </tbody>
                        <tfoot>
    
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </section>








    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
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
    $(function() {
        var table = $('#table_data').DataTable({
            processing: true,
            serverSide: true,
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
            ajax: {
                async : false,
                type: "get",
                url: "{{ url('keluarga/getAnggotaAjax').'/'.$keluarga->id }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                async: true,
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'img',
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                },
                {
                    data: 'gender',
                },
                {
                    data: 'tempat_lahir',
                },
                {
                    data: 'pekerjaan',
                },
                {
                    data: 'pendidikan',
                },
                {
                    data: 'detail',
                    name: 'detail',
                    orderable: true,
                    searchable: true
                },

            ]
        });

        $('body').on("click", ".btn-delete", function() {
            var id = $(this).attr("id")
            $(".btn-destroy").attr("id", id)
            $("#destroy-modal").modal("show")
        });


    });


    $(".btn-destroy").on("click", function() {
        var id = $(this).attr("id")
        console.log(id);
        $.ajax({
            url: "{{ URL::to('/') }}/member/"+id+"/deleteAjax",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
            },
            method: "DELETE",
            success: function(response) {

                if (response == 1) {
                    swal("Sukses", "Berhasil Menghapus Anggota Keluarga", "success");
                } else {
                    swal("Error", "Gagal Menghapus Anggota Keluarga ", "error");
                }
                console.log(response);
                $("#destroy-modal").modal("hide")
                $('#table_data').DataTable().ajax.reload();
            },
            error: function(xhr, error, code) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(error);
                console.log(err);
                swal("Error", "Gagal Menghapus Anggota Keluarga ", "error");
            }
        });
    })



</script>




@endsection