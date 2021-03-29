<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('include/header'); ?>
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
</style>

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
                    Add User
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>User</a></li>
                    <li><a href="#">List</a></li>
                    <li><a href="#">Add user</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
<!--                    <div class="col-md-3" >

                         Profile Image 
                        <div class="box box-primary" id="element_overlap">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle profileImgUrl" src="<?= base_url('uploads') ?>/profiles/no-image.png" alt="">
                                <hr>
                                <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-block"><b>Upload Photo</b></a>
                                <p id="ErrorMessage" style="padding: 5px;"></p>
                            </div>
                             /.box-body 
                        </div>
                         /.box 

                    </div>-->
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom" id="element_overlap1">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#general-details" data-toggle="tab">General Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="general-details">
                                    <form class="form-horizontal CreateUserF">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-4" >
                                                <input type="email" class="form-control" name="email" value="" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-4" >
                                                <input type="password" class="form-control" name="password" value="" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Retype Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" class="form-control" name="retype_password" value="" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Active</label>
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
                                            <label  class="col-sm-2 control-label">Verified</label>
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="1" name="is_email_verify" >Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="0" name="is_email_verify" >No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label  class="col-sm-2 control-label">Notification</label>
                                            
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="1" name="notification" >Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="0" name="notification" >No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Role</label>
                                            <div class="col-sm-4">
                                                <select name="role" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                   <option value="0">Select</option>
                                                <?php 
                                                    foreach ($user_role as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?> </option>
                                                <?php
                                                    }
                                                ?>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-4">
                                                <select name="designation" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                   <option value="0">Select</option>
                                                <?php 
                                                    foreach ($designation as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?> </option>
                                                <?php
                                                    }
                                                ?>
                                              </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group"><label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <p  id="ErrorMessageU"></p>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
<!--        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">

                 Modal content
                <div class="modal-content">
                    <form class="UploadForm">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="document_name">Change Profile Photo</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" required id="userPhoto">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info Upload">Upload</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>-->
        <!-- /.content-wrapper -->

        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script src="<?= base_url('public') ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public') ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?= base_url('public') ?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url('public') ?>/components/select2/dist/js/select2.full.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>

        <script>
            function LoginWith(url) {
                window.open(url, "popup", "width=800,height=500,left=220,top=130");
            }
            
            $(function () {
                $('#datepicker1').datepicker({
                    autoclose: true
                  })
            });

            $(".UploadForm").submit('on', function (e) {
                e.preventDefault();
                $('#myModal').modal('hide');
                $('#ErrorMessage').html('');
                $("#element_overlap").LoadingOverlay("show");
                var file_data = $('#userImage').prop('files')[0];
                var form_data = new FormData();
                form_data.append('userPhoto', file_data);
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('upload-profile'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            $('#ErrorMessage').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#ErrorMessage').html(data.message);
                            $('.profileImgUrl').attr('src', data.picture_url);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessage').html('<span style="color:red;">Local error callback.</span>');
                    }
                });
                //} //else
            });


            $(".ChangePassword").submit('on', function (e) {
                e.preventDefault();
                var New, Old, Confirm;
                New = $('#New').val();
                Old = $('#Old').val();
                Confirm = $('#Confirm').val();
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {New: New, Old: Old, Confirm: Confirm, },
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('profile-password-update'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#ErrorMessageP').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status == 1)
                        {
                            $('#ErrorMessageP').html(data.message);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageP').html('<span style="color:red;">Local error callback.</span>');
                    }
                });
                //} //else
            });

            $(".CreateUserF").submit('on', function (e) {
                e.preventDefault();

                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $(".CreateUserF").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('create-user'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#ErrorMessageU').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status == 1)
                        {
                            $('#ErrorMessageU').html(data.message);
                            $('#registerF').trigger('reset');

                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageU').html('<span style="color:red;">Local error callback.</span>');
                    }
                });
                //} //else
            });

        </script>

</body>
</html>
