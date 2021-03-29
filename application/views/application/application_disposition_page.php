<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('include/header'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('include/topbar'); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php $this->load->view('include/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Application Disposition
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text"></i>Application Disposition </a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content" id="element_overlap1">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body"><br>
                                <div class="col-xs-12">
                                    <p class="lead"><a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print PCO-<?php echo gmdate('Y-m-j', strtotime($document_date) + date("Z")); ?>-ID-<?php echo $appication_id; ?></a></p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody><tr>
                                                    <th style="width: 150px;">Subject:</th>
                                                    <td><?php echo $pco_name; ?> - <?php echo $subject; ?></td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 150px;">Document Date:</th>
                                                    <td><?php echo gmdate('Y/m/j H:i:s A', strtotime($document_date) + date("Z")); ?></td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 150px;">Document No:</th>
                                                    <td><?php echo $document_no; ?></td>
                                                </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="element_overlapT">
                                <table id="applicationDispositionTable" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>From</th>
                                            <th>Date & Time</th>
                                            <th>To/For</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>                                   
            </section>
            <!-- /.content -->
        </div>

        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>
            
            $(function () {
                $('#applicationDispositionTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order":[[2, "desc" ]],
                    "ajax": {
                        url: "<?= base_url('disposition-table') ?>",
                        type: "post",
                        headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                        error: function () {
                            $(".data-grid-error").html("");
                            $("#contacts-grid").append('<tbody class="data-grid-error"><tr><th align="center" colspan="5">No data found in the server</th></tr></tbody>');
                            $("#data-grid_processing").css("display", "none");
                        }
                    },
                });
            });

            $("#invoice-form").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#invoice-form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('order-of-payment'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            $("#element_overlap1").LoadingOverlay("hide", true);
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $("#element_overlap1").LoadingOverlay("hide", true);
                            window.open(data.redirectUrl, '_blank');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageOOP').html('<span style="color:red;">Local error callback. Please try again!</span>');
                    }
                });
            });

        </script>
</body>
</html>
