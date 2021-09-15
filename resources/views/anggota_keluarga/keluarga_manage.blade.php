@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Anggota Keluarga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Anggota Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage Anggota Keluarga</li>
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
            <h2 class="card-title mb-2">Manage Data Anggota Keluarga</h2>
            <h6 class="card-subtitle mt-2">
                Edit Data Anggota Keluarga
            </h6>
            {{-- <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data Santri Baru</button> --}}

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


    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Yakin Ingin Menghapus Anggota Keluarga Ini ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Aksi Ini akan menghapus seluruh data surat yang dikirimkan anggota keluarga ini</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
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
            image.src =window.location.origin+"/static_img/error.jpg"
            return true;
        }

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
                    type: "get",
                    url: "{{ url('keluarga/getAnggotaAjax') . '/' . $keluarga->id }}",
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

        });


        $(".btn-destroy").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/member/" + id + "/deleteAjax",
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
