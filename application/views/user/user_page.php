<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('include/header'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('include/topbar'); ?>
        <?php $this->load->view('include/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>User<small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>User</a></li>
                    <li><a href="#">List</a></li>
                </ol>
            </section>
            <div class="modal modal fade" id="modal-add-new-personnel" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form add-new-personnel-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Add new personnel</h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="personnel" >Personnel</label>
                                        <select  class="form-control select2 select2-hidden-accessible" style="width:100%" id="personnel" name="personnel" required>
                                            <option value="">-Select-</option>
                                            <?php foreach ($iisuserlist as $key => $value) { ?>
                                            <option value="<?php echo $value->userid; ?>" > <?php echo $value->fullname; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select id="role" name="role" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                            <option value="">-Select-</option>
                                            <?php foreach ($user_role as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="designation" >Designation</label>
                                        <select id="designation" name="designation" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                            <option value="">-Select-</option>
                                            <?php foreach ($designation as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div id="ErrorMessageU" class="box-body"></div>
                                </div>
                            </div>
                            <div class="modal-footer element_overlap">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary" style="height: 100%;">
                            <div class="box-header with-border">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-new-personnel">
                                    Add new personnel
                                </button>
                            </div>
                            <div class="box-body" id="element_overlapT">
                                <table id="userTable" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Date registered</th>
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
                $('.select2').select2();
            });
            $(function () {
                $('#userTable').DataTable({
                    "scrollY": "400px",
                    "processing": true,
                    "serverSide": true,
                    "columnDefs": [
                        {"className": "dt-center", "targets": [2,3,4]}
                    ],
                    "ajax": {
                        url: "<?= base_url('user-list-data-grid') ?>",
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

            var btnUnhide = document.getElementsByName('un_hide');
            var inptViewPass = document.getElementsByName('view_password');

            btnUnhide.forEach(function (element, index) {
                element.onClick = function () {
                    'use strick';
                    if (inptViewPass[index].type === 'password') {
                        inptViewPass[index].setAttribute('type', 'text');
                        element.firstChild.textContent = 'Hide';
                        element.firstChild.className = '';
                    } else {
                        inptViewPass[index].setAttribute('type', 'password');
                        element.firstChild.textContent = '';
                        element.firstChild.className = 'glyphicon glyphicon-eye-open';
                    }
                }
            })

            function addUser() {
                $("#element_overlapT").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('add-user-page') ?>',
                    success: function (data)
                    {
                        // Set a time to delay the animation.
                        setTimeout(function () {
                            $("#element_overlapT").LoadingOverlay("hide", true);
                        }, 6000);
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
                        alert('Local error callback, Please try again!');
                    }
                });
            }

            function editUser(userID, isPCO) {
                alert("Not yet implemented!");
                return;
                
                if (isPCO) {
                    alert("Editing pco account is not supported !");
                } else {
                    $("#element_overlapT").LoadingOverlay("show");
                    $.ajax({
                        dataType: "json",
                        type: "post",
                        data: {user_id: userID},
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
            
            $(".add-new-personnel-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                var d = new FormData();
                d.append('personnel', $('#personnel').val());
                d.append('role', $('#role').val());
                d.append('designation', $('#designation').val());
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: d,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('add-new-personnel'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#ErrorMessageU').html('<div class="alert alert-warning alert-dismissible">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                                    '<h5><i class="icon fa fa-warning"></i>Warining!</h5>' + data.message + '</div>');
                        }
                        if (data.status == 1)
                        {
                            $('#modal-add-new-personnel').modal('hide');
                            $('.add-new-personnel-form').trigger('reset');

                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageU').html('<span style="color:red;">Local error callback.</span>');
                    }
                });
            });

        </script>
</body>
</html>
