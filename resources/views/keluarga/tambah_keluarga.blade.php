@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Keluarga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Keluarga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah Keluarga</li>
                    </ol>
                </nav>
            </div>
            {{-- <a href="{{URL::previous()}}"><button type="button" class="btn btn-primary mt-2">⬅ Kembali</button></a> --}}
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

    <div class="card ">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Tambah Keluarga Baru</h4>
        </div>
        <div class="card-body">
            <form class="mt-4" action="{{ url('registrasi/kepala-keluarga/proceed') }}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                @if (session()->has('error'))
                    <div class="alert alert-primary" role="alert">
                        <strong>primary</strong>
                    </div>
                @endif

                @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {!! implode('', $errors->all('<div> - :message</div>')) !!}
                    </div>

                @endif


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">Nama Keluarga</label>
                            <input required class="form-control  @error('nama') is-invalid @enderror" id="uname" name="nama"
                                type="text" placeholder="Masukkan Nama Lengkap">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">No Telepon ( Digunakan Untuk Login ) </label>
                            <input required class="form-control  @error('kontak') is-invalid @enderror" name="kontak"
                                type="text" placeholder="Misal (628823738709) Tanpa Spasi, ">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Asal Yuridiksi RT</label>
                            <select class="form-control" name="rt" required id="">

                            @if (Auth::guard('erte'))
                            <option value="{{ Auth::guard("erte")->id() }}">{{ Auth::guard("erte")->user()->join_info }}</option>
                            @else
                                    @foreach ($rt as $item)
                                        <option value="{{ $item->id }}">{{ $item->join_info }}</option>
                                    @endforeach
                            @endif
                        </select>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="" rows="3"
                                placeholder="Alamat Lengkap Rumah Tinggal Utama Keluarga"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Password</label>
                            <input class="form-control  @error('password') is-invalid @enderror" name="password" id="pwd"
                                type="text" placeholder="Password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">Registrasi</button>
                    </div>
                    <div class="col-lg-12 text-center mt-5">
                        Kelurahan Citereup © {{ \Carbon\Carbon::now()->year }} <br>
                        <a href="{{ url('/login') }}"><small>Klik Disini Untuk Login</small></a>
                    </div>
                </div>
            </form>

        </div>
    </div>


@endsection


@section('app-script')

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('content');

    </script>



@endsection
