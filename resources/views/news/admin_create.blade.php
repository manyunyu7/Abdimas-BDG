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

            <form action='{{ url('/news/store') }}' method="post">
                @csrf
                @method('POST')

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>

                        <div class="form-group">
                            <label for="">Judul Berita</label>
                            <input type="text" required class="form-control" name="title" placeholder="Judul News Feed">
                            <small class="form-text text-muted">Judul Berita</small>
                        </div>

                        <div class="form-group">
                            <label for="">Link Gambar</label>
                            <input type="text" required class="form-control" name="cover_link"
                                placeholder="Judul News Feed">
                            <small class="form-text text-muted">Judul Berita</small>
                        </div>

                        <div class="form-group">
                            <label for="">Further Link</label>
                            <input type="text" class="form-control" name="further_link" placeholder="Further Link">
                            <small class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Author / Penulis</label>
                            <input type="text" required class="form-control" name="author" placeholder="Penulis Berita">
                            <small class="form-text text-muted">Penulis Berita / Author</small>
                        </div>

                        <div class="form-group">
                            <label for="">Kontent Berita</label>
                            <textarea class="form-control" name="content" id="" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah News Feed</button>
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
