@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Anggota Keluarga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Anggota Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah</li>
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
            <h4 class="mb-0 text-white">Tambah Anggota Keluarga Baru</h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">Keluarga : {{$keluarga->nama}}</h3>

            <h4>Tambah Anggota Keluarga Baru</h4>

            <hr>

            <form action="{{ url('keluarga/'.$keluarga->id.'/anggota/simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $keluarga->id }}">
                
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" required name="nama" 
                        placeholder="Nama Lengkap">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>
                
                <div class="form-group">
                    <label for="">Nomor Induk Kependudukan</label>
                    <input type="text" class="form-control" required name="nik" 
                        placeholder="Nomor Induk Kependudukan">
                    <small class="form-text text-muted">Nama Lengkap</small>
                </div>

                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <select required class="form-control" name="gender">
                    <option value="1">Laki-Laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Tempat Lahir</label>
                    <input required type="text" class="form-control" name="tempat_lahir" 
                        placeholder="Tempat Lahir">
                    <small class="form-text text-muted">Kota Kelahiran</small>
                </div>


                <div class="form-group">
                    <label for="">Tanggal Kelahiran</label>
                    <input type="date" name="tanggal_lahir" required class="form-control" value="2018-05-13">
                    <small class="form-text text-muted">Tanggal Kelahiran</small>
                </div>

                <div class="form-group">
                    <label for="">Agama</label>
                    <input required type="text" class="form-control" name="agama" 
                        placeholder="Agama">
                    <small class="form-text text-muted">Agama ( Sesuai KTP ) </small>
                </div>

                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <input required type="text" class="form-control" name="pendidikan" 
                        placeholder="Pendidikan">
                    <small class="form-text text-muted">Pendidikan ( Sesuai KTP ) </small>
                </div>

                <div class="form-group">
                    <label for="">Pekerjaan</label>
                    <input required type="text" class="form-control" name="pekerjaan" 
                        placeholder="Pekerjaan">
                    <small class="form-text text-muted">Pekerjaan</small>
                </div>
              
                <div class="form-group">
                  <label for="">Status Pernikahan</label>
                  <select required class="form-control" name="status_nikah" id="">
                    <option value="1">Sudah Menikah</option>
                    <option value="0">Belum Menikah</option>
                  </select>
                </div>

                <div class="form-group">
                    <label for="">Alamat Saat Ini</label>
                    <textarea class="form-control" placeholder="Alamat Anggota Keluarga"  name="alamat" id=""
                        rows="5"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" value="{{ Auth::guard('keluarga')->id() }}">
                    <p class="card-text">Upload Foto KTP ( Jika Sudah Punya )</p>

                    <div class="custom-file">
                        <input name="photo" type="file" class="custom-file-input" id="inputGroupFile03">
                        <label class="custom-file-label" for="inputGroupFile03">Pilih Foto KTP</label>
                    </div>
                    <small class="form-text text-muted">Masukkan Foto KTP Disini</small>
                </div>
        

                <button type="submit" class="btn btn-block btn-primary">Tambahkan Data Keluarga</button>
            </form>
        </div>
    </div>


    <!-- Modal Add New -->
    <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="insert-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Tambah Data Guru Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="name">Judul/Nama Agenda Mutaba'ah</label>
                            <input type="hidden" required="" id="id" name="id" class="form-control">
                            <input type="" required="" id="name" placeholder="Judul Agenda Mutaba'ah" name="name"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_datetime">Tanggal Mutaba'ah</label>
                            <input type="date" required="" id="edit_date" name="edit_date" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="">Ganti Status Mutaba'ah</label>
                            <select class="form-control" required name="status" id="new_status">
                                <option value="">Pilih Status</option>
                                <option value="1">Dibuka</option>
                                <option value="0">Ditutup</option>
                                <option value="3">Pending</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New -->






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
