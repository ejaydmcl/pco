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
                    Profile
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-info"></i>Profile</a></li>
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
                        <div class="box box-primary" id="element_overlap_upload_photo">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle profileImgUrl" src="<?= base_url('uploads') ?>/profiles/<?php $photo = $picture_file_name == FALSE ? 'no-image.png' : $picture_file_name; echo $photo; ?>" alt="">
                                <h3 class="profile-username text-center NameEdt"><?php echo $pco_name; ?></h3>
                                <?php if($is_profile_locked) { ?>
                                <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalUploadphoto" class="btn btn-primary btn-block"><b>Upload Photo</b></a>
                                <p id="ErrorMessage"></p>
                                <hr>
                                <p> <span class="label label-warning">Notes:</span> 
                                <span>Photo requirements. <a onclick="onClickProfilePictureNotes()" href="javascript:void(0);"> Click here</a></span>
                                </p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="box box-primary" id="element_overlap_signature"> 
                            <div class="box-body">
                                <div class="pcoSignature" style="height: auto;">
                                    <img class="signature-user-img img-responsive signatureImgUrl" style="width: 100px; height: 100px; padding-bottom: 5px; margin: auto;" src="<?= base_url('uploads') ?>/signature/<?php
                                    $signature = $signature_file_name == FALSE ? 'no-image.png' : $signature_file_name;
                                    echo $signature;
                                    ?>" alt="">
                                    <?php if($is_profile_locked) { ?>
                                    <a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalUplaodsignature" class="btn btn-primary btn-block"><b>Upload Signature</b></a>
                                    <p id="ErrorMessage1"></p>
                                    <hr>
                                    <p> <span class="label label-warning"> Notes</span> 
                                    <span>Signature size requirements. <a onclick="onClickSignatureReqNotes()" href="javascript:void(0);">  Click here</a></span>
                                    </p>
                                    <?php } ?>
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
                                <li><a href="#"><i class="fa fa-user"></i> <?php echo (isset($pco_id) != TRUE ? '' : $pco_id) ?></a></li>
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
                               <?php if($is_profile_locked) { ?>
                                <li><a href="#change-password" data-toggle="tab">Change Password</a></li>
                                <?php }?>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="personale-profile">
                                    <form style="height: auto" class="form-horizontal" id="personalProfileF">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-5">
                                                <input type="hidden" class="form-control" id="account_fk" name="<?php
                                                $name = isset($account_fk) == TRUE ? 'account_fk' : 'employee_fk';
                                                echo $name;
                                                ?>" value="<?php echo isset($account_fk) == TRUE ? $account_fk : $employee_fk ?>" >
                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id ?>" >
                                                <input type="hidden" class="form-control" id="attachment_id" name="attachment_id" value="<?php echo (isset($managing_head_certificate) != TRUE ? '0' : $managing_head_certificate) ?>" >
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo (isset($first_name) != TRUE ? '' : $first_name) ?>" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo (isset($last_name) != TRUE ? '' : $last_name) ?>" placeholder="Last Name">
                                            </div>
                                        </div>   

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" maxlength="1" class="form-control" id="middle_name" name="middle_name" value="<?php echo (isset($middle_name) != TRUE ? '' : $middle_name) ?>" placeholder="Middle Initial(Don't put a period)">
                                            </div>

                                            <div class="col-sm-5">
                                                <select id="extension_name" name="extension_name" class="form-control">
                                                    <option value="" <?php echo $extension_name==null ? 'selected' : '' ?>>(n/a) Name extension</option>
                                                    <option value="Sr." <?php echo $extension_name=='Sr.' ? 'selected' : '' ?>>Sr.</option>
                                                    <option value="Jr." <?php echo $extension_name=='Jr.' ? 'selected' : '' ?>>Jr.</option>
                                                    <option value="II" <?php echo $extension_name=='II' ? 'selected' : '' ?>>II</option>
                                                    <option value="III" <?php echo $extension_name=='III' ? 'selected' : '' ?>>III</option>
                                                    <option value="IV" <?php echo $extension_name=='IV' ? 'selected' : '' ?>>IV</option>
                                                    <option value="V" <?php echo $extension_name=='V' ? 'selected' : '' ?>>V</option>
                                                    <option value="VI" <?php echo $extension_name=='VI' ? 'selected' : '' ?>>VI</option>
                                                  </select>
                                            </div></div>

                                        <div class="form-group">
                                            <label for="inputSex" class="col-sm-2 control-label">Sex</label>
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="Male" id="gender" name="gender" <?php echo (isset($gender) != TRUE ? '' : ($gender == 'Male') ? 'checked' : '' ) ?> >Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="Female" id="gender" name="gender" <?php echo (isset($gender) != TRUE ? '' : ($gender == 'Female') ? 'checked' : '') ?> >Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Citizenship</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo (isset($citizenship) != TRUE ? '' : $citizenship) ?>" placeholder="Citizenship">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo (isset($address) != TRUE ? '' : $address) ?>" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input" class="col-sm-2 control-label">Telephone No.</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="<?php echo (isset($telephone_no) != TRUE ? '' : $telephone_no) ?>"
												data-mask placeholder="000-000-0000" data-inputmask='"mask": "999-999-9999"'>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo (isset($email) != TRUE ? '' : $email) ?>" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input" class="col-sm-2 control-label">Mobile Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo (isset($mobile_phone_no) != TRUE ? '' : $mobile_phone_no) ?>" 
												data-mask placeholder="00-000-000-000" data-inputmask='"mask": "99-999-999-999"'>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                             <div class="col-sm-10">
                                                 <?php if($is_profile_locked) { ?>
                                                    <label class="control-label text-green">Click Yes if you are the Managing head.</label>
                                                 <?php } else { ?>
                                                    <label class="control-label text-green">Managing head details.</label>
                                                 <?php } ?>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Managing Head</label>
                                            <div class="col-xs-1">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="1" id="is_managing_head" name="is_managing_head" <?php echo (isset($is_managing_head) != TRUE ? '' : ($is_managing_head == 1 ) ? 'checked' : '' ) ?> >Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" value="0" id="is_managing_head" name="is_managing_head" <?php echo (isset($is_managing_head) != TRUE ? '' : ($is_managing_head == 0) ? 'checked' : '') ?> >No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="managing_head" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="managing_head" name="managing_head" value="<?php echo $managing_head_name; ?>" placeholder="Name of managing head">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="certificate" class="col-sm-2 control-label">Certificate</label>
                                            <div class="col-sm-10">
                                                <label class="control-label text-green">Attach training certificate. (Scanned Copy of the Document - PDF format only)</label>
                                                <p id="ErrorMessage1" style="padding: 0px; color:red;"> </p>
                                            </div>  
                                            <label for="certificate" class="col-sm-2 control-label"></label>
                                            <?php  
                                                if(isset($managing_head_certificate)) { ?>
                                                <div class="col-sm-10" id="mh_certificate_name">File:  <span class="label label-info" style="margin-right: 10px;" ><?php echo $this->ApplicationDetailsPageModel->getAttachmentFileName($managing_head_certificate) ?> </span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName($managing_head_certificate) ?>" target="_blank" class="label label-danger" >view</a></div>
                                            <?php } ?>
                                            <label class="col-md-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <div id="mh_certificate_name"></div>
                                                <div id="mh_certificate_file_size"></div>
                                                <div id="mh_certificate_file_type"></div>
                                                <a id="managing_head_certificate_view" href="#" target="_blank" style="color:#ffffff; display:none;" class="btn btn-primary btn-sm"> <span class="fa fa-file-pdf-o" style="color:#ffffff;"></span> view</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"></label>
                                            <?php if($is_profile_locked) { ?>
                                            <div class="col-sm-10">
                                                <div type="button" class="btn btn-primary btn-sm" onclick="$('#managing_head_certificate').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                <input type="file" name="managing_head_certificate" style="opacity: 0;" id="managing_head_certificate" <?php echo (isset($managing_head_certificate) != TRUE ? '' : '') ?>  onchange="onClickManagingHeadCertificate()"/>
                                            </div>
                                            <?php } ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">
                                            <p id="ErrorMessageP"></p>
                                            </div>
                                        </div>
                                        <?php if($is_profile_locked) { ?>
                                        <div class="form-group">
                                            <label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-success btn-lg" id="btn_save"><span class="glyphicon glyphicon-floppy-save"></span> Save Profile</button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </form>
                                </div>
                                <?php if($is_profile_locked) {?>    
                                <div class="tab-pane" id="change-password">
                                    <form class="form-horizontal" action="<?= base_url('update-password'); ?>" id="changePassword">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Old Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="old" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">New Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="new" placeholder="New Password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label required class="col-sm-2 control-label">Confirm Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="confirm" placeholder="Confirm Password">
                                            </div>
                                        </div>

                                        <div class="form-group"><label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <p  id="ErrorMessageCP"></p>
                                        </div>
                                        <?php if($is_profile_locked) { ?>
                                        <div class="form-group">
                                            <label for="" required class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-save"></span> Update Password</button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </form>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="box box-primary" id="element_overlap_lf">
                            <div class="box-header with-border">
                                <h4 class="box-title">PRC License <span><i>(If Applicable)</i></span>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">                                                                    
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="box-header" >
                                                    <ul class="list-inline" >
                                                        <?php if($is_profile_locked) { ?>
                                                        <li><a class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapse-box"><i class="fa fa-plus margin-r-5"></i> Add</a></li>
                                                        <?php } ?>
                                                            <div id="collapse-box" class="collapse">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Add License</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#collapse-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="licenseForm">
                                                                        <table>
                                                                            <tr>
                                                                                <td > 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="" >PRC License No.</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                                    <input type="number" class="form-control" name="prc_license_no" id="prc_license_no" value="" placeholder="License No." required autocomplete="off">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="" >Date Issued</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="date_issued" value="" placeholder="Date Issued" id="datepicker_date_issued" autocomplete="off" required>
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                         <dt><label for="" >Validity</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="validity" value="" placeholder="Validity Date" id="datepicker_validity" required autocomplete="off">
                                                                                                        <div class="input-group-addon" >
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-success btn-lg">Save</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageLF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">PRC License Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="prc_license_certificate" id="prc_license_certificate" required>  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        
                                                        <div id="collapse-edit-box" class="collapse">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                     <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Edit License</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#collapse-edit-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="editLicenseForm">
                                                                        <table>
                                                                            <tr>
                                                                                <td > 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="" >PRC License No.</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="license_fk" id="license_fk" value="">
                                                                                                    <input type="hidden" class="form-control" name="attachment_id" id="attachment_id" value="">
                                                                                                    <input type="number" class="form-control" name="edit_prc_license_no" id="edit_prc_license_no" value="" placeholder="PRC License No" required autocomplete="off">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="" >Date Issued</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_date_issued" value="" placeholder="Date Issued" id="edit_datepicker_date_issued" autocomplete="off" required>
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="" >Validity</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_validity" value="" placeholder="Validity Date" id="edit_datepicker_validity" required autocomplete="off">
                                                                                                        <div class="input-group-addon" >
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-lg">Edit</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageELF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">PRC License Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="edit_prc_license_certificate" id="edit_prc_license_certificate">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    </ul>
                                                </div>
                                                <div class="box-body" style="padding-top:0px;">
                                                    <table id="licenseTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>PRC License No.</th>
                                                                <th>Date Issued</th>
                                                                <th>Validity</th>
                                                                <th>File</th>
                                                                <?php if($is_profile_locked) {?>   
                                                                <th>Action</th>
                                                                <?php }?>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="box box-primary" id="element_overlap_eaf">
                            <!-- box title personal  -->
                            <div class="box-header with-border">
                                <h4 class="box-title">College Educational Attainment
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">                                                                   
                                    <div class="row"></div>                                 
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                               
                                                <div class="box-header">
                                                    <ul class="list-inline">
                                                        <?php if($is_profile_locked) { ?>
                                                        <li class="btn btn-primary btn-sm collapsed" data-toggle="collapse" data-target="#educational-attainment-collapse-box" aria-expanded="false"><i class="fa fa-plus margin-r-5"></i> Add College Degree</li>
                                                        <li class="btn btn-primary btn-sm collapsed" data-toggle="collapse" data-target="#add-vocational-technical-collapse-box" aria-expanded="false"><i class="fa fa-plus margin-r-5"></i> Add Vocational/Technical</li>
                                                        <?php } ?>
                                                            <div id="educational-attainment-collapse-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">College Degree</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#educational-attainment-collapse-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="add_college_degree">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">Name of School</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                                    <input type="text" class="form-control" id="school" name="school" value="" placeholder="School" required="" autocomplete="on">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Course</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" name="course" id="course" value="" placeholder="Course" required="" autocomplete="on">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Degree/Units Earned</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" class="form-control" name="degree_or_units_earned" id="degree_or_units_earned" value="" placeholder="Degree/units earned" required="" autocomplete="on">  
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Address</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <textarea rows="4" cols="50" class="form-control" name="college_school_address" id="college_school_address" value="" placeholder="Address" required></textarea>  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>

                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-success btn-lg">Save</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageEAF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">From</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="from_date" value="" placeholder="From date" id="datepicker_from" required="" autocomplete="off">
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">To</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="to_date" value="" placeholder="To date" id="datepicker_to" required="" autocomplete="off">                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;">Attainment</dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <input type="radio" value="1" id="attainment" name="attainment"> Graduated
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"></dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <input type="radio" value="0" id="attainment" name="attainment"> Not graduated
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;"></dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><label for="">College Diploma</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="college_diploma" id="college_diploma">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                      
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        
                                    <div id="add-vocational-technical-collapse-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                <div class="box-header with-border" style="margin-bottom: 10px;">
                                                    <h3 class="box-title">Vocational/Technical</h3>
                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#add-vocational-technical-collapse-box" aria-expanded="false">
                                                        <i class="fa fa-minus"></i></button>
                                                    </div>
                                                  </div>
                                                <form id="vocational_technical_form">
                                                    <table>
                                                        <tbody><tr>
                                                            <td> 
                                                                <dl class="dl-horizontal">
                                                                    <dt><label for="">Name of School</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                <input type="text" class="form-control" name="vocational_of_technical_school" id="vocational_of_technical_school" value="" placeholder="School" required="" autocomplete="on">                
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    <dt><label for="">Course</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" name="vocational_of_technical_course" id="vocational_of_technical_course" value="" placeholder="Course" required="" autocomplete="on">  
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    <dt><label for="">Grade/Year/Level/Units</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="grade_year_level_units" id="grade_year_level_units" value="" placeholder="Grade/Year/Level/Units" required="" autocomplete="on">  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    <dt><label for="">Address</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <textarea rows="4" cols="50" class="form-control" name="vocational_or_technical_school_address" id="vocational_or_technical_school_address" value="" placeholder="Address" required="" autocomplete="on"></textarea>  
                                                                            </div>
                                                                        </div>
                                                                    </dd>

                                                                    <dt style="margin-top: 10px;"><button type="submit" class="btn btn-success btn-lg">Save</button></dt>  
                                                                    <dd style="margin-top: 10px;">
                                                                        <p id="ErrorMessageEAF"></p>
                                                                    </dd>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal">
                                                                    <dt><label for="">From</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                    <input type="text" class="form-control" name="from_date" value="" placeholder="From date" id="datepicker_from_vocational_or_technical" required="" autocomplete="off">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="fa fa-calendar"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    <dt><label for="">To</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                    <input type="text" class="form-control" name="to_date" value="" placeholder="To date" id="datepicker_to_vocational_or_technical" required="" autocomplete="off">                                                                                                        <div class="input-group-addon">
                                                                                        <i class="fa fa-calendar"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    <dt style="margin-top: 10px;">Attainment</dt>
                                                                    <dd style="margin-top: 10px;">
                                                                        <input type="radio" value="1" id="attainment" name="attainment"> Graduated
                                                                    </dd>
                                                                    <dt style="margin-top: 10px;"></dt>
                                                                    <dd style="margin-top: 10px;">
                                                                        <input type="radio" value="0" id="attainment" name="attainment"> Not graduated
                                                                    </dd>
                                                                    
                                                                    <dt style="margin-top: 10px;"></dt>
                                                                    <dd style="margin-top: 10px;">
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                        </div>
                                                                    </dd>
                                                                    <dt style="margin-top: 10px;"><label for="">College Diploma</label></dt>
                                                                    <dd>
                                                                        <div class="col-xs-6" style="width: 100%">
                                                                            <div class="form-group">
                                                                                <input type="file" class="form-control" name="vocational_certificate" id="vocational_certificate" required>  
                                                                            </div>
                                                                        </div>
                                                                    </dd>
                                                                    
                                                                    <dt style="margin-top: 10px;">-</dt>
                                                                    <dd style="margin-top: 10px;">-</dd>
                                                                    <dt style="margin-top: 10px;">-</dt>
                                                                    <dd style="margin-top: 10px;">-</dd>
                                                                </dl>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </form>
                                            </div>
                                        </div>
                                                        
                                                        <div id="educational-attainment-collapse-edit-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-top: 10px;">
                                                                        <h3 class="box-title">Edit</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#educational-attainment-collapse-edit-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                     <form id="edit_educational_attainment_form">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt ><label for="">Name of School</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="educational_id" id="educational_id" value="">
                                                                                                    <input type="hidden" class="form-control" name="edit_college_educational_attainment_attachment_id" id="edit_college_educational_attainment_attachment_id" value="">
                                                                                                    <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                                    <input type="text" class="form-control" name="edit_school" id="edit_school" value="" placeholder="School" required="" autocomplete="on">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Course</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" name="edit_course" id="edit_course" value="" placeholder="Course" required="" autocomplete="on">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Degree/Level/Units</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" class="form-control" name="edit_degree_or_units_earned" id="edit_degree_or_units_earned" value="" placeholder="Degree/units earned" required="" autocomplete="on">  
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Address</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <textarea rows="4" cols="50" class="form-control" name="edit_college_school_address" id="edit_college_school_address" value="" placeholder="Address" required="" autocomplete="on"></textarea>  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>

                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-lg">Edit</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageEEAF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">From</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_from_date" value="" placeholder="From date" id="datepicker_edit_from" required="" autocomplete="off">
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">To</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_to_date" value="" placeholder="To date" id="datepicker_edit_to" required="" autocomplete="off">                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">Attainment</dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <input type="radio" value="1" id="edit_attainment" name="edit_attainment"> Graduated
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"></dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <input type="radio" value="0" id="edit_attainment" name="edit_attainment"> Not graduated
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;"></dt>
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><label for="">College Diploma</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="edit_college_diploma" id="edit_college_diploma">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    </ul>
                                                </div>
                                                
                                                <!-- /.box-body -->
                                                <div class="box-body">
                                                    <table id="educationAttainmentTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>School</th>
                                                                <th>Type</th>
                                                                <th>Course</th>
                                                                <th>Degree/Units Earned/Grade/Year/Level</th>
                                                                <th>From(Date)</th>
                                                                <th>To(Date)</th>
                                                                <th>Graduated</th>
                                                                <th>File</th>
                                                                <th>Address</th>
                                                                <?php if($is_profile_locked) {?>   
                                                                <th>Action</th>
                                                                <?php }?>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--   </div> -->
                                    <!-- /.box -->                                                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="box box-primary" id="element_overlap_wef">
                      
                            <div class="box-header with-border">
                                <h4 class="box-title">Work Experience
                                  
                            </div>

                            <div class="box-body">
                                <div class="col-md-12">                                                         
                                    <div class="row"></div>   
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <!-- /.box-header -->
                                                <div class="box-header">
                                                    <ul class="list-inline">
                                                        <?php if($is_profile_locked) { ?>
                                                        <li class="btn btn-primary btn-sm collapsed" data-toggle="collapse" data-target="#work-experience-collapse-add-box" aria-expanded="false"><i class="fa fa-plus margin-r-5"></i> Add</li>
                                                        <?php } ?>
                                                            <div id="work-experience-collapse-add-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Add work experience</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#work-experience-collapse-add-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="workExperienceForm">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">Company</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                                    <input type="text" class="form-control" name="company" id="company" value="" placeholder="Company" required="" autocomplete="on">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Position</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" name="position" id="position" value="" placeholder="Position" required="" autocomplete="on">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Employment status</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" class="form-control" name="employment_status" id="employment_status" value="" placeholder="Employment status" required="" autocomplete="on">  
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="work_experience_certificate" id="work_experience_certificate" required>  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>

                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-success btn-lg">Save</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageWEF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">From</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="from_date" value="" placeholder="From date" id="datepicker_from_we" required="" autocomplete="off">
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">To</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="to_date" value="" placeholder="To date" id="datepicker_to_we" autocomplete="off">                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 8px;" >Present</dt>
                                                                                        <dd>
                                                                                            <div class="form-group">
                                                                                                <div class="col-xs-4">
                                                                                                    <div class="checkbox">
                                                                                                        <label>
                                                                                                            <input type="checkbox" value="1" id="present" name="present">
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        
                                                        <div id="work-experience-collapse-edit-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Edit work experience</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#work-experience-collapse-edit-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="editWorkExperienceForm">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">Company</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="work_experience_id" id="work_experience_id" value="">
                                                                                                    <input type="hidden" class="form-control" name="attachment_id" id="attachment_id" value="">
                                                                                                    <input type="text" class="form-control" name="edit_company" id="edit_company" value="" placeholder="Company" required="" autocomplete="on">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Position</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" name="edit_position" id="edit_position" value="" placeholder="Position" required="" autocomplete="on">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Employment status</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" class="form-control" name="edit_employment_status" id="edit_employment_status" value="" placeholder="Employment status" required="" autocomplete="on">  
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" id="edit_work_experience_certificate" value="">
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        
                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-lg">Edit</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageEWEF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">From</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_from_date" value="" placeholder="From date" id="datepicker_edit_from_we" required="" autocomplete="off">
                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">To</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                                                                        <input type="text" class="form-control" name="edit_to_date" value="" placeholder="To date" id="datepicker_edit_to_we" autocomplete="off">                                                                                                        <div class="input-group-addon">
                                                                                                            <i class="fa fa-calendar"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 5px;" >Present</dt>
                                                                                        <dd>
                                                                                            <div class="form-group">
                                                                                                <div class="col-xs-4">
                                                                                                    <div class="checkbox">
                                                                                                        <label>
                                                                                                            <input type="checkbox" value="1" id="edit_present" name="edit_present">
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    </ul>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-body">
                                                    <table id="workExperienceTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Company</th>
                                                                <th>Position</th>
                                                                <th>Status</th>
                                                                <th>From(Date)</th>
                                                                <th>To(Date)</th>
                                                                <th>Present</th>
                                                                <th>File</th>
                                                                <?php if($is_profile_locked) {?>   
                                                                <th>Action</th>
                                                                <?php }?>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--   </div> -->
                                    <!-- /.box -->                                           
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="box box-primary" id="element_overlap_tsf">
                            <!-- box title personal  -->
                            <div class="box-header with-border">
                                <h4 class="box-title">PCO Training and Seminars
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-md-12">                                                       
                                    <div class="row"></div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <!-- box-header-->
                                                <div class="box-header">
                                                    <ul class="list-inline">
                                                        <?php if($is_profile_locked) { ?>
                                                        <li class="btn btn-primary btn-sm collapsed" data-toggle="collapse" data-target="#trainings-collapse-add-box" aria-expanded="false"><i class="fa fa-plus margin-r-5"></i> Add</li>
                                                        <?php } ?>
                                                            <div id="trainings-collapse-add-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Add Training and seminars.</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#trainings-collapse-add-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="trainingForm">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">Title</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="account_fk" id="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                                                                    <input type="text" class="form-control" name="title" id="title" value="" placeholder="Title" required="" autocomplete="off">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="training_and_seminars_certificate" id="training_and_seminars_certificate" required>  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-success btn-lg">Save</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageTSF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">No of hours</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="number" min="8" class="form-control" name="no_of_hours" id="no_of_hours" value="" placeholder="No of hours" required="" autocomplete="on">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Minimum of 8 hours of Training/Seminar.</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                    <p>List of EMB-Recognized PCO Training Organization/Institution. <a href="http://water.emb.gov.ph/?page_id=191" target="_blank"><i class="fa fa-home"> Click Here!</i></a> </p>
                                                                </div>
                                                            </div>
                                                        
                                                        <div id="edit-trainings-collapse-add-box" class="collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="box-body" style="background: #f9fafc; margin-top: 10px;">
                                                                    <div class="box-header with-border" style="margin-bottom: 10px;">
                                                                        <h3 class="box-title">Edit Training and seminars</h3>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-box-tool collapsed" data-toggle="collapse" data-target="#edit-trainings-collapse-add-box" aria-expanded="false">
                                                                            <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                      </div>
                                                                    <form id="editTrainingForm">
                                                                        <table>
                                                                            <tbody><tr>
                                                                                <td> 
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">Title</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" class="form-control" name="training_and_seminars_id" id="training_and_seminars_id" value="">
                                                                                                    <input type="hidden" class="form-control" name="tSAttachment_id" id="tSAttachment_id" value="">
                                                                                                    <input type="text" class="form-control" name="edit_title" id="edit_title" value="" placeholder="Title" required="" autocomplete="off">                
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt><label for="">Certificate</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="file" class="form-control" name="edit_training_and_seminars_certificate" id="edit_training_and_seminars_certificate">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;"><button type="submit" class="btn btn-primary btn-lg">Edit</button></dt>  
                                                                                        <dd style="margin-top: 10px;">
                                                                                            <p id="ErrorMessageETSF"></p>
                                                                                        </dd>
                                                                                    </dl>
                                                                                </td>
                                                                                <td>
                                                                                    <dl class="dl-horizontal">
                                                                                        <dt><label for="">No of hours</label></dt>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <div class="form-group">
                                                                                                    <input type="number" min="8" class="form-control" name="edit_no_of_hours" id="edit_no_of_hours" value="" placeholder="No of hours" required="" autocomplete="off">  
                                                                                                </div>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dd>
                                                                                            <div class="col-xs-6" style="width: 100%">
                                                                                                <label class="control-label text-green">Minimum of 8 hours of Training/Seminar.</label>
                                                                                            </div>
                                                                                        </dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                        <dt style="margin-top: 10px;">-</dt>
                                                                                        <dd style="margin-top: 10px;">-</dd>
                                                                                    </dl>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    </ul>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-body">
                                                    <table id="trainingAndSeminarsTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>No of Hours</th>
                                                                <th>File</th>
                                                                <?php if($is_profile_locked) {?>   
                                                                <th>Action</th>
                                                                <?php }?>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
<?php $this->load->view('include/footer'); ?>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.phone.extensions.js" type="text/javascript"></script>
	<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="<?= base_url('public') ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public') ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url('public') ?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('public') ?>/components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
    <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <script>
        $(function () {
            $('.select2').select2();
        })
		// Input mask
		$('[data-mask]').inputmask();

        $(function () {
            $('#datepicker1').datepicker({
                autoclose: true
            });
            $('#datepicker2').datepicker({
                autoclose: true
            });
            $('#datepicker_validity').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#datepicker_date_issued').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            
            $('#edit_datepicker_validity').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#edit_datepicker_date_issued').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            
            $('#datepicker_from').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#datepicker_to').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            }); 
            
            $('#datepicker_edit_from').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            }); 
            
            $('#datepicker_edit_to').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            }); 
            
            
            $('#datepicker_from_we').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            
            $('#datepicker_to_we').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#datepicker_edit_from_we').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            
            $('#datepicker_edit_to_we').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#datepicker_from_vocational_or_technical').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#datepicker_to_vocational_or_technical').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        $(function () {
            $('#educationProfile').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false
            })
        })

        $(function () {

            $('#educationAttainment').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false
            })
        })

        $(function () {

            $('#workExperience').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false
            })
        })

        $(function () {

            $('#trainingTable').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false
            })
        })

        function LoginWith(url) {
            window.open(url, "popup", "width=800,height=500,left=220,top=130");
        }
        
        function onClickManagingHeadCertificate() {
            var file = $('#managing_head_certificate').prop('files')[0];
            if (file) {
                var fileSize = 0;
                if (file.size > 1024 * 1024) {
                    fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                } else {
                    fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                }
                $('#mh_certificate_name').html('Name: ' + '<span class="label label-info">' + file.name + '</pan>');
                $('#mh_certificate_file_size').html('Size: ' + fileSize);
                $('#mh_certificate_file_type').html('Type: ' + file.type);
            }
        }

        $(".UploadPhotoForm").submit('on', function (e) {
            e.preventDefault();
            $('#modalUploadphoto').modal('hide');
            $('#ErrorMessage').html('');
            $("#element_overlap_upload_photo").LoadingOverlay("show");
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
                    $("#element_overlap_upload_photo").LoadingOverlay("hide", true);
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
        
        // href="<?= base_url('profile')?>/pco/picture-requirements"
        
        function onClickProfilePictureNotes() {
            $("#element_overlap_upload_photo").LoadingOverlay("show");
            $.ajax({
                dataType: "json",
                type: "post",
                headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('redirect-user-to-picture-requirements') ?>',
                success: function (data)
                {
                    $("#element_overlap_upload_photo").LoadingOverlay("hide", true);
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
                        window.open(data.redirectUrl,'_blank');
                    }
                },
                error: function (jqXHR, status, err) {
                    $("#element_overlap_upload_photo").LoadingOverlay("hide", true);
                    alert('Local error callback, Please try again...');
                }
            });
        }
        
        function onClickSignatureReqNotes() {
            $("#element_overlap_signature").LoadingOverlay("show");
            $.ajax({
                dataType: "json",
                type: "post",
                headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('redirect-user-to-signature-requirements') ?>',
                success: function (data)
                {
                    $("#element_overlap_signature").LoadingOverlay("hide", true);
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
                        window.open(data.redirectUrl,'_blank');
                    }
                },
                error: function (jqXHR, status, err) {
                    $("#element_overlap_signature").LoadingOverlay("hide", true);
                    alert('Local error callback, Please try again...');
                }
            });
        }

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
        
        $("#personalProfileF").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageP').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_personal_profile").LoadingOverlay("show");
            var file_data = $('#managing_head_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('managing_head_certificate', file_data); 
            form_data.append('user_id', $('#user_id').val());
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('first_name',$('#first_name').val());
            form_data.append('last_name',$('#last_name').val()); 
            form_data.append('middle_name',$('#middle_name').val()); 
            form_data.append('extension_name',$('#extension_name').val()); 
            form_data.append('gender',$('input[name=gender]:checked','#personalProfileF').val()); 
            form_data.append('citizenship',$('#citizenship').val()); 
            form_data.append('address',$('#address').val()); 
            form_data.append('telephone_number',$('#telephone_number').val()); 
            form_data.append('mobile_no',$('#mobile_no').val()); 
            form_data.append('email',$('#email').val()); 
            form_data.append('is_managing_head',$('input[name=is_managing_head]:checked','#personalProfileF').val());  
            form_data.append('managing_head',$('#managing_head').val()); 
            form_data.append('attachment_id',$('#attachment_id').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('update-personal-profile'); ?>',
                success: function (data)
                {
                    $("#element_overlap_personal_profile").LoadingOverlay("hide", true);
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
                    $('#ErrorMessageP').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
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
        
        $(function () {
            $('#licenseTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url('license-data-table') ?>",
                    type: "post",
                    data: {account_id: $("#account_fk").val()},
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    error: function () {
                        $(".data-grid-error").html("");
                        $("#contacts-grid").append('<tbody class="data-grid-error"><tr><th align="center" colspan="5">No data found in the server</th></tr></tbody>');
                        $("#data-grid_processing").css("display", "none");
                    }
                },
            });
        });
        
        function editLicense(license_id,attachment_id) {
           $("#collapse-edit-box").collapse('show');
           var table = $('#licenseTable').DataTable();
           $('#licenseTable tbody').on('click', 'tr', function(evt) { 
               if ( $(evt.target).is("a") ) {
                    $('#license_fk').val(license_id);
                    $('#attachment_id').val(attachment_id);
                    $('#edit_datepicker_date_issued').val(table.row( this ).data()[1]);
                    $('#edit_prc_license_no').val(table.row( this ).data()[0]);
                    $('#edit_datepicker_validity').val(table.row( this ).data()[2]);
                }
           });
        }
        
        $("#editLicenseForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageLF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_lf").LoadingOverlay("show");
            var file_data = $('#edit_prc_license_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('license_id', $('#license_fk').val());
            form_data.append('attachment_id', $('#attachment_id').val());
            form_data.append('edit_prc_license_no', $('#edit_prc_license_no').val());
            form_data.append('edit_prc_license_certificate', file_data); 
            form_data.append('edit_date_issued',$('#edit_datepicker_date_issued').val());
            form_data.append('edit_validity',$('#edit_datepicker_validity').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('edit-license'); ?>',
                success: function (data)
                {
                    $("#element_overlap_lf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageLF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#licenseTable').DataTable().ajax.reload();
                        $('#ErrorMessageLF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#editLicenseForm').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageLF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        $("#add_college_degree").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageEAF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_eaf").LoadingOverlay("show");
            var file_data = $('#college_diploma').prop('files')[0];
            var form_data = new FormData();
            form_data.append('college_diploma', file_data); 
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('school', $('#school').val());
            form_data.append('college_school_address', $('#college_school_address').val());
            form_data.append('course', $('#course').val());
            form_data.append('degree_or_units_earned',$('#degree_or_units_earned').val());
            form_data.append('from_date',$('#datepicker_from').val()); 
            form_data.append('to_date',$('#datepicker_to').val()); 
            form_data.append('graduated',$('input[name=attainment]:checked','#add_college_degree').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('add-educational-attainment-college-degree'); ?>',
                success: function (data)
                {
                    $("#element_overlap_eaf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageEAF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#educationAttainmentTable').DataTable().ajax.reload();
                        $('#ErrorMessageEAF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#add_college_degree').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageEAF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        }); 
        
        $("#vocational_technical_form").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageEAF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_eaf").LoadingOverlay("show");
            var file_data = $('#vocational_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('vocational_certificate', file_data); 
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('school', $('#vocational_of_technical_school').val());
            form_data.append('school_address', $('#vocational_or_technical_school_address').val());
            form_data.append('course', $('#vocational_of_technical_course').val());
            form_data.append('degree_or_units_earned',$('#grade_year_level_units').val());
            form_data.append('from_date',$('#datepicker_from_vocational_or_technical').val()); 
            form_data.append('to_date',$('#datepicker_to_vocational_or_technical').val()); 
            form_data.append('graduated',$('input[name=attainment]:checked','#vocational_technical_form').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('add-educational-attainment-vocational-or-technical'); ?>',
                success: function (data)
                {
                    $("#element_overlap_eaf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageEAF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#educationAttainmentTable').DataTable().ajax.reload();
                        $('#ErrorMessageEAF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#vocational_technical_form').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageEAF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        $(function () {
            var  groupColumn = 1;
            $('#educationAttainmentTable').DataTable({
                "columnDefs": [
                    { "visible": false, "targets": groupColumn }
                ],
                "order": [[groupColumn, "asc" ]],
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows({page:'current'}).nodes();
                    var last = null;
                    api.column(groupColumn,{page:'current'}).data().each(function(group, i) {
                       if(last !== group) {
                           $(rows).eq(i).before(
                                '<tr class="group"><td colspan="9">'+ group +'</td></tr>'
                            );
                        last = group;
                       };
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url('educational-data-table') ?>",
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
        
        $('#educationAttainmentTable tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if(currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            } else {
                table.order([groupColumn, 'asc']).draw();
            }
        }); 
        
        function editEducational(educational_id, attachment_id) {
           $("#educational-attainment-collapse-edit-box").collapse('show');
           var table = $('#educationAttainmentTable').DataTable();
           $('#educationAttainmentTable tbody').on('click', 'tr', function(evt) { 
                if ( $(evt.target).is("a") ) {
                    $('#educational_id').val(educational_id); 
                    $('#edit_college_educational_attainment_attachment_id').val(attachment_id); 
                    $('#edit_school').val(table.row( this ).data()[0]);
                    $('#edit_course').val(table.row( this ).data()[2]);
                    $('#edit_degree_or_units_earned').val(table.row( this ).data()[3]);
                    $('#datepicker_edit_from').val(table.row( this ).data()[4]);
                    $('#datepicker_edit_to').val(table.row( this ).data()[5]);
                    $('#edit_college_school_address').val(table.row( this ).data()[8]);
                }
           });
        }
        
        $("#edit_educational_attainment_form").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageEEAF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_eaf").LoadingOverlay("show");
            var file_data = $('#edit_college_diploma').prop('files')[0];
            var form_data = new FormData();
            form_data.append('attachment_id', $('#edit_college_educational_attainment_attachment_id').val());
            form_data.append('college_diploma', file_data); 
            form_data.append('educational_id', $('#educational_id').val());
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('school', $('#edit_school').val());
            form_data.append('college_school_address', $('#edit_college_school_address').val());
            form_data.append('course', $('#edit_course').val());
            form_data.append('degree_or_units_earned',$('#edit_degree_or_units_earned').val());
            form_data.append('from_date',$('#datepicker_edit_from').val()); 
            form_data.append('to_date',$('#datepicker_edit_to').val()); 
            form_data.append('graduated',$('input[name=edit_attainment]:checked','#edit_educational_attainment_form').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('edit-educational-attainment'); ?>',
                success: function (data)
                {
                    $("#element_overlap_eaf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageEEAF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#educationAttainmentTable').DataTable().ajax.reload();
                        $('#ErrorMessageEEAF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#edit_educational_attainment_form').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageEEAF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        // --------------------------- TODO
        $(function () {
            $("#editEducationalAttainmentForm").submit('on', function (e) {
                e.preventDefault();
                $('#ErrorMessageEEAF').html('<span style="color:#060;">Please wait...</span>');
                $("#element_overlap_eaf").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    data: $('#editEducationalAttainmentForm').serializeArray(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: $('#editEducationalAttainmentForm').attr('action'),
                    success: function (data)
                    {
                        $("#element_overlap_eaf").LoadingOverlay("hide", true);
                        if (data.code === 400)
                        {
                            $('#ErrorMessageEEAF').html('<span style="color:red;">' + data.error + '</span>');
                        }
                        if (data.status === 0)
                        {
                            $('#ErrorMessageEEAF').html('<span style="color:red;">' + data.message + '</span>');
                        }
                        if (data.status === 1)
                        {
                            $('#educationAttainmentTable').DataTable().ajax.reload();
                            $('#ErrorMessageEEAF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageEEAF').html("'<span style='color:red;'>'Local error callback. Please try again!</span>");
                    }
                });
            });
        });
        
        $("#licenseForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageLF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_lf").LoadingOverlay("show");
            var file_data = $('#prc_license_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('prc_license_no', $('#prc_license_no').val());
            form_data.append('prc_license_certificate', file_data); 
            form_data.append('date_issued',$('#datepicker_date_issued').val());
            form_data.append('validity',$('#datepicker_validity').val()); 
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('add-license'); ?>',
                success: function (data)
                {
                    $("#element_overlap_lf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageLF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#licenseTable').DataTable().ajax.reload();
                        $('#ErrorMessageLF').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#licenseForm').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageLF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        $("#workExperienceForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageWEF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_wef").LoadingOverlay("show");
            var file_data = $('#work_experience_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('account_fk', $('#account_fk').val());
            form_data.append('work_experience_certificate', file_data);
            form_data.append('company',$('#company').val());
            form_data.append('position',$('#position').val());
            form_data.append('employment_status',$('#employment_status').val()); 
            form_data.append('from_date',$('#datepicker_from_we').val());
            form_data.append('to_date',$('#datepicker_to_we').val());
            form_data.append('present',$('#present').is(":checked"));
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('add-wrok-experience'); ?>',
                success: function (data)
                {
                    $("#element_overlap_wef").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageWEF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#workExperienceTable').DataTable().ajax.reload();
                        $('#ErrorMessageWEF').html('<span style="color:#060;">' + data.message + '</span>');
                        $('#workExperienceForm').trigger('reset');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageWEF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
         $(function () {
            $('#workExperienceTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url('work-experience-data-table') ?>",
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
        
        function editWorkExperienceData(id,attachment_id) {
           $("#work-experience-collapse-edit-box").collapse('show');
           var table = $('#workExperienceTable').DataTable();
           $('#workExperienceTable tbody').on('click', 'tr', function(evt) { 
                if ( $(evt.target).is("a") ) {
                    $('#work_experience_id').val(id);
                    $('#attachment_id').val(attachment_id);
                    $('#edit_company').val(table.row( this ).data()[0]);
                    $('#edit_position').val(table.row( this ).data()[1]);
                    $('#edit_employment_status').val(table.row( this ).data()[2]);
                    $('#datepicker_edit_from_we').val(table.row( this ).data()[3]);
                    $('#datepicker_edit_to_we').val(table.row( this ).data()[4]);
                   // $('#edit_present').attr('checked', table.row( this ).data()[5]); 
                }
           });
        }     
        
        $("#editWorkExperienceForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageEWEF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_wef").LoadingOverlay("show");
            var file_data = $('#edit_work_experience_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('work_experience_id', $('#work_experience_id').val());
            form_data.append('attachment_id', $('#attachment_id').val());
            form_data.append('work_experience_certificate', file_data);
            form_data.append('company',$('#edit_company').val());
            form_data.append('position',$('#edit_position').val());
            form_data.append('employment_status',$('#edit_employment_status').val()); 
            form_data.append('from_date',$('#datepicker_edit_from_we').val());
            form_data.append('to_date',$('#datepicker_edit_to_we').val());
            form_data.append('present',$('#edit_present').is(":checked"));
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('edit-wrok-experience'); ?>',
                success: function (data)
                {
                    $("#element_overlap_wef").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageEWEF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#workExperienceTable').DataTable().ajax.reload();
                        $('#ErrorMessageEWEF').html('<span style="color:#060;">' + data.message + '</span>');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageEWEF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        $("#trainingForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageTSF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_tsf").LoadingOverlay("show");
            var file_data = $('#training_and_seminars_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('account_fk', $('#account_fk').val()); 
            form_data.append('title', $('#title').val());
            form_data.append('no_of_hours', $('#no_of_hours').val());
            form_data.append('training_and_seminars_certificate', file_data);
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('add-training-and-seminars'); ?>',
                success: function (data)
                {
                    $("#element_overlap_tsf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageTSF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#trainingAndSeminarsTable').DataTable().ajax.reload();
                        $('#trainingForm').trigger('reset');
                        $('#ErrorMessageTSF').html('<span style="color:#060;">' + data.message + '</span>');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageTSF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
        $(function () {
            $('#trainingAndSeminarsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url('training-and-seminars-data-table') ?>",
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
        
        function editTrainingSeminarsData(id,attachment_id) {
           $("#edit-trainings-collapse-add-box").collapse('show');
           var table = $('#trainingAndSeminarsTable').DataTable();
           $('#trainingAndSeminarsTable tbody').on('click', 'tr', function(evt) { 
                if ( $(evt.target).is("a") ) {
                    $('#training_and_seminars_id').val(id);
                    $('#tSAttachment_id').val(attachment_id);
                    $('#edit_title').val(table.row( this ).data()[0]);
                    $('#edit_no_of_hours').val(table.row( this ).data()[1]);
                }
           });
        }  
        
        $("#editTrainingForm").submit('on', function (e) {
            e.preventDefault();
            $('#ErrorMessageETSF').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_tsf").LoadingOverlay("show");
            var file_data = $('#edit_training_and_seminars_certificate').prop('files')[0];
            var form_data = new FormData();
            form_data.append('training_and_seminars_id', $('#training_and_seminars_id').val()); 
            form_data.append('attachment_id', $('#tSAttachment_id').val());
            form_data.append('edit_title', $('#edit_title').val());
            form_data.append('edit_no_of_hours', $('#edit_no_of_hours').val());
            form_data.append('edit_training_and_seminars_certificate', file_data);
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('edit-training-and-seminars'); ?>',
                success: function (data)
                {
                    $("#element_overlap_tsf").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#ErrorMessageETSF').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#trainingAndSeminarsTable').DataTable().ajax.reload();
                        $('#ErrorMessageETSF').html('<span style="color:#060;">' + data.message + '</span>');
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#ErrorMessageETSF').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        });
        
    </script>
</body>
</html>
