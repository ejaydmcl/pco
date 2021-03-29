<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PCO</title>
        <link href="<?php echo base_url() . 'public/images/favicon.ico' ?>" rel="shortcut icon" type="image/x-icon">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/plugins/iCheck/square/blue.css">
        <!-- Google Font -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/font-awesome/css/google-font.css">
        <!-- Common Css-->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/common.css">
    </head>

</div>
<body class="hold-transition login-page">

    <div class="main-header-login">
        <nav class="navbar">
            <div class="head-title">
                <h5><i class="fa fa-th"></i> <b>PCO</b> - Environmental Management Bureau XI </h5>
            </div>
        </nav>
    </div>
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-logo">
                <a href="#"><img src="<?= base_url('public/dist/img/denr-emb-logo.png'); ?>" alt=""></a>
                <h3 class="text-center">Pollution Control Officers</h3>
                <h5>Environmental Management Bureau</h5>
            </div>

            <form action="<?= base_url('user-login-f'); ?>" method="post" id="loginF">
                <div id="radio" class="form-group row text-center">
                    <div class="col-xs-4">
                        <div class="radio">
                            <label>
                                <input type="radio" name="user_type" value="1" id="user_type" checked> PCO</label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="radio">
                            <label>
                                <input type="radio" name="user_type" value="2" id="user_type"> EMB PERSONNEL</label>
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" required name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" required class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div id="ErrorMessage"></div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" id="btn-sign-in" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <div>
                <a  href=" <?= base_url('register-page'); ?> " class="btn btn-block btn-social btn-flat">
                    <i class="fa fa-user-circle"></i> Sign up
                </a>
                <a href=" <?= base_url('forgot-password-page'); ?> " class="btn btn-block btn-social btn-flat">
                    <i class="fa fa-question-circle"></i> Forgot password
                </a>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('public'); ?>/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('public'); ?>/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url('public'); ?>/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $("#loginF").submit('on', function (e) {
                e.preventDefault();
                $('#ErrorMessage').html('<span style="color:#060;">Please wait...</span>');
                $(this).find(':input[type=submit]').prop('disabled', true);
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    // contentType: false,
                    //processData: false,
                    data: $('#loginF').serializeArray(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: $('#loginF').attr('action'),
                    success: function (data)
                    {
                        if (data.status === 0)
                        {
                            $("#btn-sign-in").attr('disabled', false);
                            $('#ErrorMessage').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#ErrorMessage').html('<span style="color:green;">' + data.message + '</span>');
                            $('#loginF').trigger('reset');
                            window.location.href = data.redirectUrl;
                        }
                    },
                    complete: function ()
                    {
                        $("#btn-sign-in").attr('disabled', false);
                    },
                    error: function (jqXHR, status, err)
                    {
                        $("#btn-sign-in").attr('disabled', false);
                        $('#ErrorMessage').html('<span style="color:red;">Local error callback. Please try again!</span>');
                    }
                });
            });
        });

    </script>
</body>
</html>
