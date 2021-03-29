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
                    Nature of Business 
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>Settings</a></li>
                    <li><a href="#">Nature of business</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="width: 40%; vertical-align: text-top">
                                            <div class="box-header">
                                                <div>
                                                    <span> Nature of Business Information</span>
                                                    <!-- <a href="<?= base_url('#') ?>"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</button></a> -->
                                                </div>
                                            </div>
                                            <div style="font-weight: normal;" class="box-body">
                                                <form class="form-horizontal" id="industryCategoryForm">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">PSIC Code</label>
                                                        <div class="col-sm-6" >
                                                            <input type="text" class="form-control" name="psic_code" value="" placeholder="Code" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">Industry Category</label>
                                                        <div class="col-sm-6" >
                                                            <input type="text" class="form-control" name="industry_category" value="" placeholder="Industry Category" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 control-label">Significant Parameters</label>
                                                        <div class="col-sm-6">
                                                            <textarea rows="10" class="form-control" name="significant_parameters" value="" placeholder="Significant Parameters"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-4 control-label">Active</label>
                                                        <div class="col-xs-1">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" value="1" name="is_active">Yes
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-1">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" value="0" name="is_active">No
                                                                </label>
                                                            </div>
                                                        </div>
                                                      </div>

                                                    <div class="form-group">
                                                        <label for="" required class="col-sm-4 control-label">&nbsp;</label>
                                                        <p class="col-sm-4" id="ErrorMessage"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-10">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </th>
                                        <th style="width: 60%; vertical-align: text-top; font-weight: normal">
                                            <div class="box-body" id="element_overlapT">
                                                <table id="natureOfBusinessTable" class="table table-striped table-bordered table-hover" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>PSIC Code</th>
                                                            <th>Industry Category</th>
                                                            <th>Significant Parameters</th>
                                                            <th>Active</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                            </div>
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
                $('#natureOfBusinessTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [[0, "desc" ]],
                    "ajax": {
                        url: "<?= base_url('industry-category-list') ?>",
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
            
            $("#industryCategoryForm").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlapT").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#industryCategoryForm").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('add-nature-of-business'); ?>',
                    success: function (data)
                    {
                        $("#element_overlapT").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            $('#ErrorMessage').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#ErrorMessage').html(data.message);
                            $('#industryCategoryForm').trigger('reset');
                            $('#natureOfBusinessTable').DataTable().draw();

                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessage').html('<span style="color:red;">Local error callback.</span>');
                    }
                });
            });

            function editUser(userID,isPCO) {
                if(isPCO) {
                    alert("Editing pco account is not supported !");
                } else {
                    $("#element_overlapT").LoadingOverlay("show");
                    $.ajax({
                        dataType: "json",
                        type: "post",
                        data: {user_id:userID},
                        headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                        url: '<?= base_url('edit-user-page') ?>',
                        success: function (data)
                        {
                            $("#element_overlapT").LoadingOverlay("hide", true);
                            if (data.status === 0)
                            {
                                alert(data.message);
                            }
                            if (data.status === 1)
                            {
                                window.location = data.redirectUrl;
                            }
                        },
                        error: function (jqXHR, status, err) {
                            $("#element_overlapT").LoadingOverlay("hide", true);
                            alert('Local error callback, Please try again!');
                        }
                    });
                }
            }
            
        </script>
</body>
</html>
