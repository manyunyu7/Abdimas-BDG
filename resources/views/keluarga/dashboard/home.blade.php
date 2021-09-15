@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat Datang Keluarga
                {{ Auth::guard('keluarga')->user()->nama }}</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
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


    @if ($widget['keluarga']->photo_kartu_keluarga == null)
        <div class="alert alert-danger" role="alert">
            <strong>Silakan Lengkapi Foto Kartu Keluarga Sebelum Melanjutkan</strong>
        </div>
    @endif

    @include('components.message')


    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Informasi Keluarga</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/keluarga/updateData') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::guard('keluarga')->id() }}">
                <h3 class="card-title">Data Keluarga Anda</h3>
                <div class="form-group">
                    <label for="">Nama Keluarga</label>
                    <input type="text" class="form-control" name="nama" id="" value="{{ $widget['keluarga']->nama }}"
                        placeholder="Nama Keluarga">
                    <small class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group">
                    <label for="">Nomor KK</label>
                    <input type="text" class="form-control" required name="no_kk" id=""
                        value="{{ $widget['keluarga']->no_kk }}" placeholder="Nomor Kartu Keluarga">
                    <small class="form-text text-muted">Nomor Kartu Keluarga</small>
                </div>

                <div class="form-group">
                    <label for="">Nomor Telepon ( Digunakan Untuk Login )</label>
                    <input type="text" class="form-control" required name="kontak" id=""
                        value="{{ $widget['keluarga']->kontak }}" placeholder="Nomor Telepon">
                    <small class="form-text text-muted">Kontak</small>
                </div>

                <div class="form-group">
                    <label for="">Asal Yuridiksi RT</label>
                    <select class="form-control" name="rt" required id="">
                      @foreach ($widget['rt'] as $item)
                      <option 
                      
                      @if ($item['id_rt']==$widget['keluarga']->rt)
                          selected
                      @endif
                      value="{{$item['id_rt']}}">{{$item["kode_rt"]}} - {{$item['kode_rw']}}</option>
                      @endforeach
                    </select>
                  </div>

                <div class="form-group">
                    <label for="">Alamat Utama</label>
                    <textarea class="form-control" name="alamat" id=""
                        rows="5">{{ $widget['keluarga']->alamat }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>


    <section id="photoKK">


        <div class="card ">
            {{-- <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Foto Kartu Keluarga</h4>
        </div> --}}
            <img class="card-img-top img-fluid" style=" !important"
                src="{{ url('/') . $widget['keluarga']->photo_kartu_keluarga }}" alt="Card image cap"
                onerror="this.src='http://www.pallenz.co.nz/assets/camaleon_cms/image-not-found-4a963b95bf081c3ea02923dceaeb3f8085e1a654fc54840aac61a57a60903fef.png'">

            <div class="card-body">

                <form action="{{ url('/keluarga'.'/'.$widget['keluarga']->id.'/changeKKPhoto') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::guard('keluarga')->id() }}">
                    <h3 class="card-title">Foto Kartu Keluarga</h3>
                    <p class="card-text">Upload atau Ganti Foto Kartu Keluarga Dengan Mengupload Pada Tombol Dibawah</p>

                    <div class="custom-file">
                        <input required name="photo" type="file" class="custom-file-input" id="inputGroupFile03">
                        <label class="custom-file-label" for="inputGroupFile03">Pilih Foto KK</label>
                    </div>
                    <small class="form-text text-muted">Masukkan File Kartu Keluarga Disini</small>


                    <button type="submit" class="btn btn-primary">Ganti File Kartu Keluarga</button>
                </form>

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
    {{-- @include('admin.dashboard.script') --}}
@endsection
