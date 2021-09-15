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
    <title>Albinaa Daily Mutaba'ah</title>
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

        .background-image {
            background-image: url('https://image.freepik.com/free-vector/mandala-illustration_53876-81805.jpg');
            margin: 0;
            background-repeat: no-repeat;
            position: fixed;
            left: 0 !important;
            right: 0 !important;
            z-index: 0;
            width: 100% !important;
            height: 100% !important;
            display: block;
            /* Center and scale the image nicely */
            background-position: center;
            background-size: cover;
            -webkit-filter: blur(2px);
            -moz-filter: blur(2px);
            -o-filter: blur(2px);
            -ms-filter: blur(2px);
            filter: blur(2px);
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
                    style="background-image: url({{ URL::to('/bootstrap_ui/') }}/assets/images/kampus-albinaa.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white round-top-right round-bottom-right">
                    <div class="p-3">
                        <div class="text-center">
                            <img width="150px" height="150px"
                                src="{{ URL::to('/bootstrap_ui/') }}/assets/images/albinaa.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Aplikasi Mutaba'ah Harian Santri Albinaa IBS</p>
                        <form class="mt-4" action="{{ url('/login/santri/proc') }}" method="post">
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
                                        <label class="text-dark" for="uname">NIS / Email</label>
                                        <input class="form-control  @error('nis') is-invalid @enderror" id="uname"
                                            name="nis" type="text" placeholder="Masukkan NIS">
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
                                    Kesantrian Albinaa IBS © {{ \Carbon\Carbon::now()->year }} <br>
                                    <a href="{{url('/login/admin')}}"><small>Klik Disini Untuk Login Admin</small></a>
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
