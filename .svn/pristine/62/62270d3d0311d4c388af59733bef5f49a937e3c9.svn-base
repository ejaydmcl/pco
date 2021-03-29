<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PCO | Forgot password page</title>
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
        <div id="success-message" style="width: 50%; margin: 7% auto;"></div>
        <div class="register-box">
            <div class="register-logo">
                <a href="#"></a>
            </div>
            <div class="card">
                <div class="card-body forgot-password-card-body">
                    <p class="login-box-msg">Forgot your password?</p>
                    <p>Enter your pco account id and email address. We'll email your current password.</p>
                    <div class="login-box-msg">
                        <div id="ErrorMessage" ></div>
                    </div>
                    <div class="wrap-forgot-password-form">
                        <form action="<?= base_url('forgot-password'); ?>" method="post" id="forgot-password-form">
                            <div class="input-group mb-3">
                                <input type="text" name="pco_id" class="form-control" placeholder="Account ID" required>
                                <div class="input-group-append">
                                    <span class="fa fa-user input-group-text"></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                <div class="input-group-append">
                                    <span class="fa fa-envelope input-group-text"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <p  id="ErrorMessageFPF"></p>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">                               
                                    <button type="submit" id="btn-submit" class="btn btn-primary btn-block btn-flat">Submit</button>
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
                $("#forgot-password-form").submit('on', function (e) {
                    e.preventDefault();
                    $('#ErrorMessageFPF').html('<span style="color:#060;">Please wait...</span>');
                    $(this).find(':input[type=submit]').prop('disabled', true);
                    $.ajax({
                        dataType: "json",
                        type: "post",
                        cache: false,
                        data: $('#forgot-password-form').serializeArray(),
                        url: $('#forgot-password-form').attr('action'),
                        success: function (data)
                        {
                            if (data.status === 0)
                            {
                                $("#btn-submit").attr('disabled',false);
                                $('#ErrorMessageFPF').html('<span class="fa fa-exclamation-circle" style="color:red; font-size:12px;"> ' + data.message + '</span>');
                            }
                            if (data.status === 1)
                            {
                                $("#btn-submit").attr('disabled',false);
                                
                                $('#success-message').html('<div class="card card-body" style="display:block !important; border-left: 5px solid #2965A5;"></button> <h4><i class="fa fa-info-circle" style="color:#2965A5;"></i> Success!</h4>' + data.message + '</div>');
                                $('#forgot-password-form').trigger('reset');
                                
                                $('.wrap-forgot-password-form').hide();
                                $('.forgot-password-card-body').hide();
                            }
                        },
                        complete: function() 
                        {
                            $("#btn-submit").attr('disabled',false);
                        },
                        error: function (jqXHR, status, err) {
                            $("#btn-submit").attr('disabled',false);
                            $('#ErrorMessageFPF').html("'<span style='color:red;'>'Local error callback. Please try again!</span>");
                        }
                    });
                });

            });
        </script>
    </body>
</html>