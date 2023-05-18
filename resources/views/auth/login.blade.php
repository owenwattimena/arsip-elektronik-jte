<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page"   style="background-image: url('{{ asset('assets/img/jte-building.jpeg') }}'); background-size: cover">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>{{ config('app.name') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="text-center" style="margin-top: 15px; margin-bottom: 15px">
                <img src="{{ asset('assets/img/polnam.png') }}" width="30%" alt="">
            </div>
            <p class="login-box-msg">Masuk untuk memulai sesi anda.</p>
            @if(session('alert'))
            <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('alert')['message'] }}
            </div>
            @endif
            <form action="{{ route('auth.login.post') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="NIP">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('username') <span class="help-block">{{ $message }}</span> <br> @enderror

                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password') <span class="help-block">{{ $message }}</span> <br> @enderror

                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">MASUK</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{-- <a href="#">I forgot my password</a><br> --}}
            {{-- <span>Belum punya akun? </span>
            <a href="{{ route('auth.register') }}" class="text-center">Daftar</a> --}}

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/dashboard') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/dashboard') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/dashboard') }}/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue'
                , radioClass: 'iradio_square-blue'
                , increaseArea: '20%' /* optional */
            });
        });

    </script>
</body>
</html>
