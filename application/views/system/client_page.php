<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('include/header'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('include/topbar'); ?>
        <?php $this->load->view('include/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Clients<small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>Clients</a></li>
                    <li><a href="#">list</a></li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary" style="height: 100%;">
                            <div class="box-header with-border">
                                    Client list
                            </div>
                            <div class="box-body" id="element_overlapT">
                                <table data-order='[[0, "desc" ]]' id="clientsTable" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date Registered</th>
                                            <th>Verified</th>
                                            <th>Active</th>
                                            <th>Notify</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
            $(function () {
                $('#clientsTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [
                        {"className": "dt-center", "targets": [3,4,5,6,7]}
                    ],
                    "ajax": {
                        url: "<?= base_url('client-list') ?>",
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
            
        </script>
</body>
</html>
