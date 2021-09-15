@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Keluarga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Anggota Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Lihat Detail Anggota</li>
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


    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Anggota Keluarga : {{ $member->nama }}</h4>
        </div>
        <div class="card-body">
            <form action='{{ url("/member/$member->id/update") }}' method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $member->id }}">

                
                <img class="img-fluid" style="border-radius:30px !important; " class="center-cropped rounded"
                    src="{{ url('/') . $member->path_ktp }}" alt="">


                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input readonly type="text" class="form-control" required name="nama" placeholder="Nama Lengkap"
                        value="{{ $member->nama }}">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>

                <div class="form-group">
                    <label for="">Nomor Induk Kependudukan</label>
                    <input readonly type="text" class="form-control" required name="nik" placeholder="Nomor Induk Kependudukan"
                        value="{{ $member->nik }}">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>

                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select disabled required class="form-control" name="gender">
                        <option value="1" @if ($member->gender == '1') selected @endif>Laki-Laki</option>
                        <option value="2" @if ($member->gender == '2') selected @endif>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Tempat Lahir</label>
                    <input readonly required type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir"
                        value="{{ $member->tempat_lahir }}">
                    <small class="form-text text-muted">Kota Kelahiran</small>
                </div>


                <div class="form-group">
                    <label for="">Tanggal Kelahiran</label>
                    <input readonly type="date" class="form-control" name="tanggal_lahir"
                        value="{{ date('Y-m-d', strtotime(str_replace('-', '/', $member->tanggal_lahir))) }}">
                    <small class="form-text text-muted">Tanggal Kelahiran</small>
                </div>

                <div class="form-group">
                    <label for="">Agama</label>
                    <input readonly required type="text" class="form-control" name="agama" placeholder="Agama"
                        value="{{ $member->agama }}">
                    <small class="form-text text-muted">Agama ( Sesuai KTP ) </small>
                </div>

                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <input readonly required type="text" class="form-control" name="pendidikan" placeholder="Pendidikan"
                        value="{{ $member->pendidikan }}">
                    <small class="form-text text-muted">Pendidikan ( Sesuai KTP ) </small>
                </div>

                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <input readonly required type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan"
                        value="{{ $member->pekerjaan }}">
                    <small class="form-text text-muted">Pekerjaan</small>
                </div>

                <div class="form-group">
                    <label for="">Alamat Saat Ini</label>
                    <textarea readonly class="form-control" placeholder="Alamat Anggota Keluarga" name="alamat" id=""
                        rows="5">{{ $member->current_address }}</textarea>
                </div>

            </form>
        </div>
    </div>







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
            var table = $('#table_santri').DataTable({
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
                        title: 'Data Santri Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
                ajax: {
                    type: "get",
                    url: "{{ url('admin/data/santri/manage') }}",
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
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'asrama',
                        name: 'asrama'
                    },
                    {
                        data: 'jenjang',
                        name: 'jenjang'
                    },
                    {
                        data: 'action',
                        name: 'action',
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

            $('body').on("click", ".btn-add-new", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#insert-modal").modal("show")
            });


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.id)
                        $("#name").val(response.judul)
                        $("#edit_date").val(response.tanggal)
                        $("#role").val(response.role)
                    }
                })
            });

            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });

    </script>




@endsection
