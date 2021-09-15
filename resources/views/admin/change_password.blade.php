@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Admin</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html">Ganti Password</a>
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


    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

    <div class="col-md-12">
        @include('components.message')
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white rounded-top">
                <h4 class="mb-0 "> Ganti Password Admin</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/ganti-password') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::guard('admin')->id()}}">
                    <div class="form-group">
                        <label for="">Password Lama</label>
                        <input type="text" class="form-control" name="old_password" id="" aria-describedby="helpId"
                            placeholder="Masukkan Password Lama" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="text" class="form-control" name="new_password" id="" aria-describedby="helpId"
                        placeholder="Masukkan Password Baru" required>
                    </div>
                    <button type="submit"
                    class="btn btn-block  waves-effect waves-light btn-lg btn-rounded btn-outline-success">Simpan
                    Perubahan Password</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
@endsection

@section('app-script')
    {{-- @include('admin.dashboard.script') --}}
@endsection
