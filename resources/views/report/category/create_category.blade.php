@extends('main.app')

@section('style')
  
@endsection

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">News Feed</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">News Feed</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Create News</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ URL::previous() }}"><button type="button" class="btn btn-primary">⬅ Kembali</button></a>
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

            <form action='{{ url('/report_category/store') }}' method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>

                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="text" required class="form-control" name="title" placeholder="Nama Kategori">
                            <small class="form-text text-muted">Judul Kategori</small>
                        </div>

                        <div class="form-group">
                          <label for="">Icon Kategori</label>
                          <input type="file" class="form-control-file" name="icon" id="" placeholder="" aria-describedby="fileHelpId">
                          <small id="fileHelpId" class="form-text text-muted">Icon Untuk Kategori</small>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Buat Kategori</button>
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
