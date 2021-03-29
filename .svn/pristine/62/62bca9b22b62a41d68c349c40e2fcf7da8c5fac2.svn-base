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
                    Application
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>Application</a></li>
                </ol>

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div id="application_table" class="box-header with-border"><br>
                                <?php if (isset($is_add) AND ! $is_add) { ?>
                                    <button id="add-new-application" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus"> </i> New application</button>
                                    <hr style="margin-top: 15px;">
                                <?php } ?>
                                <div class="row">
                                    <form id="sort-table">
                                        <div class="col-md-2">
                                            <label for="" class="control-label">Status</label>
                                            <select class="form-control" id="application_status" name="application_status">
                                                <option value="0" >All</option>
                                                <?php foreach ($application_status as $key => $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>" > <?php echo $value['label'] ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="control-label">Forwarded to</label>
                                            <select class="form-control" id="employee_assignee" name="employee_assignee">
                                                <option value="0" >All</option>
                                                <?php foreach ($employee_list as $key => $value) { ?>
                                                    <?php if ($isAssignee) { ?>
                                                        <option value="<?php echo $value['employee_fk'] ?>" > <?php echo $this->UserModel->getEmployeeUserFullName($value['employee_fk']) ?></option>
                                                    <?php } ?>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="control-label">-</label> <br>
                                            <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="element_overlapT">
                                <table id="applicationTable" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Region</th>
                                            <th>Name</th>
                                            <th>Application</th>
                                            <th>Forwarded to</th>
                                            <th>Update</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
        <script src="<?= base_url('public'); ?>/dist/js/jquery-confirm.min.js"></script>
        <script>

            $('#applicationTable').DataTable({
            "order": [[4, "desc" ]]
            });
            initializeTable();
            function initializeTable() {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_status: 0, employee_assignee: 0},
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('application-page-data'); ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    var table = $('#applicationTable').DataTable();
                    table.clear().rows.add(data.data).draw();
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            $("#sort-table").submit('on', function (e) {
            e.preventDefault();
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: $("#sort-table").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('application-page-data'); ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    var table = $('#applicationTable').DataTable();
                    table.clear().rows.add(data.data).draw();
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            });
            function application(id, account_fk) {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: id, account_fk: account_fk},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('selected-application') ?>',
                    success: function (data)
                    {
                    // Set a time to delay the animation.
                    setTimeout(function () {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    }, 6000);
                    if (data.code === 400)
                    {
                    alert(data.error);
                    }
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.location = data.redirectUrl;
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickView(applicationID){
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('view-selected-revoked-coa') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickTerminate(applicationID, statusID) {
            if (statusID !== 5) {
            alert("It's not approved yet!");
            } else {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('application-termination') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }
            }

            function onClickDetails(applicationID){
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('view-selected-application-details') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.code === 400)
                    {
                    alert(data.error);
                    }
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.location = data.redirectUrl;
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickRenewalDetails(applicationID){
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('select-the-renewed-application') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.location = data.redirectUrl;
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickRenewal(applicationID, statusID) {
            if (statusID <= 4) {
            alert("Cannot renew application, it is not approved yet. ");
            } else {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('renew-selected-application') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.code === 400)
                    {
                    alert(data.error);
                    }
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }
            }

            function onClickPrint(applicationID, statusID) {
            if (statusID !== 5 & statusID <= 4) {
            alert("It's not approved yet!");
            return;
            }
            if (statusID === 8) {
            alert("COA expired!");
            return;
            }
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('selected-application-coa') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.code === 400)
                    {
                    alert(data.error);
                    }
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickPrintEMB(applicationID, statusID) {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('selected-application-coa') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    alert(data.message);
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function onClickHistory(applicationID, statusID) {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('application-history') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            function renewExistingCOA() {
            alert("This feature is not yet implemented.");
            }

            function onClickCheckList(applicationID) {
            $("#element_overlapT").LoadingOverlay("show");
            $.ajax({
            dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('application-checklist') ?>',
                    success: function (data)
                    {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                    alert(data.message);
                    }
                    if (data.status === 1)
                    {
                    window.open(data.redirectUrl, '_blank');
                    }
                    },
                    error: function (jqXHR, status, err) {
                    $("#element_overlapT").LoadingOverlay("hide", true);
                    alert('Local error callback. Please try again!');
                    }
            });
            }

            $('#add-new-application').on('click', function() {
            $.confirm({
                title: 'New application',
                    icon: 'fa fa-info',
                    type: 'blue',
                    typeAnimated: true,
                    content: 'Do you have existing certificate of accreditation?',
                    buttons: {
                    cancel: {
                        text: 'Cancel',
                        btnClass: 'btn-default',
                            action: function(){
                            this.$content 
                                // Do nothing
                            }
                        },
                    yes: {
                        text: 'Yes',
                        btnClass: 'btn-default',
                            action: function(){
                                this.$content 
                                window.location = '<?= base_url('add-new-application-form?yes=1') ?>'
                            }
                        },
                    no: {
                        text: 'No',
                        btnClass: 'btn-default',
                            action: function(){
                                this.$content 
                                window.location = '<?= base_url('add-new-application-form?yes=0') ?>'
                            }
                        },
                    }
                });
            });
        </script>
</body>
</html>
