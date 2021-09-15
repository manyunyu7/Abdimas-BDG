@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">News Feed</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">News Feed</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage News Feed</li>
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
    <div class="row">
        <div class="col-md-12">
            @include('components.message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <div class="card-group">
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 id="widgetCountSantri" class="text-dark mb-1 font-weight-medium">
                                       

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Santri</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 id="widgetCountSMP" class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                  
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SANTRI SMP
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 id="widgetCountSMA" class="text-dark mb-1 font-weight-medium">

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SANTRI SMA</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Data News</h4>
                    <h6 class="card-subtitle">
                        Daftar News Feed Yang Ditampilkan di Sisi User
                    </h6>
                    {{-- <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data Santri Baru</button> --}}

                    <div class="table-responsive">
                        <table id="table_data" class="table table-hover table-success table-bordered display no-wrap"
                            style="width:100%">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Asrama</th>
                                    <th>Jenjang</th>
                                    <th>Edit</th>
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
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
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
    <!-- Modal Edit -->

    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus Data Santri Ini ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Aksi Ini akan menghapus seluruh mutaba'ah yang sudah dikumpulkan santri</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->

    <!-- Reset Pass Modal -->
    <div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Reset Password</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Password Siswa Akan Direset Menjadi AlbinaaIBS</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-reset">RESET</button>
                </div>
            </div>
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


        $(".btn-destroy").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/santri/" + id + "/deleteAjax",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "DELETE",
                success: function(response) {
                    console.log(response);
                    $("#destroy-modal").modal("hide")
                    $('#table_santri').DataTable().ajax.reload();
                    $("#widgetCountSMA").text(response.countSMA)
                    $("#widgetCountSMP").text(response.countSMP)
                    $("#widgetCountSantri").text(response.countSantri)
                    swal("Sukses", "Berhasil Menghapus Data Santri ", "success");
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Menghapus Data Santri ", "error");
                }
            });
        })
        $(".btn-reset").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/santri/" + id + "/resetPassword",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "POST",
                success: function(response) {
                    console.log(response);
                    $("#edit-modal").modal("hide")
                    $('#table_santri').DataTable().ajax.reload();
                    swal("Sukses", "Berhasil Mengupdate Password Santri ", "success");
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Mengupdate Password Santri ", "error");
                }
            });
        })

    </script>




@endsection
