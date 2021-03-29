<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('include/header'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('include/topbar'); ?>
        <?php $this->load->view('include/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Clients profile<small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>Clients</a></li>
                    <li><a href="#">profile</a></li>
                </ol>
            </section>
            <section class="content">
                <div id="response"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary" style="height: 100%;">
                            <div class="box-header with-border">Profile</div>
                            <div class="box-body" id="element_overlapT">
                                <form id="send-verification-link-form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img width="100" height="100" class="img-thumbnail" src="<?= base_url('uploads')."/profiles/$photo" ?>" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_id">User Id</label>
                                                    <input readonly type="text" value="<?php echo $user_id; ?>" class="form-control input-sm" id="user_id" name="user_id" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input readonly type="text" value="<?php echo $name; ?>" class="form-control input-sm" id="name" name="name" placeholder="..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input readonly type="text" value="<?php echo $email; ?>" class="form-control input-sm" id="email" name="email" placeholder="..." required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary element_overlap">Send a verification link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>
            $("#send-verification-link-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                var form_data = new FormData();
                form_data.append('user_id', $('#user_id').val()); 
                form_data.append('name', $('#name').val()); 
                form_data.append('email', $('#email').val());
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('send-verification-link'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            var warning = '<div id="warning" class="alert alert-success alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' + data.message + '</div>';
                            $('#response').html(warning);
                            $('#warning').fadeOut(9000);
                        }
                        if (data.status === 1)
                        {
                            var success = '<div id="success" class="alert alert-success alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' + data.message +
                                  '</div>';
                            $('#response').html(success);
                            $('#success').fadeOut(9000);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        var error = '<div id="err" class="alert alert-danger alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                                  '<span style="color:white;">Code: ' + jqXHR.status + '  Status: '+ status + ' description: '+ err + '</span>' +
                                '</div>';
                        $('#response').html(error);
                        $('#err').fadeOut(9000);
                    }
                });
            });
        </script>
</body>
</html>
