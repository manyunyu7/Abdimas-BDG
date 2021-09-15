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
            <h2 class="card-title mb-2">Preview Surat</h2>
            <div class="container-surat">
            <div class="header-surat">
                <div class="header-content">
                    <b>RUKUN TETANGGA : ................</b><br />
                    <b>DESA/KELURAHAN : ................</b>
                </div>
                <div class="header-content">
                    <b>RUKUN WARGA : ................</b><br />
                    <b>KECAMATAN : ................................</b>
                </div>
            </div>
            <div class="header-surat">
                <p>Sekretariat. Kp : ................</p>
                <p>Telepon : ................</p>
                <p>Kode Pos : ................</p>
            </div>
            <div class="line-header"></div>

            <section>
                <div class="header-section">
                    <h2>SURAT PENGANTAR</h2>
                    <p>Nomor : ....../....../....../......</p>
                </div>
                <div class="content-section">
                    <p>Yang bertanda tangan dibawah ini, Ketua RT,...., RW,.... Desa/Kelurahan: .................</p>
                    <p>Kecamatan ........................, Kabupaten Bandung, dengan ini menerangkan bahwa : </p>
                </div>
                <div class="content-section">
                    <div class="col-left">
                        <p>Nama Lengkap</p>
                        <p>Alamat</p>
                        <p>Tempat/Tanggal Lahir</p>
                        <p>Pekerjaan</p>
                        <p>Agama</p>
                        <p>Status Perkawinan</p>
                        <p>No. KTP</p>
                    </div>
                    <div class="col-right">
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                        <p> : ..................................................</p>
                    </div>
                </div>

                <div class="content-section">
                    <p>Adalah benar warga kami sesuai dengan data kependudukan yang ada.</p>
                    <p>Surat Keterangan ini kami berikan kepada yang bersangkutan untuk keperluan : </p>
                    <div class="blank-section">
                        <p>................................................................................................................................</p>
                        <p>................................................................................................................................</p>
                    </div>
                </div>

                <div class="content-section">
                    <p>Demikian Surat Keterangan ini kami buat dengan sebenarnya untuk dipergunakan yang</p>
                    <p>bersangkutan sebagaimana mestinya.</p>
                </div>
            </section>

            <div class="footer-section">
                <div>
                    <p>Mengetahui</p>
                    <b>KETUA RW</b>
                    <div class="sign">

                    </div>
                    <p>(.........................)</p>
                </div>
                <div>
                    <p>..........................</p>
                    <b>KETUA RT</b>
                    <div class="sign">
                    </div>
                    <p>(.........................)</p>
                </div>
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
