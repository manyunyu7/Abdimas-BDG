<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Bandung JS</title>
    <!-- Custom CSS -->
    <link href="{{ URL::to('/bootstrap_ui/') }}/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <style>
        .round-all {
            border-radius: 25px !important;
        }

        .round-top-left {
            border-top-left-radius: 25px;
        }

        .round-top-right {
            border-top-right-radius: 25px;
        }

        .round-bottom-left {
            border-bottom-left-radius: 25px;
        }

        .round-bottom-right {
            border-bottom-right-radius: 25px;
        }

        #particles-js {
            z-index: 222 !important;
            position: absolute;
            width: 100% !important;
            height: 98% !important;
        }


        .auth-box {
            z-index: 300;
        }

        @media only screen and (max-width: 600px) {
            .miii {
                display: none;
            }
        }

    </style>
</head>

<body>

    <div class="main-wrapper">

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">

            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div id="particles-js"></div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="">
            <div class="background-image"></div>

            <div class="auth-box row round-all">
                <div class="col-lg-7 miii col-md-5 modal-bg-img round-top-left round-bottom-left"
                    style="background-image: url({{ URL::to('/bootstrap_ui/') }}/assets/images/cover.jpg);">
                </div>


                <div class="col-lg-5 col-md-7 bg-white round-top-right round-bottom-right">
                    <div class="p-3">
                        <div class="text-center">
                            <img width="150px" height="170px"
                                src="{{ URL::to('/bootstrap_ui/') }}/assets/images/big_logo.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Kelurahan Citereup</p>

                        @include('components.message')

                        <form class="mt-4" action="{{ url('/login/proc') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Nomor Telepon/Email</label>
                                        <input class="form-control  @error('uname') is-invalid @enderror" id="uname"
                                            name="uname" type="text" placeholder="Kontak">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control  @error('password') is-invalid @enderror"
                                            name="password" id="pwd" type="password" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Kelurahan Citereup © {{ \Carbon\Carbon::now()->year }} <br>
                                    <a href="{{ url('/registrasi/keluarga') }}"><small>Klik Disini Untuk Mendaftarkan
                                            Keluarga</small></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>



    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ URL::to('/bootstrap_ui/') }}/assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::to('/bootstrap_ui/') }}/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="{{ URL::to('/bootstrap_ui/') }}/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script src="{{ url('bower_components/particles.js/particles.min.js') }}"></script>

    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();

    </script>

    <script>
        particlesJS.load('particles-js', '{{ url('config/particlesjs-config.json') }}', function() {
            console.log('callback - particles.js config loaded');
        });

    </script>

</body>

</html>
