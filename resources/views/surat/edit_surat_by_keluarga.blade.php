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
            <h4 class="mb-0 text-white">Edit Surat Pengantar</h4>
        </div>
        <div class="card-body">
            <form action="{{url("/keluarga/$keluarga->id/surat/$surat->id/edit")}}" method="post">
                @csrf

                <h4>Keluarga : {{ $keluarga->nama }}</h4>
                <div class="form-group">
                    <label for="">Ganti Anggota Keluarga Yang Akan Dibuatkan Surat Pengantar : </label>
                    <select required class="form-control" name="id_warga" id="">
                        <option value="">Pilih Anggota Keluarga</option>
                        @forelse ($allMember as $item)

                            <option @if ($item->id == $surat->id_warga) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>


                        @empty
                            <option value="">Belum Ada Anggota Keluarga</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Keperluan Surat, Misal : Pembuatan Paspor,KTP,dll</label>
                    <input type="text" required class="form-control" name="keperluan_surat" aria-describedby="helpId"
                        placeholder="Tujuan Pembuatan Surat" value="{{$surat->keperluan}}">
                    <small id="helpId" class="form-text text-muted">Tujuan Surat Pengantar</small>
                </div>

                <div class="form-group">
                    <label for="">Keterangan Tambahan ( Jika Ada )</label>
                    <textarea class="form-control" name="keterangan" rows="3">{{$surat->keterangan}}</textarea>
                </div>

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



@endsection
