<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PCO | Registration Page</title>
        <link href="<?php echo base_url() . 'public/images/favicon.ico' ?>" rel="shortcut icon" type="image/x-icon">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/adminltev3.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/plugins/iCheck/square/blue.css">
        <!-- Google Font: Source Sans Pro --> 
        <link href="<?= base_url('public'); ?>/components/font-awesome/css/google-font-sans-pro.css" rel="stylesheet">
        <!-- common --> 
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/common.css">


    </head>
    <body class="hold-transition register-page">
        <div class="main-header-login">
             <nav class="navbar">
            <div class="head-title-register">
                <h5><i class="fa fa-th"></i> <b>PCO</b> - Environmental Management Bureau XI </h5>
            </div>
        </nav>
        </div>
        <div id="SuccessMessage" style="width: 50%; margin: 7% auto;"></div>
        <div class="register-box">
            <div class="register-logo">
                <a href="#"></a>
            </div>
            <div class="card">
                <div class="card-body register-card-body">
                    <h4 class="text-left">Sign up</h4>
                    <h5>Create your Pollution Control Officer account.</h5>
                    <div class="login-box-msg">
                        <div id="ErrorMessage" ></div>
                    </div>
                    <div class="wrapRegisterF">
                        <form action="<?= base_url('register'); ?>" method="post" id="registerF">
                            <div class="input-group mb-3">
                                <input type="email" name="Email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <span class="fa fa-envelope input-group-text"></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="Password" type="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="fa fa-lock input-group-text"></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="RetypePassword" type="password" class="form-control" placeholder="Retype password">
                                <div class="input-group-append">
                                    <span class="fa fa-lock input-group-text"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">

                                </div>
                                <!-- /.col -->
                                <div class="col-4">                               
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <a href="<?= base_url('login') ?>" class="text-center">Back to login</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="<?= base_url('public'); ?>/components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url('public'); ?>/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- iCheck -->
        <script src="<?= base_url('public'); ?>/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                })
            });
            $(function () {
                $("#registerF").submit('on', function (e) {
                    e.preventDefault();
                    $('#ErrorMessage').html('<span style="color:#060;">Please wait...</span>');
                    $.ajax({
                        dataType: "json",
                        type: "post",
                        cache: false,
                        // contentType: false,
                        //processData: false,
                        data: $('#registerF').serializeArray(),
                        url: $('#registerF').attr('action'),
                        success: function (data)
                        {
                            if (data.code === 400)
                            {
                                $('#ErrorMessage').html('<span style="color:red;">' + data.error + '</span>');
                            }
                            if (data.status === 0)
                            {
                                $('#ErrorMessage').html('<span style="color:red;">' + data.message + '</span>');
                            }
                            if (data.status === 1)
                            {
                                $('#SuccessMessage').html('<div class="card card-body" style="display:block !important; border-left: 5px solid #2965A5;"></button> <h4><i class="fa fa-info-circle" style="color:#2965A5;"></i> Success!</h4>' + data.message + '</div>');
                                $('#registerF').trigger('reset');
                                $('.wrapRegisterF').hide();
                                $('.register-card-body').hide();
                            }
                        },
                        error: function (jqXHR, status, err) {
                            $('#ErrorMessage').html("'<span style='color:red;'>'Local error callback. Please try again!</span>");
                        }
                    });
                });

            });
        </script>
    </body>
</html>