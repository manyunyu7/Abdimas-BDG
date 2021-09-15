@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Rukun Warga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Rukun Warga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage Rukun Warga</li>
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
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Manage Data RW</h2> 
                    <br>
                    <h6 class="card-subtitle">
                        {{-- nO tEXT/ --}}
                    </h6>

                    <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data RW</button>

                    <div class="table-responsive">
                        <table id="table_data" class="table table-hover table-bordered display no-wrap" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode RW</th>
                                    <th>Kontak RW</th>
                                    <th>Jumlah RT Anggota</th>
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
                    <h4 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus RW Ini ??</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h6>Aksi ini akan menghapus seluruh data yang berhubungan dengan RW Terkait, seperti warga,RT, dll.</h6>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->


    <!-- Modal Add New -->
    <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="insert-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Tambah Data RW</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="name">Nomer/Kode RW</label>
                            <input type="" required="" id="txt_in_kode" placeholder="Misal RW 05" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Kontak RW</label>
                            <input type="" required="" id="txt_in_contact" placeholder="Kontak RW" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama RW</label>
                            <input type="" required="" id="txt_in_nama" placeholder="Nama RW" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Password Untuk Akun Ketua RW</label>
                            <input type="" required="" id="txt_in_password"
                                placeholder="Password Ini Akan Digunakan Untuk Login" class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_insert" class="btn btn-primary btn-update">Submit</button>
                    </form>
                </div>
            </div>
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
                        title: 'Data RW {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
                ajax: {
                    type: "get",
                    url: "{{ url('admin/rw/manage') }}",
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
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'kontak',
                        name: 'kontak'
                    },
                    {
                        data: 'rt',
                        name: 'rt'
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


        });

        $("#btn_insert").on("click", function() {

            let in_error = false;

            let in_kode = $('#txt_in_kode').val();
            let in_nama = $('#txt_in_kode').val();
            let in_password = $('#txt_in_password').val();
            let in_contact = $('#txt_in_contact').val();

            const myInput = [in_kode,  in_contact, in_password,in_nama];

            if (myInput.includes(null) || myInput.includes(undefined) || myInput.includes("")) {
                in_error = true;
            }

            if (in_error == true) {
                swal("Error", "Mohon Melengkapi Form Input RW Terlebih Dahulu ", "error");
            } else {

                $.ajax({
                    url: "{{ URL::to('/') }}/admin/rw/insertAjax",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "kode": in_kode,
                        "nama": in_nama,
                        "contact": in_contact,
                        "password": in_password,
                    },
                    method: "POST",
                    success: function(response) {
                        console.log(response);
                        if (response == 0) {
                            swal("Error", "Gagal Menambah Data RW ", "error");
                        } else {
                            $('#table_data').DataTable().ajax.reload();
                            swal("Sukses", "Berhasil Menambah Data RW ", "success");
                        }
                        $("#insert-modal").modal("hide")
                    },
                    error: function(xhr, error, code) {
                        $('#table_data').DataTable().ajax.reload();
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(error.toString());
                        console.log(err);
                        console.log(code);
                        swal("Error", "Gagal Menambah Data RW ", "error");
                    }
                });

            }
        })


        $(".btn-destroy").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/admin/rw/" + id + "/delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                method: "DELETE",
                success: function(response) {

                    if (response == 1) {
                        swal("Sukses", "Berhasil Menghapus Data RW ", "success");
                    } else {
                        swal("Sukses", "Berhasil Menghapus Data RW ", "success");
                    }
                    console.log(response);
                    $("#destroy-modal").modal("hide")
                    $('#table_data').DataTable().ajax.reload();
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Menghapus Data RW ", "error");
                }
            });
        })


    </script>




@endsection
