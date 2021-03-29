<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap 3.3.7 -->
<!--        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/bootstrap/dist/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/font-awesome/css/google-font.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/adminltev3.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/AdminLTE.min.css">
        <!-- common --> 
        <link rel="stylesheet" href="<?= base_url('public'); ?>/dist/css/common.css">
    </head>
    <body class="content-wrapper-verify-page">
        <nav class="navbar">
            <div class="head-title-register">
                <h5><i class="fa fa-th"></i> <b>PCO</b> - Environmental Management Bureau</h5>
            </div>
        </nav>
        <div class="content-wrapper-verify">
            <div class="box box-primary">        
                <div class="box-header with-border" style="border-bottom: 0px solid #f4f4f4;">
                    <h4 class="box-title">
                        <i class="fa fa fa-envelope" style="color:#3c8dbc;"></i>&nbsp; Verify Your Email Address</h4>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <!--                    <h4>PCO Online Account Verification</h4><hr>-->
                    <p style="color:#28a745;font-weight:bold;"> <?= $content ?></p>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <!--                    PCO - Environmental Management Bureau XI-->
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
    </body>
</html>



