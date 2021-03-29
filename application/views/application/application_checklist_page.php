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
                   Application checklist
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text"></i>Application checklist</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="invoice" id="element_overlap1">
                    <!-- title row -->
                    <div class="row">
                      <div class="col-xs-12">
                        <h3 class="page-header">
                            <i class="fa fa-fw fa-building"></i><?php echo $name_of_firm ?>
                        </h3>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                      
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <form id="checklistForm">   
                              <input hidden type="text" id="applicationId" name="applicationId" value="<?php echo $applicationId; ?>"> 
                              <input hidden type="text" id="applicationType" name="applicationType" value="<?php echo $application_type; ?>"> 
                        <table class="table table-striped">
                            <col>
                            <colgroup span="2"></colgroup>
                          <thead>
                          <tr>
                              <th style="text-align: center;" rowspan="2">PCO Requirements<br>(<?php $type = $application_type == 1 ? 'NEW':'RENEWAL'; echo $type; ?>)</th>
                            <th style="text-align: center;" colspan="2" scope="colgroup">Acceptable?</th>
                            <th style="text-align: center;" rowspan="2">Remarks/Attested by Accountable<br>Officer</th>
                          </tr>
                          <tr>
                              <th style="text-align: center;" scope="col">Yes</th>
                              <th style="text-align: center;" scope="col">No</th>
                          </tr>
                          </thead>
                          <tbody>
                              <?php if($application_type == _NEW) { ?>
                          <tr>
                              <td style="width: 350px;">1. Duly filled up Application Form</td>
                            <td style="text-align: center;"><input type="radio" id="req1" name="req1" value="1" <?php $val = $req1=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req1" name="req1" value="0" <?php $val = $req1=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                 <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks1" name="remarks1" placeholder="..." value="<?php echo $remarks1 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks1 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>2. Duly signed Appointment or Designation of the PCO</td>
                            <td style="text-align: center;"><input type="radio" id="req2" name="req2" value="1" <?php $val = $req2=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req2" name="req2" value="0" <?php $val = $req2=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks2" name="remarks2" placeholder="..." value="<?php echo $remarks2 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks2 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>3. Curriculum Vitae of the Pollution Control Officer (PCO)</td>
                            <td style="text-align: center;"><input type="radio" id="req3" name="req3" value="1" <?php $val = $req3=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req3" name="req3" value="0" <?php $val = $req3=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks3" name="remarks3" placeholder="..." value="<?php echo $remarks3 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks3 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                              <td>4. Copy of College Diploma/Transcript of Record <br>
                                * (Prof.License for Category B Establishments)</td>
                            <td style="text-align: center;"><input type="radio" id="req4" name="req4" value="1" <?php $val = $req4=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req4" name="req4" value="0" <?php $val = $req4=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks4" name="remarks4" placeholder="..." value="<?php echo $remarks4 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks4 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                              <tr>
                                  <td>5. Copy of Certificates of Participation to at least forty (40) hours 
                                      of cumulative relevant EMB-Accredited PCO trainings and seminars.
                                   </td>
                            <td style="text-align: center;"><input type="radio" id="req5" name="req5" value="1" <?php $val = $req5=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req5" name="req5" value="0" <?php $val = $req5=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks5" name="remarks5" placeholder="..." value="<?php echo $remarks5 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks5 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                              <td>6. Copy of Certificate of Training <br>
                                (8hrs) of the Managing Head on
                                Environmental Management</td>
                            <td style="text-align: center;"><input type="radio" id="req6" name="req6" value="1" <?php $val = $req6=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req6" name="req6" value="0" <?php $val = $req6=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks6" name="remarks6" placeholder="..." value="<?php echo $remarks6 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks6 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>7. 2x2 ID Picture with white background</td>
                            <td style="text-align: center;"><input type="radio" id="req7" name="req7" value="1" <?php $val = $req7=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req7" name="req7" value="0" <?php $val = $req7=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks7" name="remarks7" placeholder="..." value="<?php echo  $remarks7 ?>"> 
                            <?php } else { ?>
                                           <span> <?php echo $remarks7 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>8. . Proof of Compliance/undertaking commitments 
                                <br>made during technical
                                    meeting/s (if applicable))</td>
                            <td style="text-align: center;"><input type="radio" id="req8" name="req8" value="1" <?php $val = $req8=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req8" name="req8" value="0" <?php $val = $req8=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks8" name="remarks8" placeholder="..." value="<?php echo  $remarks8 ?>">
                                           <?php } else { ?>
                                           <span> <?php echo $remarks8 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>9. Certificate of Employment (Full-time/Part-time employee)</td>
                            <td style="text-align: center;"><input type="radio" id="req9" name="req9" value="1" <?php $val = $req9=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req9" name="req9" value="0" <?php $val = $req9=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks9" name="remarks9" placeholder="..." value="<?php echo $remarks9 ?>">
                                       <?php } else { ?>
                                           <span> <?php echo $remarks9 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                        <tr>
                            <td>10. Notarized Affidavit of Joint Undertaking of 
                                <br>the PCO and the Managing
                                Head (format is available at EMB XI)</td>
                            <td style="text-align: center;"><input type="radio" id="req10" name="req10" value="1" <?php $val = $req10=='1'?'checked':''; echo $val ?>><?php echo '' ?></td>
                            <td style="text-align: center;"><input type="radio" id="req10" name="req10" value="0" <?php $val = $req10=='0'?'checked':''; echo $val ?>><?php echo '' ?></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                    <input class="form-control" style="text-align: center;" type="text" id="remarks10" name="remarks10" placeholder="..." value="<?php echo $remarks10 ?>">
                                <?php } else { ?>
                                           <span> <?php echo $remarks10 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>11. CNC/ECC/Business Permit/(DTI/SEC)
                          <br> registration indicating name of
                                    establishment</td>
                            <td style="text-align: center;"><input type="radio" id="req11" name="req11" value="1" <?php $val = $req11=='1'?'checked':''; echo $val ?>><?php echo '' ?></td>
                            <td style="text-align: center;"><input type="radio" id="req11" name="req11" value="0" <?php $val = $req11=='0'?'checked':''; echo $val ?>><?php echo '' ?></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks11" name="remarks11" placeholder="..."value="<?php echo $remarks11 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks11 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>12. Processing Fee of Php 500.00</td>
                            <td style="text-align: center;"><input type="radio" id="req12" name="req12" value="1" <?php $val = $req12=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req12" name="req12" value="0" <?php $val = $req12=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks12" name="remarks12" placeholder="..." value="<?php echo $remarks12 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks12 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                              <?php } else {?>
                              <tr>
                              <td style="width: 350px;">1. Duly filled up Application Form</td>
                            <td style="text-align: center;"><input type="radio" id="req1" name="req1" value="1" <?php $val = $req1=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req1" name="req1" value="0" <?php $val = $req1=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                 <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks1" name="remarks1" placeholder="..." value="<?php echo $remarks1 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks1 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>2. Copy of Latest Certificate of Accreditation</td>
                            <td style="text-align: center;"><input type="radio" id="req2" name="req2" value="1" <?php $val = $req2=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req2" name="req2" value="0" <?php $val = $req2=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks2" name="remarks2" placeholder="..." value="<?php echo $remarks2 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks2 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>3. Updated Curriculum Vitae of the PCO with summary of PCO trainings/seminars attended</td>
                            <td style="text-align: center;"><input type="radio" id="req3" name="req3" value="1" <?php $val = $req3=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req3" name="req3" value="0" <?php $val = $req3=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks3" name="remarks3" placeholder="..." value="<?php echo $remarks3 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks3 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                              <td>4. Copy of Certificates of Participation to advanced PCO trainings and seminars equivalent to 40-hrs within the last 3 years (present the original)
                                </td>
                            <td style="text-align: center;"><input type="radio" id="req4" name="req4" value="1" <?php $val = $req4=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req4" name="req4" value="0" <?php $val = $req4=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks4" name="remarks4" placeholder="..." value="<?php echo $remarks4 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks4 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                              <tr>
                                  <td>5. Copy of Certificates of Participation to at least forty (40) hours 
                                      of cumulative relevant EMB-Accredited PCO trainings and seminars.
                                   </td>
                            <td style="text-align: center;"><input type="radio" id="req5" name="req5" value="1" <?php $val = $req5=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req5" name="req5" value="0" <?php $val = $req5=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks5" name="remarks5" placeholder="..." value="<?php echo $remarks5 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks5 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                              <td>6. 2x2 ID Picture with white background
                                Environmental Management</td>
                            <td style="text-align: center;"><input type="radio" id="req6" name="req6" value="1" <?php $val = $req6=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req6" name="req6" value="0" <?php $val = $req6=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks6" name="remarks6" placeholder="..." value="<?php echo $remarks6 ?>">
                            <?php } else { ?>
                                           <span> <?php echo $remarks6 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>7. Certificate of Employment (Full-time/Part-time employee)</td>
                            <td style="text-align: center;"><input type="radio" id="req7" name="req7" value="1" <?php $val = $req7=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req7" name="req7" value="0" <?php $val = $req7=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks7" name="remarks7" placeholder="..." value="<?php echo  $remarks7 ?>"> 
                            <?php } else { ?>
                                           <span> <?php echo $remarks7 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>8. Processing Fee of Php 500.00 
                               </td>
                            <td style="text-align: center;"><input type="radio" id="req8" name="req8" value="1" <?php $val = $req8=='1'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;"><input type="radio" id="req8" name="req8" value="0" <?php $val = $req8=='0'?'checked':''; echo $val ?>></td>
                            <td style="text-align: center;">
                                <?php if($is_authorized) { ?>
                                <input class="form-control" style="text-align: center;" type="text" id="remarks8" name="remarks8" placeholder="..." value="<?php echo  $remarks8 ?>">
                                           <?php } else { ?>
                                           <span> <?php echo $remarks8 ?> </span>       
                                <?php } ?>
                            </td>
                          </tr>
                              
                              <?php } ?>
                          </tbody>
                        </table>
                              <?php if($is_authorized && !$is_approved) { ?>
                          <div class="form-group">
                                <div class="col-md-12">
                                    <button id="element_overlapT" type="submit" class="btn btn-success btn-lg pull-right" id="btn_save"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                                    <div class="warning">
                                        <p id="ErrorMessage"></p>
                                      </div>
                                </div>
                            </div>
                              <?php }?>
                      </form>
                      </div>
                      <!-- /.col -->
                    </div>
              </section>
            <!-- /.content -->
        </div>
    </div>
        
        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public') ?>/components/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.phone.extensions.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script>
            
            $("#checklistForm").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlapT").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#checklistForm").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('save-checklist-data'); ?>',
                    success: function (data)
                    {
                        $("#element_overlapT").LoadingOverlay("hide", true);
                        if (data.status === 1)
                        {
                            $('#ErrorMessage').html('<span style="color:green;">' + data.message + '</span>');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlapT").LoadingOverlay("hide", true);
                        $('#ErrorMessage').html('<span style="color:red;">Local error callback. Please try again.</span>');
                    }
                });
            });
            
        </script>
</body>
</html>
