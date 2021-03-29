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
                    Application Full Details
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text"></i>Application full details</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div id="response"></div>
                <!-- Modal -->
                <div class="modal fade" data-backdrop="false" id="modalUploadPDF" role="dialog" style="background: rgba(0,0,0,0.64) !important;">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form class="UploadForm">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="document_name">Upload PDF File</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="file" required id="userImage">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary Upload">Upload</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="user-block">
                                    <div class="nav-tabs-custom" id="element_overlap_afd">
                                        <img class="img-circle img-bordered-sm" src="<?= base_url('uploads') ?>/profiles/<?php $photo = $photo_name == FALSE ? 'no-image.png' : $photo_name; echo $photo; ?>" alt="user image">
                                        <span class="username">
                                            <a onclick="onClickPCOName(<?php echo $account_id; ?>)" href="javascript:void(0);" > <?php echo $pco_name; ?> </a>
                                        </span>
                                        <span class="description">Date submitted - <?php echo gmdate('F j, Y H:i:s A', strtotime($date_created) + date("Z"));?> </span>
                                        <form class="form-horizontal" id="editApplicationDetailsF">
                                            <div class="row ">
                                                <div class="box-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <label for="region">Region</label>
                                                                <select class="form-control select2" id="region" name="region" style="width: 100%;">
                                                                    <option value="" selected disabled>-SELECT-</option>
                                                                    <?php foreach ($region as $key => $value) { ?>
                                                                        <?php if($selected_region == $value->reg_code) {?>
                                                                            <option selected value="<?php echo $value->reg_code ?>" ><?php echo $value->reg_desc ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="<?php echo $value->reg_code ?>" ><?php echo $value->reg_desc ?></option>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Name of Establishment</label>
                                                                <input type="hidden" class="form-control" id="account_fk" name="account_fk" value="<?php echo isset($account_id) == TRUE ? $account_id : NULL ?>">
                                                                <input type="hidden" class="form-control" id="selected_application_id" name="selected_application_id" value="<?php echo isset($selected_application_id) == TRUE ? $selected_application_id : NULL ?>">
                                                                <input type="hidden" class="form-control" id="application_status_id" name="application_status_id" value="<?php echo isset($application_status_id) == TRUE ? $application_status_id : NULL ?>">
                                                                <input type="hidden" class="form-control" id="application_type_id" name="application_type_id" value="<?php echo isset($application_type_id) == TRUE ? $application_type_id : NULL ?>">
                                                                <div class="element_overlap_est_name">
                                                                    <select class="form-control select2 select2-hidden-accessible" id="establishment_name" name="establishment_name" style="width: 100%;" required>
                                                                        <option value="" selected disabled><?php echo $name_of_establishment; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-4">
                                                                <label>Website <i class="text-info small">(Example: https://example.com)</i></label>
                                                                <input type="text" class="form-control" id="website" name="website" value="<?php echo $website; ?>" placeholder="http://example.com">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <label>Nature Of Business of The Establishment </label>
                                                                <select class="form-control select2" id="nature_of_business" name="nature_of_business" style="width: 100%;">
                                                                        <option value="<?php echo $nature_of_business_of_the_establishment ?>" ><?php echo $nature_of_business_of_the_establishment ?></option>
                                                                            <?php foreach ($nature_of_business as $key => $value) { ?>
                                                                                <option value="<?php echo $value['category'] ?>" ><?php echo $value['category'] ?></option>
                                                                            <?php }
                                                                            ?>
                                                                    </select>
                                                            </div>  
                                                            <div class="col-sm-4">
                                                                <label>Establishment Category based on DAO 2014-02 <a href="<?= base_url('uploads') ?>/attachment/system/DAO-no.-2014-02 - Revised Guidelines for PCO Accreditation.pdf" target="_blank"><i style="font-style: italic;">refer here</i></a></label>
                                                                <select class="form-control select2" id="establishment_category" name="establishment_category" style="width: 100%;">
                                                                    <option value="<?php echo $establishment_category ?>" ><?php echo $establishment_category ?></option>
                                                                    <option value="Category A" >Category A</option>
                                                                    <option value="Category B" >Category B</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Telephone Number <i class="text-info small">(Put <b>n/a</b> if not applicable)</i></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                      <i class="fa fa-phone"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="telephone_no" name="telephone_no" value="<?php echo $telephone_no; ?>" placeholder="Telephone number" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <label>PCO Employment Status</label>
                                                                <select class="form-control select2" id="pco_employment_status" name="pco_employment_status" style="width: 100%;">
                                                                    <option value="<?php echo $pco_employment_status[0]['id']; ?>" > <?php echo $pco_employment_status[0]['label']; ?></option>
                                                                    <?php foreach ($employment_status as $key => $value) { ?>
                                                                        <option value="<?php echo $value['id'] ?>" > <?php echo $value['label'] ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Current Position</label>
                                                                <input type="text" class="form-control" id="current_position" name="current_position" value="<?php echo $current_position; ?>" placeholder="Current Position">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Number of Years in Current Position</label>
                                                                <input type="text" class="form-control" id="no_of_years_in_current_position" name="no_of_years_in_current_position" value="<?php echo $number_of_years_in_current_position; ?>" placeholder="Number of Years in Current Position">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <label>Address</label>
                                                                <textarea class="form-control" id="address" name="address" placeholder="Address"/><?php echo $address; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <h4><p class="text-green" style="margin-top: 20px;">A. Administrative Case</p></h4>
                                                                <div class="col-6 col-sm-3">
                                                                    <div class="row">    
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" value="1" id="administrative_case" name="administrative_case" <?php echo $administartive_case == 0 ? '' : 'checked' ?>> Yes
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-sm-3">
                                                                    <div class="row"> 
                                                                        <div class="radio">   
                                                                            <label>
                                                                                <input type="radio" value="0" id="administrative_case" name="administrative_case" <?php echo $administartive_case == 1 ? '' : 'checked' ?>> No
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <h4><p class="text-green" style="margin-top: 20px;">B. Criminal Case</p></h4>
                                                                <div class="col-6 col-sm-3">
                                                                    <div class="row">
                                                                        <div class="radio">    
                                                                            <label>
                                                                                <input type="radio" value="1" id="criminal_case" name="criminal_case" <?php echo $criminal_case == 0 ? '' : 'checked' ?>> Yes
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-sm-3">
                                                                    <div class="row">
                                                                        <div class="radio">
                                                                            <label>  
                                                                                <input type="radio" value="0" id="criminal_case" name="criminal_case" <?php echo $criminal_case == 1 ? '' : 'checked' ?>> No
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <textarea id="administrative_case_details" name="administrative_case_details" class="form-control" placeholder="..." /><?php echo $administartive_details; ?></textarea>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <textarea id="criminal_case_details" name="criminal_case_details" class="form-control" placeholder="..."/><?php echo $criminal_details; ?></textarea>    
                                                            </div>
                                                        </div>
                                                        <h4><p class="text-muted">Attachments</p></h4>
                                                        <div class="form-group">
                                                            <div class="col-md-4"><p class="text-muted"> 1. Dully signed Appointment or Designation of the PCO</p>
															<?php if($is_application_editable == true) { ?>	
                                                            <?php if($application_status_id != APPROVED && $is_view_by_pco == true) { ?>
                                                                <div type="button" class="btn btn-primary btn-sm" onclick="$('#dully_sined_appointment_or_designation').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                                <input type="file" class="file-upload-input1" name="dully_sined_appointment_or_designation" style="opacity: 0;" id="dully_sined_appointment_or_designation" onchange="onClickDullySinedAppointmentOrDesignation();"/>
																<?php } ?>
																<?php } ?>
															</div>
                                                            <div class="form-group">
                                                                <div class="col-md-6">
                                                                    <label></label>
                                                                    <?php  
                                                                    if(isset($dully_signed)) { ?>
                                                                    <div id="dsadesignation_file_name">File:  <span class="label label-info" style="margin-right: 10px;" >Dully signed Appointment or Designation</span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName($dully_signed) ?>" target="_blank" class="label label-danger" >view</a></div>
                                                                    <?php } ?>
                                                                    <div id="dsadesignation_file_name"></div>
                                                                    <div id="dsadesignation_file_size"></div>
                                                                    <div id="dsadesignation_file_type"></div>
                                                                </div>
                                                            </div>
                                                        </div><hr>
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <p class="text-muted"> 2. Certificate of Employment (Full-time/Part-time employee)  </p>
																<?php if($is_application_editable == true) { ?>	
                                                                <?php if($application_status_id != APPROVED && $is_view_by_pco == true) { ?>
                                                                <div type="button" class="btn btn-primary btn-sm" onclick="$('#certificate_of_employment').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                                <input type="file" class="file-upload-input3" name="certificate_of_employment" style="opacity: 0;" id="certificate_of_employment" onchange="onClickCertificateOfEmployment();"/>                                        
																<?php } ?>
																<?php } ?>
															</div>
                                                            <div class="form-group">
                                                                <div class="list-group">
                                                                    <div class="col-md-6">
                                                                        <label></label>
                                                                        <?php  
                                                                            if(isset($certificate_of_employment)) { ?>
                                                                            <div id="coe_file_name">File:  <span class="label label-info" style="margin-right: 10px;" >Certificate of Employment</span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName($certificate_of_employment) ?>" target="_blank" class="label label-danger" >view</a></div>
                                                                        <?php } ?>
                                                                        <div id="coe_file_name"></div>
                                                                        <div id="coe_file_size"></div>
                                                                        <div id="coe_file_type"></div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div><hr>
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <p class="text-muted"> 3. Notarized affidavit of Joint Undertaking of the PCO and the Managing Head <b>(format is available of EMB XI)</b></p>
                                                                <?php if($is_application_editable == true) { ?>	
																<?php if($application_status_id != APPROVED && $is_view_by_pco == true) { ?>
																<div type="button" class="btn btn-primary btn-sm" onclick="$('#notarized_affidavit_of_joint_undertaking').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                                <input type="file" class="file-upload-input4" name="notarized_affidavit_of_joint_undertaking" style="opacity: 0;" id="notarized_affidavit_of_joint_undertaking" onchange="onClickNotarizedAffidavit();"/>                                        
																<?php } ?>
																<?php } ?>
															</div>
                                                            <div class="form-group">
                                                                <div class="list-group">
                                                                    <div class="col-md-6">
                                                                        <label></label>
                                                                        <?php  
                                                                            if(isset($notarized_affidavit)) { ?>
                                                                            <div id="naffi_file_name">File:  <span class="label label-info" style="margin-right: 10px;" >Notarized affidavit of Joint Undertaking</span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName($notarized_affidavit) ?>" target="_blank" class="label label-danger" >view</a></div>
                                                                        <?php } ?>
                                                                        <div id="naffi_file_name"></div>
                                                                        <div id="naffi_file_size"></div>
                                                                        <div id="naffi_file_type"></div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div><hr>
                                                        <div class="form-group">
                                                        <?php if($status >= EVALUATED) { ?>
                                                            <div class="col-md-4">
                                                                <p class="text-muted"> 4. Official receipt</p>
																<?php if($is_application_editable == true) { ?>	
																<?php if($application_status_id != APPROVED && $is_view_by_pco == true) { ?>
                                                                <div type="button" class="btn btn-primary btn-sm" onclick="$('#processing_fee').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                                <input type="file" class="file-upload-input5" name="processing_fee" style="opacity: 0;" id="processing_fee" onchange="onClickProcessingFee();"/>                                        
																<?php } ?>
																<?php } ?>
															</div>
                                                            <div class="form-group">
                                                                <div class="list-group">
                                                                    <div class="col-md-2">
                                                                        <label></label>
                                                                        <?php  
                                                                            if(isset($processing_fee)) { ?>
                                                                            <div id="p_fee_file_name">File:  <span class="label label-info" style="margin-right: 10px;" >Official receipt</span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName($processing_fee) ?>" target="_blank" class="label label-danger" >view</a></div>
                                                                        <?php } ?>
                                                                        <div id="p_fee_file_name"></div>
                                                                        <div id="p_fee_file_size"></div>
                                                                        <div id="p_fee_file_type"></div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        <?php } else { ?>
                                                            <input type="file" class="file-upload-input5" name="processing_fee" style="opacity: 0;" id="processing_fee"/>                                        
                                                        <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                       
                                            <div class="box-footer" style="padding:20px; ">
                                                <table>
                                                    <tr>
                                                        <td  style="padding-left: 10px; padding-bottom: 20px;">
                                                             <?php if($flag) { ?>
                                                                <?php if($is_application_editable == true) { ?>
                                                                    <?php if($application_status_id != APPROVED && $is_view_by_pco == true) { ?>
                                                                        
																		<?php if(!count(array_intersect(array($application_status_id), array(SUBMIT,ONGOING,EVALUATED)))) { ?> 
                                                                            <button type="submit" id="action" name="action" value="Save" class="btn btn-primary btn-lg">Save application</button>
                                                                        <?php } ?>
                                                                        <?php if(count(array_intersect(array($application_status_id), array(SUBMIT,ONGOING,EVALUATED)))) { ?>
                                                                            <button type="submit" id="action" name="action" value="Edit" class="btn btn-primary btn-lg">Save application</button>
                                                                        <?php } ?>
                                                                        <?php if(count(array_intersect(array($application_status_id), array(SAVE)))) { ?>
                                                                            <button type="submit" id="action" name="action" value="Submit" class="btn btn-success btn-lg">Submit application</button>
                                                                        <?php } ?>
																		
																		
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="padding-left: 10px;">
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div style="padding-left: 10px;" id="ErrorMessageNF"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>

        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.phone.extensions.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script>
            //Initialize Select2 Elements
            $('#nature_of_business').select2() 
            $('#establishment_category').select2()  
            $('#pco_employment_status').select2()  
            $('[data-mask]').inputmask()
            $('.select2').select2();
            
            $('select[name="region"]').on('change', function () {
                $(".element_overlap_est_name").LoadingOverlay("show");
                var d = new FormData();
                d.append('region', $(this).val());
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: d,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('list-of-establishment'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap_est_name").LoadingOverlay("hide", true);
                        var items = '<option value>-SELECT-</option>';
                        $.each(data, function (i, ui) {
                            items += "<option value='" + ui.region_name + "'>" + ui.company_name + "</option>";
                        });
                        $('#establishment_name').html(items);
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap_est_name").LoadingOverlay("hide", true);
                        var error = '<div id="company_list_error" class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>Local error callback. Please try again!</i>' +
                                '</div>';
                        $('#response').prepend(error);
                        $('#company_list_error').fadeOut(9000);
                    }
                });
            });
            function onClickDullySinedAppointmentOrDesignation() {
                var file = $('#dully_sined_appointment_or_designation').prop('files')[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024) {
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    } else {
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                    }
                    $('#dsadesignation_file_name').html('Name: ' + '<span class="label label-info">Dully sined appointment or designation</pan>');
                    $('#dsadesignation_file_size').html('Size: ' + fileSize);
                    $('#dsadesignation_file_type').html('Type: ' + file.type);
                }
            }
            function onClickCertificateOfEmployment() {
                var file = $('#certificate_of_employment').prop('files')[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024) {
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    } else {
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                    }
                    $('#coe_file_name').html('Name: ' + '<span class="label label-info">Certificate of employment</pan>');
                    $('#coe_file_size').html('Size: ' + fileSize);
                    $('#coe_file_type').html('Type: ' + file.type);
                }
            }
            function onClickNotarizedAffidavit() {
                var file = $('#notarized_affidavit_of_joint_undertaking').prop('files')[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024) {
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    } else {
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                    }
                    $('#naffi_file_name').html('Name: ' + '<span class="label label-info">Notarized affidavit of joint undertaking</pan>');
                    $('#naffi_file_size').html('Size: ' + fileSize);
                    $('#naffi_file_type').html('Type: ' + file.type);
                }
            }
            function onClickProcessingFee() {
                var file = $('#processing_fee').prop('files')[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024) {
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    } else {
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                    }
                    $('#p_fee_file_name').html('Name: ' + '<span class="label label-info">Official receipt</pan>');
                    $('#p_fee_file_size').html('Size: ' + fileSize);
                    $('#p_fee_file_type').html('Type: ' + file.type);
                }
            }
            function onClickPCOName(accountID) {
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {id: accountID,url:'selected-pco-profile'},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('selected-pco-profile') ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
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
                            //alert(data.message);
                            window.open(data.redirectUrl,'_blank');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        alert('Local error callback');
                    }
                });
            }
            
           $("#editApplicationDetailsF button").click(function (ev) {
                ev.preventDefault()
                $('#ErrorMessageEF').html('<span style="color:#060;">Please wait...</span>');
                $("#element_overlap_afd").LoadingOverlay("show");
                var dsad_file_data = $('#dully_sined_appointment_or_designation').prop('files')[0];
                var coe_file_data = $('#certificate_of_employment').prop('files')[0];
                var naffi_file_data = $('#notarized_affidavit_of_joint_undertaking').prop('files')[0];
                var pfee_file_data = $('#processing_fee').prop('files')[0];
                var form_data = new FormData();  
                form_data.append('application_id', $('#selected_application_id').val());
                form_data.append('application_status', $('#application_status_id').val());
                form_data.append('application_type_id', $('#application_type_id').val());
                form_data.append('account_fk', $('#account_fk').val());
                form_data.append('region', $('#region').val());
                form_data.append('establishment_name', $('#establishment_name option:selected').text());
                form_data.append('address', $('#address').val());
                form_data.append('nature_of_business', $('#nature_of_business').val());
                form_data.append('establishment_category', $('#establishment_category').val());
                form_data.append('telephone_no', $('#telephone_no').val());
                form_data.append('fax_no', $('#fax_no').val());
                form_data.append('website', $('#website').val());
                form_data.append('pco_employment_status', $('#pco_employment_status').val());
                form_data.append('current_position', $('#current_position').val());
                form_data.append('no_of_years_in_current_position', $('#no_of_years_in_current_position').val());
                form_data.append('administrative_case', $("input[name='administrative_case']:checked").val());
                form_data.append('criminal_case', $("input[name='criminal_case']:checked").val());
                form_data.append('administrative_case_details', $('#administrative_case_details').val());
                form_data.append('criminal_case_details', $('#criminal_case_details').val());
                form_data.append('dully_sined_appointment_or_designation', dsad_file_data);
                form_data.append('certificate_of_employment', coe_file_data);
                form_data.append('notarized_affidavit_of_joint_undertaking', naffi_file_data);
                form_data.append('processing_fee', pfee_file_data);
                if ($(this).attr("value") === "Edit") {             
                    form_data.append('submit', 0);
                }
                if ($(this).attr("value") === "Save") {             
                    form_data.append('submit', 1);
                }
                if ($(this).attr("value") === "Submit") {
                    form_data.append('submit', 2);
                }
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('edit-application-data'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap_afd").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            var warning = '<div class="alert alert-dismissible alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>'+ data.message + '</i>' +
                                '</div>';
                             $('#ErrorMessageNF').html(warning);
                        }
                        if (data.status === 1)
                        {
                            var warning = '<div class="alert alert-dismissible alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>'+ data.error+ ": " + data.message + '</i>' +
                                '</div>';
                            $('#ErrorMessageNF').html(warning);
                        }
                        if (data.status === 2)
                        {
                            alert('Successfully updated !');
                            var sucess = '<div class="alert alert-dismissible alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Ver well! </strong>' +
                                '<i>' + data.message + '</i>' +
                                '</div>';
                            $('#ErrorMessageNF').html(sucess);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlap_afd").LoadingOverlay("hide", true);
                        var error = '<div class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>Local error callback. Please try again!</i>' +
                                '</div>';
                        $('#ErrorMessageNF').html(error);
                    }
                });
            });
            
        </script>
</body>
</html>
