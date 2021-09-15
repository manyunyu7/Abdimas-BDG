@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Rukun Warga</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Rukun Warga</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit Data Rukun Warga</li>
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

    <div class="row">

        <div class="col-12">

            <form action='{{url("/rt/{$rt->id}/edit")}}' method="post">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{$rt->id}}">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Edit Data {{ $rt->kode }}</h2>
                        <h5 class="card-subtitle">Edit Data Rukun Warga</h5>

                        <div class="form-group">
                          <label for="">Kode RW</label>
                          <input type="text"
                            class="form-control" name="kode" value="{{$rt->kode}}" id=""  placeholder="">
                          <small class="form-text text-muted">Kode RW</small>
                        </div>
                        
                        <div class="form-group">
                          <label for="">Kontak RT</label>
                          <input type="text"
                            class="form-control" name="contact" value="{{$rt->kontak}}" id=""  placeholder="">
                          <small class="form-text text-muted">Kontak RW</small>
                        </div>

                        <div class="form-group">
                          <label for="">Nama Ketua RT</label>
                          <input type="text"
                            class="form-control" name="nama" value="{{$rt->nama}}" id=""  placeholder="">
                          <small class="form-text text-muted">Nama RT</small>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                              <label for="">Anggota Dari RW</label>
                              <select class="form-control" name="id_rw" id="">
                                @forelse ($rwList as $item)
                                <option @if ($item != null) 
                                {{ $item->id == $rt->id_rw ? 'selected' : '' }} @endif value="{{ $item->id }}">

                                {{$item->kode}}

                                </option>
                                @empty
                                    
                                @endforelse
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Data RT</button>                       
                        </div>

                    </div>
                </div>

            </form>

        </div>

        <div class="col-12">

            <form action='{{url("/rt/{$rt->id}/admin_change_password")}}' method="post">
                @csrf
                @method('POST')

                <input type="hidden" name="id" value="{{$rt->id}}">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Reset Password (Oleh Admin)</h3>
                        <h5 class="card-subtitle">Gunakan Fitur Ini Jika Admin RT Lupa Password</h5>

                        <div class="form-group">
                          <label for="">Password Baru</label>
                          <input type="text"
                            class="form-control" name="new_password" placeholder="Isi Kolom Ini Dengan Password Baru">
                          <small class="form-text text-muted">Kode RT</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Password</button>                       
                        </div>

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
