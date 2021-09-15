@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Surat</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Surat</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit Surat</li>
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
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">Identitas Pembuat Surat</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Nama Lengkap</label></strong>
                    <input readonly type="text" required class="form-control" value="{{ $surat->nama_lengkap }}">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Alamat Tinggal</label></strong>
                    <input readonly type="text" required class="form-control" value="{{ $surat->tempat }}">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Tanggal Lahir</label></strong>
                    <input readonly type="text" required class="form-control" value="{{ $surat->tanggal_lahir }}">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Agama</label></strong>
                    <input readonly type="text" required class="form-control" value="{{ $surat->agama }}">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Pekerjaan</label></strong>
                    <input readonly type="text" required class="form-control" value="{{ $surat->pekerjaan }}">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Status Pernikahan</label></strong>
                    <input readonly type="text" required class="form-control" @if ($surat->status_perkawinan == 1) value="Menikah"
                    @else
                                                                        value="Belum Menikah" @endif>
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Foto KTP</label></strong><br>
                    <img src="{{ url('/') . $warga->path_ktp }}" style="border-radius:30px !important; "
                        onerror='imgError(this);' class="img-fluid rounded-circle}" alt="">
                </div>
                <div class="form-group col-md-6 col-12">
                    <strong class="text-dark"><label for="">Foto KK</label></strong><br>
                    <img src="{{ url('/') . $keluarga->photo_kartu_keluarga }}" style="border-radius:30px !important; "
                        onerror='imgError(this);' class="img-fluid rounded-circle}" alt="">
                </div>

            </div>
        </div>
    </div>


    <div class="card border-success">
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">Edit Surat Pengantar</h4>
        </div>
        <div class="card-body">
            <form action="{{ url("surat/$surat->id/update") }}" method="post">
                @csrf

                <h3>Asal Surat (Keluarga) : {{ $keluarga->nama }}</h3>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Keperluan Surat</label></strong>
                    <input readonly type="text" required class="form-control" name="keperluan_surat"
                        aria-describedby="helpId" placeholder="Tujuan Pembuatan Surat" value="{{ $surat->keperluan }}">
                    <small id="helpId" class="form-text text-muted">Tujuan Surat Pengantar</small>
                </div>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Nomor Surat</label></strong>
                    <input @if (Auth::guard('erwe')->check() || Auth::guard('admin')->check()) readonly @endif type="text" required class="form-control" name="nomor_surat"
                        aria-describedby="helpId" placeholder="Nomor Surat" value="{{ $surat->nomor_surat }}">
                    <h4 class="form-text">Disesuaikan Penomoran Arsip Surat di RT</h4>
                </div>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Ketua RT</label></strong>
                    <input @if (Auth::guard('erwe')->check() || Auth::guard('admin')) readonly @endif type="text" required class="form-control" name="nama_rt"
                        aria-describedby="helpId" placeholder="Nomor Surat" value="{{ $surat->nama_rt }}">
                    <h5 class="form-text">Nama Ketua RT</h5>
                </div>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Ketua RW</label></strong>
                    <input @if (Auth::guard('erwe')->check() || Auth::guard('admin')) readonly @endif type="text" required class="form-control" name="nama_rw"
                        aria-describedby="helpId" placeholder="Nomor Surat" value="{{ $surat->nama_rw }}">
                    <h5 class="form-text">Nama Ketua RW</h5>
                </div>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Sekretariat RT</label></strong>
                    <input @if (Auth::guard('erwe')->check() || Auth::guard('admin')) readonly @endif type="text" class="form-control" name="sekretariat_rt"
                        aria-describedby="helpId" placeholder="Nomor Surat" value="{{ $surat->sekretariat }}">
                    <h4 class="form-text">Disesuaikan Penomoran Arsip Surat di RT</h4>
                </div>

                <div class="form-group">
                    <strong class="text-dark"><label for="">Kontak RT</label></strong>
                    <input @if (Auth::guard('erwe')->check() || Auth::guard('admin')) readonly @endif type="text" class="form-control" name="telepon"
                        aria-describedby="helpId" placeholder="Nomor Surat" value="{{ $surat->telepon }}">
                    <h4 class="form-text">Kontak RT</h4>
                </div>

                <div class="form-group">
                    <label for="">Keterangan Tambahan Dari Warga( Jika Ada )</label>
                    <textarea class="form-control" readonly name="keterangan"
                        rows="3">{{ $surat->keterangan }}</textarea>
                </div>

                @if (Auth::guard('erte')->check())
                    <div class="form-group">
                        <label for="">RT Menyetujui Surat Pengantar :
                            ??</label>
                        <select required class="form-control" name="status_rt" id="">
                            <option @if ($surat->is_rt_approved == 1) selected @endif
                                value="1">Ya</option>
                            <option value="0"  @if ($surat->is_rt_approved == 0) selected @endif>Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">RW Menyetujui Surat Pengantar : </label>
                        <input type="hidden" name="status_rw" value="{{ $surat->is_rw_approved }}">
                        <select disabled required class="form-control" id="">
                            @if ($surat->is_rw_approved == 1)
                                <option value="1">Ya</option>
                            @endif
                            @if ($surat->is_rw_approved == 0)
                                <option value="0">Belum</option>
                            @endif
                        </select>
                    </div>

                @endif


                @if (Auth::guard('erwe')->check())
                    <div class="form-group">
                        <label for="">RW Menyetujui Surat Pengantar </label>
                        <select required class="form-control" name="status_rw" id="">
                            <option>Pilih Status</option>
                            <option @if ($surat->is_rw_approved == 1) selected @endif value="1">Ya</option>
                            <option @if ($surat->is_rw_approved == 0) selected @endif value="0">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">RT Menyetujui Surat Pengantar : </label>
                        <input type="hidden" name="status_rt" value="{{ $surat->is_rt_approved }}">
                        <select disabled required class="form-control" id="">
                            @if ($surat->is_rt_approved == 1)
                                <option value="1">Ya</option>
                            @endif
                            @if ($surat->is_rt_approved == 0)
                                <option value="0">Belum</option>
                            @endif
                        </select>
                    </div>

                @endif



                <button type="submit" class="btn btn-block btn-primary">Update Surat Pengantar</button>
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

    <script>
        function imgError(image) {
            image.onerror = "";
            image.src = window.location.origin + "/static_img/error.jpg"
            return true;
        }

    </script>



@endsection
