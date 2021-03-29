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
                    Photo Requirements
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>Photo Requirements</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-primary" style="height: 700px;">
                    <div class="box-header with-border">
                      <h3 class="box-title"><?php echo $page_header; ?></h3>
                    </div>
                    <div class="box-body">
                        <section class="content">
                            <div class="col-sm-4">
                                <p> <strong><?php echo $male_photo_header; ?></strong> </p>
                                <img style="width: 300px; height: 300px;" src="<?= base_url('public') ?>/images/male_2x2_photo_guide.jpg">
                            </div>
                            
                            <div class="col-sm-8">
                                <p> <strong><?php echo $female_photo_header; ?></strong> </p>
                                <img style="width: 300px; height: 300px;" src="<?= base_url('public') ?>/images/Female_2x2_photo_guide.jpg">
                            </div>
                        </section>
                        <section class="content">
                        <ul>
                            <?php foreach ($description_entry_list as $key => $value) { ?>
                            <li> <?php echo $value['value']; ?></li>
                            <?php } ?>
                        </ul>
                        </section>
                    </div>
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
            
        </script>
</body>
</html>
