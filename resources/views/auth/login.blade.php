<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบประมวลผลความเชี่ยวชาญ - Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL::asset("assets/logo/irdrmuti_thmb.gif")}}" type="image/gif" sizes="16x16">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{URL::asset("template/plugins/fontawesome-free/css/all.min.css")}}>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href={{URL::asset("template/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{URL::asset("template/dist/css/adminlte.min.css")}}>
    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


</head>

<body class="hold-transition login-page" style="font-family: 'Mitr', sans-serif;">
    <div class="login-box">
        <div class="login-logo"> 
            <b >ประมวลผลความเชี่ยวชาญนักวิจัย</b>
        </div>
        <div style="text-align: center;">
            <h4>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน</h4>
        </div>
        <br>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>


                @if (session('alert'))


                <div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @endif



                <form action={{route("login_data")}} method="post">
                    {{ csrf_field() }}

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="E-mail" required>


                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i>
                                เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src={{URL::asset("template/plugins/jquery/jquery.min.js")}}></script>
    <!-- Bootstrap 4 -->
    <script src={{URL::asset("template/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{URL::asset("template/dist/js/adminlte.min.js")}}></script>




</body>

</html>