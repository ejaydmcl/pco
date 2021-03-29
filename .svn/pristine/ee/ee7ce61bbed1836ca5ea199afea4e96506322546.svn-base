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
                    Add New Application Form
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>New form</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div id="response"></div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"> <a aria-expanded="true" href="#new-application" data-toggle="tab">FOR NEW APPLICATION</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="response"></div>
                        <div class="tab-pane active" id="new-application">
                            <form class="form-horizontal" id="newForm">
                                <div class="box-body margin">
                                    <div class="row">
                                        <div class="col-md-12">                                                       
                                            <div class="form-group"> 
                                                <div class="col-sm-4">
                                                    <label for="region">Region</label>
                                                    <select class="form-control select2" id="region" name="region" style="width: 100%;">
                                                        <option value="" selected disabled>-SELECT-</option>
                                                        <?php foreach ($region as $key => $value) { ?>
                                                            <option value="<?php echo $value->reg_code ?>" ><?php echo $value->reg_desc ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="establishment_name">Name of Establishment</label>
                                                    <input type="hidden" class="form-control" id="account_fk" name="account_fk" value="<?php echo isset($account_fk) == TRUE ? $account_fk : NULL ?>">
                                                    <input type="hidden" class="form-control" id="type" name="type" value="1">
                                                    <div class="element_overlap_est_name">
                                                        <select class="form-control select2 select2-hidden-accessible" id="establishment_name" name="establishment_name" style="width: 100%;" required>
                                                            <option value="" selected disabled>-SELECT-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="website">Website <i class="text-info small">(Example: https://example.com)</i></label>
                                                    <input type="text" class="form-control" id="website" name="website" autocomplete="off" placeholder="http://example.com" required>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label>Nature Of Business of The Establishment</label>
                                                    <select class="form-control select2" id="nature_of_business" name="nature_of_business" style="width: 100%;">
                                                        <option value="" selected disabled>-SELECT-</option>
                                                        <?php foreach ($nature_of_business as $key => $value) { ?>
                                                            <option value="<?php echo $value['category'] ?>" ><?php echo $value['category'] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Establishment Category based on DAO <a href="<?= base_url('uploads') ?>/attachment/system/DAO-no.-2014-02 - Revised Guidelines for PCO Accreditation.pdf" target="_blank"><i style="font-style: italic;">refer here</i></a></label>
                                                    <select class="form-control select2" id="establishment_category" name="establishment_category" style="width: 100%;">
                                                        <option value="" selected disabled>SELECT</option>
                                                        <option value="Category A" >Category A</option>
                                                        <option value="Category B" >Category B</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="telephone_div">Telephone Number <i class="text-info small">(Put <b>n/a</b> if not applicable)</i></label>
                                                    <div id="telephone_div" class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="telephone_no" name="telephone_no" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label>PCO Employment Status</label>
                                                    <select class="form-control select2" id="pco_employment_status" name="pco_employment_status" style="width: 100%;">
                                                        <option value="" selected disabled>SELECT</option>
                                                        <?php foreach ($pco_employment_status as $key => $value) { ?>
                                                            <option value="<?php echo $value['id'] ?>" ><?php echo $value['label'] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Current Position</label>
                                                    <input type="text" class="form-control" id="current_position" name="current_position" placeholder="Current position" autocomplete="off" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Number of Years in Current Position</label>
                                                    <input type="number" class="form-control" id="no_of_years_in_current_position" name="no_of_years_in_current_position" placeholder="No. of years" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control" id="address" name="address" placeholder="..." required></textarea>
                                                </div>
                                            </div> 
                                            <br>
                                            <h4><p class="text-muted">Do you have any pending</p></h4>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <h4><p class="text-green" style="margin-top: 20px;">A. Administrative Case</p></h4>
                                                    <div class="col-6 col-sm-3">
                                                        <div class="row">    
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" value="1" id="administrative_case" name="administrative_case" required> Yes
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-sm-3">
                                                        <div class="row"> 
                                                            <div class="radio">   
                                                                <label>
                                                                    <input type="radio" value="0" id="administrative_case" name="administrative_case" checked required> No
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
                                                                    <input type="radio" value="1" id="criminal_case" name="criminal_case" required> Yes
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-sm-3">
                                                        <div class="row">
                                                            <div class="radio">
                                                                <label>  
                                                                    <input type="radio" value="0" id="criminal_case" name="criminal_case" checked required> No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <textarea id="administrative_case_details" name="administrative_case_details" class="form-control" placeholder="..."></textarea>
                                                </div>
                                                <div class="col-sm-4">
                                                    <textarea id="criminal_case_details" name="criminal_case_details" class="form-control" placeholder="..."></textarea>    
                                                </div>
                                            </div>
                                            <br>
                                            <h4><p class="text-muted">Attachments</p></h4>
                                            <p class="text-green">Browse the PDF copy of the document and click the upload button. <i class="text-info small">(File size should not more than 10MB.)</i><p>
                                            <div class="form-group">
                                                <div class="col-md-4"><p class="text-muted"> 1. Dully signed Appointment or Designation of the PCO.</p>
                                                    <div type="button" class="btn btn-primary btn-sm" onclick="$('#dully_sined_appointment_or_designation').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                    <input type="file" class="file-upload-input1" name="dully_sined_appointment_or_designation" style="opacity: 0;" id="dully_sined_appointment_or_designation" required onchange="onClickDullySinedAppointmentOrDesignation();"/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <label></label>
                                                        <div id="dsadesignation_file_name"></div>
                                                        <div id="dsadesignation_file_size"></div>
                                                        <div id="dsadesignation_file_type"></div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <p class="text-muted"> 2. Certificate of Employment (Full-time/Part-time employee)  </p>
                                                    <div type="button" class="btn btn-primary btn-sm" onclick="$('#certificate_of_employment').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                    <input type="file" class="file-upload-input3" name="certificate_of_employment" style="opacity: 0;" id="certificate_of_employment" required onchange="onClickCertificateOfEmployment();"/>                                        
                                                </div>
                                                <div class="form-group">
                                                    <div class="list-group">
                                                        <div class="col-md-2">
                                                            <label></label>
                                                            <div id="coe_file_name"></div>
                                                            <div id="coe_file_size"></div>
                                                            <div id="coe_file_type"></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div><hr>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <p class="text-muted"> 3. Notarized affidavit of Joint Undertaking of the PCO and the Managing Head <b>(format is available in the downloadable forms)</b></p>
                                                    <div type="button" class="btn btn-primary btn-sm" onclick="$('#notarized_affidavit_of_joint_undertaking').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                    <input type="file" class="file-upload-input4" name="notarized_affidavit_of_joint_undertaking" style="opacity: 0;" id="notarized_affidavit_of_joint_undertaking" required onchange="onClickNotarizedAffidavit();"/>                                        
                                                </div>
                                                <div class="form-group">
                                                    <div class="list-group">
                                                        <div class="col-md-2">
                                                            <label></label>
                                                            <div id="naffi_file_name"></div>
                                                            <div id="naffi_file_size"></div>
                                                            <div id="naffi_file_type"></div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="padding:20px; ">
                                    <table>
                                        <tr>
                                            <td style="padding-left: 10px; padding-bottom: 20px;">
                                                <button type="submit" id="action" name="action" value="Save" class="btn btn-primary btn-lg">Save Application</button>
                                            </td>
                                            <td style="padding-left: 10px; padding-bottom: 20px;">
                                                <button type="submit" id="action" name="action" value="Submit" class="btn btn-success btn-lg">Submit Application</button>
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
    </section>
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('include/footer'); ?>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.phone.extensions.js" type="text/javascript"></script>
<script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
    //Initialize Select2 Elements
    $('#nature_of_business').select2()
    $('#establishment_category').select2()
    $('#pco_employment_status').select2()
    $('.select2').select2();

    // Input mask
    $('[data-mask]').inputmask()

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
            $('#p_fee_file_name').html('Name: ' + '<span class="label label-info">' + file.name + '</pan>');
            $('#p_fee_file_size').html('Size: ' + fileSize);
            $('#p_fee_file_type').html('Type: ' + file.type);
        }
    }

    $("#newForm button").click(function (ev) {
        ev.preventDefault()
        $('#ErrorMessageNF').html('<span style="color:#060;">Please wait...</span>');
        $("#element_overlap_nf").LoadingOverlay("show");
        var dsad_file_data = $('#dully_sined_appointment_or_designation').prop('files')[0];
        var coe_file_data = $('#certificate_of_employment').prop('files')[0];
        var naffi_file_data = $('#notarized_affidavit_of_joint_undertaking').prop('files')[0];
        if (dsad_file_data === undefined || dsad_file_data === null) {
            $("#element_overlap_nf").LoadingOverlay("hide", true);
            var warning = '<div class="alert alert-dismissible alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>The Dully sined appointment or designation field is required.</i>' +
                                '</div>';
            $('#ErrorMessageNF').html(warning);  
            return false;
        }
        if (coe_file_data === undefined || coe_file_data === null) {
            $("#element_overlap_nf").LoadingOverlay("hide", true);
            var warning = '<div class="alert alert-dismissible alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>The Certificate of employment field is required.</i>' +
                                '</div>';
            $('#ErrorMessageNF').html(warning); 
            return false;
        }
        if (naffi_file_data === undefined || naffi_file_data === null) {
            $("#element_overlap_nf").LoadingOverlay("hide", true);
            var warning = '<div class="alert alert-dismissible alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong>Oops! </strong>' +
                                '<i>The Notarized affidavit of joint undertaking field is required.</i>' +
                                '</div>';
            $('#ErrorMessageNF').html(warning); 
            return false;
        }

        var form_data = new FormData();
        form_data.append('account_fk', $('#account_fk').val());
        form_data.append('type', $('#type').val());
        form_data.append('region', $('#region').val());
        form_data.append('establishment_name', $('#establishment_name option:selected').text());
        form_data.append('address', $('#address').val());
        form_data.append('nature_of_business', $('#nature_of_business').val());
        form_data.append('establishment_category', $('#establishment_category').val());
        form_data.append('telephone_no', $('#telephone_no').val());
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
        if ($(this).attr("value") === "Save") {
            form_data.append('submit', 1);
        }
        if ($(this).attr("value") === "Submit") {
            form_data.append('submit', 2);
        }
        if ($(this).attr("value") === "Order Of Payment") {
            form_data.append('submit', 3);
        }
        $.ajax({
            dataType: "json",
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
            url: '<?= base_url('add-new-application-data'); ?>',
            success: function (data)
            {
                $("#element_overlap_nf").LoadingOverlay("hide", true);
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
                    alert('Successfully save!');
                    window.location = '<?php echo base_url('application-page'); ?>';
                }
                if (data.status === 2)
                {
                    alert('Successfully submitted!');
                    window.location = '<?php echo base_url('application-page'); ?>';
                }

            },
            error: function (jqXHR, status, err) {
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
