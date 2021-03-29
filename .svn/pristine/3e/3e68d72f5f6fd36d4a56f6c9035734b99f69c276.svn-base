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
                    Employee Profile
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-user"></i>Profile</a></li>
                </ol>
            </section>

            <div class="modal fade" id="modalUploadphoto" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="UploadPhotoForm">
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
            </div>

            <div class="modal fade" id="modalUplaodsignature" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form class="UploadSignatureForm">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="document_name">Upload Signature</h4>
                            </div>
                            <div class="modal-body">
                                <input type="file" required id="userSignature">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary Upload">Upload</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Main content -->

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="box box-primary" id="element_overlap">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle profileImgUrl" src="<?= base_url('uploads') ?>/profiles/<?php
                                $photo = $picture_file_name == FALSE ? 'no-image.png' : $picture_file_name;
                                echo $photo;
                                ?>" alt="">
                                <h3 class="profile-username text-center NameEdt"><?php echo $employee_name; ?></h3>
                                <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalUploadphoto" class="btn btn-primary btn-block"><b>Upload Photo</b></a>
                                <p id="ErrorMessage" style="padding: 5px;"></p>
                            </div>
                        </div>
                        <div class="box box-primary" id="element_overlap_signature">
                            <div class="box-body">
                                <div class="pcoUserEmployeeSignature" style="height: 160px;">
                                    <img class="signature-user-img img-responsive signatureImgUrl" style="width: 140px; height: 100px; padding-bottom: 5px; margin: auto;" src="<?= base_url('uploads') ?>/signature/<?php
                                         $signature = $signature_file_name == FALSE ? 'no-image.png' : $signature_file_name;
                                         echo $signature;
                                         ?>" alt="">
                                    <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalUplaodsignature" class="btn btn-primary btn-block"><b>Upload Signature</b></a>
                                    <p id="ErrorMessage1" style="padding: 5px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Account</h3>
                              <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body no-padding" style="">
                              <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"><i class="fa fa-building"></i> <?php echo (isset($region) != TRUE ? '' : $region) ?></a></li>
                                <li><a href="#"><i class="fa fa-mobile-phone"></i> <?php echo (isset($mobile_phone_no) != TRUE ? '' : $mobile_phone_no) ?></a></li>
                                <li><a href="#"><i class="fa fa-phone-square"></i> <?php echo (isset($telephone_no) != TRUE ? '' : $telephone_no) ?></a></li>
                                <li><a href="#"><i class="fa fa-envelope-square"></i> <?php echo (isset($email) != TRUE ? '' : $email) ?></a></li>
                                <li><a href="#"><i class="fa fa-calendar"></i> <?php echo $this->utils->format_date($date_created); ?></a></li>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="nav-tabs-custom" id="element_overlap_personal_profile">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#personale-profile" data-toggle="tab">Personal Profile</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="personale-profile">
                                    <form action="<?= base_url('update-personal-profile'); ?>" class="form-horizontal" id="personalProfileF">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-5">
                                                <input type="hidden" class="form-control" name="<?php $name = isset($account_fk) == TRUE ? 'account_fk' : 'employee_fk';
                                         echo $name; ?>" value="<?php echo isset($account_fk) == TRUE ? $account_fk : $employee_fk ?>" >
                                                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id ?>" >
                                                <input type="text" class="form-control" name="first_name" value="<?php echo (isset($first_name) != TRUE ? '' : $first_name) ?>" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="last_name" value="<?php echo (isset($last_name) != TRUE ? '' : $last_name) ?>" placeholder="Last Name">
                                            </div>
                                        </div>   

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="middle_name" value="<?php echo (isset($middle_name) != TRUE ? '' : $middle_name) ?>" placeholder="Middle Name">
                                            </div>

                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="extension_name" value="<?php echo (isset($extension_name) != TRUE ? '' : $extension_name) ?>" placeholder="Name Extension">
                                            </div></div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Sex</label>
                                            <div class="col-xs-1">

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="Male" id="male_checkbox" name="gender" <?php echo (isset($gender) != TRUE ? '' : ($gender == 'Male') ? 'checked' : '' ) ?> >Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="Female" id="female_checbox" name="gender" <?php echo (isset($gender) != TRUE ? '' : ($gender == 'Female') ? 'checked' : '') ?> >Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Citizenship</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="citizenship" value="<?php echo (isset($citizenship) != TRUE ? '' : $citizenship) ?>" placeholder="Citizenship">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="address" value="<?php echo (isset($address) != TRUE ? '' : $address) ?>" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Telephone No.</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="telephone_number" value="<?php echo (isset($telephone_no) != TRUE ? '' : $telephone_no) ?>" placeholder="Telephone No">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="email" value="<?php echo (isset($email) != TRUE ? '' : $email) ?>" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Mobile Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="mobile_no" value="<?php echo (isset($mobile_phone_no) != TRUE ? '' : $mobile_phone_no) ?>" placeholder="Mobile Phone Number">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Role</label>
                                            <div class="col-sm-10">
                                                    <?php if ($user_role_fk == SUPER_USER) { ?>
                                                    <select name="role" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                        <?php foreach ($user_role as $key => $value) { ?>
                                                            <?php if ($user_role_fk == $value['id']) { ?>
                                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php foreach ($user_role as $key => $value) { ?>
                                                            <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php } else { ?>
                                                        <?php foreach ($user_role as $key => $value) { ?>
                                                            <?php if ($user_role_fk == $value['id']) { ?>
                                                                <select name="role" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                                    <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>  
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-10">
<?php if ($user_role_fk == SUPER_USER) { ?>
                                                    <select name="designation" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <?php foreach ($designation as $key => $value) { ?>
                                                        <?php if ($designation_fk == $value['id']) { ?>
                                                                <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php foreach ($designation as $key => $value) { ?>
                                                            <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php } else { ?>
                                                        <?php foreach ($designation as $key => $value) { ?>
                                                            <?php if ($designation_fk == $value['id']) { ?>
                                                                <select name="designation" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                                                    <option value="<?php echo $value['id']; ?>" > <?php echo $value['label']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    ?>
                                                    </select>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <p  id="ErrorMessageP"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-success btn-lg" id="btn_save"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <?php $this->load->view('include/footer'); ?>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="<?= base_url('public') ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public') ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url('public') ?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('public') ?>/components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
    <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);

        $(".UploadPhotoForm").submit('on', function (e) {
            e.preventDefault();
            $('#modalUploadphoto').modal('hide');
            $('#ErrorMessage').html('');
            $("#element_overlap").LoadingOverlay("show");
            var file_data = $('#userPhoto').prop('files')[0];
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
                url: '<?= base_url('upload-profile-photo'); ?>',
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
                    $('#ErrorMessage').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });

        $(".UploadSignatureForm").submit('on', function (e) {
            e.preventDefault();
            $('#modalUplaodsignature').modal('hide');
            $('#ErrorMessage1').html('');
            $("#element_overlap_signature").LoadingOverlay("show");
            var file_data = $('#userSignature').prop('files')[0];
            var form_data = new FormData();
            form_data.append('userSignature', file_data);
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('upload-user-siganture'); ?>',
                success: function (data)
                {
                    $("#element_overlap_signature").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessage1').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#ErrorMessage1').html(data.message);
                        $('.signatureImgUrl').attr('src', data.picture_url);
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessage1').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });

        $(function () {
            $("#personalProfileF").submit('on', function (e) {
                e.preventDefault();
                $('#ErrorMessageP').html('<span style="color:#060;">Please wait...</span>');
                $("#element_overlap_personal_profile").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    data: $('#personalProfileF').serializeArray(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: $('#personalProfileF').attr('action'),
                    success: function (data)
                    {
                        $("#element_overlap_personal_profile").LoadingOverlay("hide", true);
                        if (data.code === 400)
                        {
                            $('#ErrorMessageP').html('<span style="color:red;">' + data.error + '</span>');
                        }
                        if (data.status === 0)
                        {
                            $('#ErrorMessageP').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#ErrorMessageP').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageP').html("'<span style='color:red;'>'Local error callback. Please try again!</span>");
                    }
                });
            });
        });
        
        $(function () {
            $("#changePassword").submit('on', function (e) {
                e.preventDefault();
                $('#ErrorMessageCP').html('<span style="color:#060;">Please wait...</span>');
                $("#element_overlap_personal_profile").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    data: $('#changePassword').serializeArray(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: $('#changePassword').attr('action'),
                    success: function (data)
                    {
                        $("#element_overlap_personal_profile").LoadingOverlay("hide", true);
                        if (data.code === 400)
                        {
                            $('#ErrorMessageCP').html('<span style="color:red;">' + data.error + '</span>');
                        }
                        if (data.status === 0)
                        {
                            $('#ErrorMessageCP').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#ErrorMessageCP').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                            $('#changePassword').trigger('reset');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageCP').html("'<span style='color:red;'>'Local error callback. Please try again!</span>");
                    }
                });
            });
        });
    </script>
</body>
</html>
