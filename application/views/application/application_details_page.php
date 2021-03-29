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
                    Application Details
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text"></i>Application Details</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="user-block">
                                    <div class="nav-tabs-custom" id="element_overlap1">
                                        <img class="img-circle img-bordered-sm" src="<?= base_url('uploads') ?>/profiles/<?php
                                        $photo = $picture_file_name == FALSE ? 'no-image.png' : $picture_file_name;
                                        echo $photo;
                                        ?>" alt="">
                                        <span class="username">
                                            <a onclick="onClickPCOName(<?php echo $account_id; ?>)" href="javascript:void(0);" ><?php echo $user_full_name; ?> </a>
                                        </span>
                                        <span class="description">Date submitted - <?php echo gmdate('F j, Y', strtotime($date_submitted) + date('Z')); ?></span>
                                            <div class="row ">
                                                <div class="box-body">
                                                    <table>
                                                        <tr>
                                                            <td> 
                                                                <dl class="dl-horizontal">
                                                                    <dt>Application ID#:</dt>
                                                                    <dd ><?php echo $application_id ?></dd>
                                                                    <dt>Establishment:</dt>
                                                                    <dd><?php echo $establishment ?></dd>
                                                                    <dt>Address:</dt>
                                                                    <dd><?php echo $address ?></dd>
                                                                    <dt>Nature of Business:</dt>
                                                                    <dd><?php echo $nature ?></dd>
                                                                    <dt>Telephone No.:</dt>
                                                                    <dd><?php echo $telephone_no ?></dd>
                                                                    <dt>Website:</dt>
                                                                    <dd><a href="<?php echo $website ?>" target="_blank"> <?php echo $website ?></a></dd>
                                                                    <dt></dt>
                                                                    <?php if($type_fk == _NEW) { ?>
                                                                    <dt style="margin-top: 10px;"><a style="width: 100px;" onclick="onClickViewFullDetails(<?php echo $application_id; ?>)" href="javascript:void(0);" class="btn btn-primary btn-xs">View full details</a></dt>
                                                                    <?php } else { ?>
                                                                        <dt style="margin-top: 10px;"><a style="width: 100px;" onclick="onClickViewFullRenewedDetails(<?php echo $application_id; ?>)" href="javascript:void(0);" class="btn btn-primary btn-xs">View full details</a></dt>
                                                                    <?php } ?>
                                                                    
                                                                    <?php if($is_edit) { ?>
                                                                        <dt style="margin-top: 3px;"><a style="width: 100px;" onclick="onClickViewPCOProfile(<?php echo $account_id; ?>)" href="javascript:void(0);" class="btn btn-primary btn-xs">View PCO Profile</a></dt>
                                                                        
                                                                        <dt style="margin-top: 3px;"><a style="width: 100px;" data-toggle="collapse" data-target="#collapse-box" class="btn btn-primary btn-xs">Route</a></dt>
                                                                    <?php } ?>
                                                                    <?php if($is_order_of_payment && $status_fk == EVALUATED) { ?>
                                                                        <dt style="margin-top: 3px;"><a onclick="onClickOrderOfPayment(<?php echo $application_id; ?>,<?php echo $account_id; ?>)" href="javascript:void(0);"  class="btn btn-primary btn-xs">Order of payment</a></dt>
                                                                    <?php } ?>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal">
                                                                    <dt>Application type:</dt>
                                                                    <dd><span id="type-label"><?php echo $this->ApplicationPageModel->getApplicationTypeLabel($type_fk)['label'] ?></span></dd>
                                                                    <dt>Status:</dt>
                                                                    <dd><span id="status-label" ><?php echo $this->ApplicationPageModel->getApplicationStatusLabel($status_fk)['label'] ?></span></dd>
                                                                    <dt>Forwarded to:</dt>
                                                                    <dd><span id="assignee-label"><?php echo $this->UserModel->getForwardedToNameByID($assignee); ?></span></dd>
                                                                    <dt>:</dt>
                                                                    <dd><span>-</span></dd>
                                                                    <dt>:</dt>
                                                                    <dd><span>-</span></dd>
                                                                    <dt>:</dt>
                                                                    <dd><span>-</span></dd>
                                                                    <dt></dt>
                                                                    <?php if($is_pco && $account_id == $assignee) { ?>
																	<?php if(count(array_intersect(array($status_fk), array(EVALUATED,ONGOING)))){ ?>
                                                                    <dd><span id="submit-button"><a style="width: 160px;" onclick="onClickSubmit(<?php echo $application_id; ?>)" href="javascript:void(0);"  class="btn btn-primary btn-sm"><i class="fa fa-send"></i> Submit to evaluator</a></span></dd>
																	<?php } ?>	
																	<?php } ?>    
                                                                </dl>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <ul class="list-inline">
                                                <?php if($is_edit) { ?>
                                                <!-- <li><a href="#" class="link-black text-sm" data-toggle="collapse" data-target="#collapse-box"><i class="fa fa-edit margin-r-5"></i> Edit</a></li>-->
                                                <?php } ?>
                                                <li><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (<?php echo $comments_count; ?>)</a></li>
                                                <!--Collapse-->
                                                    <div id="collapse-box" class="collapse">
                                                        <div class="box-body" style="background: #f9fafc;"><hr>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <form id="editSAForm" class="form-horizontal">
                                                                        <div class="form-group">     
                                                                            <input type="hidden" id="application_type_fk" name="application_type_fk" value="<?php echo $type_fk; ?>" >
                                                                            <input type="hidden" id="application_id" name="application_id" value="<?php echo $application_id; ?>" >
                                                                            <input name="application_origin" type="hidden" class="form-control input-sm" value="<?php echo $origin ?>" >
                                                                            <input name="application_type_id" type="hidden" class="form-control input-sm" value="<?php echo $type_fk ?>" >
                                                                            <input name="application_status_id" type="hidden" class="form-control input-sm" value="<?php echo $status_fk ?>" >
                                                                            <input name="application_assignee_id" type="hidden" class="form-control input-sm" value="<?php echo $assignee ?>" >
                                                                            <label for="" class="col-sm-5 control-label">Status:</label>
                                                                            <div class="col-md-2">
                                                                                <select class="form-control" id="application_status" name="application_status" style="width: 350px;">
                                                                                    <option value="<?php echo $this->ApplicationPageModel->getApplicationStatusLabel($status_fk)['id'] ?>"> <?php echo $this->ApplicationPageModel->getApplicationStatusLabel($status_fk)['label'] ?></option>
                                                                                        <?php foreach ($application_status as $key => $value) { ?>
                                                                                        <?php if($value['id'] != $status_fk) { ?> 
                                                                                            <option value="<?php echo $value['id'] ?>" > <?php echo $value['label'] ?></option>
                                                                                        <?php } ?>
                                                                                    <?php }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">                                               
                                                                            <label for="" class="col-sm-5 control-label">Forward to:</label>
                                                                            <div class="col-md-2">
                                                                                <select class="form-control" id="application_assignee" name="application_assignee" style="width: 350px;">
                                                                                    <option value="<?php $id = $assignee==null?0:$assignee; echo $id ?>"> <?php $name = $assignee==null?'-':$this->UserModel->getForwardedToNameByID($assignee); echo $name; ?> </option>
                                                                                    <?php foreach ($list_of_employee as $key => $value) { ?>
                                                                                        <?php  if(isset($value['account_fk'])) { ?>
                                                                                            <?php if($value['account_fk'] != $assignee) { ?>
                                                                                                <option value="<?php echo $value['account_fk'] ?>" > <?php echo $this->UserModel->getAccountUserFullName($value['account_fk']).' - '. $value['label']  ?></option>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                        <?php if(isset($value['employee_fk'])) { ?>
                                                                                            <?php if($value['employee_fk'] != $assignee) { ?>
                                                                                                <option value="<?php echo $value['employee_fk'] ?>" > <?php echo $this->UserModel->getEmployeeUserFullName($value['employee_fk']).' - '. $value['label']  ?></option>
                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    <?php }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="col-sm-4 control-label"></label>
                                                                            <div class="col-md-4">
                                                                                <?php if($status_fk != APPROVED) { ?>
                                                                                    <button type="submit" class="btn btn-primary btn-sm">Forward</button>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--Collapse-->
                                                        </div>
                                                    </div>
                                            </ul>
                                        <?php if($is_comment_enable == true && $is_pco == true) { ?>
                                            <form class="form-horizontal" id="commentF">
                                                <div class="input-group">
                                                    <input name="account_id" type="hidden" class="form-control input-sm" value="<?php echo $account_id ?>" >
                                                    <input name="application_id" type="hidden" class="form-control input-sm" value="<?php echo $application_id ?>" >
                                                    <input name="application_status_id" type="hidden" class="form-control input-sm" value="<?php echo $status_fk ?>" >
                                                    <input name="application_assignee_id" type="hidden" class="form-control input-sm" value="<?php echo $assignee ?>" >
                                                    <input <?php if($status_fk == APPROVED) { echo 'selected disabled'; } ?>  id="new-comment" type="text" class="form-control input-sm" name="comment" placeholder="Type a comment">
                                                    <div class="input-group-btn">
                                                        <button id="add-new-comment" type="submit" class="btn btn-primary btn-sm">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                        <?php if(!$is_pco) { ?>
                                            <form class="form-horizontal" id="commentF">
                                                <div class="input-group">
                                                    <input name="account_id" type="hidden" class="form-control input-sm" value="<?php echo $account_id ?>" >
                                                    <input name="application_id" type="hidden" class="form-control input-sm" value="<?php echo $application_id ?>" >
                                                    <input name="application_status_id" type="hidden" class="form-control input-sm" value="<?php echo $status_fk ?>" >
                                                    <input name="application_assignee_id" type="hidden" class="form-control input-sm" value="<?php echo $assignee ?>" >
                                                    <input <?php if($status_fk == APPROVED) { echo 'selected disabled'; } ?>  id="new-comment" type="text" class="form-control input-sm" name="comment" placeholder="Type a comment">
                                                    <div class="input-group-btn">
                                                        <button id="add-new-comment" type="submit" class="btn btn-primary btn-sm">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <ul class="timeline">
                            <!-- timeline item -->
                            <?php foreach ($comments as $key => $value) { ?>
                                <li>
                                    <?php if($is_pco)  {?>
                                        <?php if( $this->ApplicationDetailsPageModel->isEvaluatorComment($value['user_fk']) == EVALUATOR) { ?>
                                            <i class = "fa fa-envelope bg-blue"></i>
                                            <div class = "timeline-item">
                                                <span class = "time"><i class = "fa fa-clock-o"></i> <?php echo gmdate('F j, Y H:i:s A', strtotime($value['date_created']) + date('Z')) ?></span>
                                                <h3 class="timeline-header"><a class="text-green" href = "#"><?php echo $this->UserModel->getCommentUserFullName($value['user_fk']); ?></a></h3>
                                                <div class="timeline-body"><?php echo $value['comment'] ?></div>
                                                <div class="timeline-footer">
                                                    <a onclick="onClickEditComment()" href="javascript:void(0);" class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>
                                        <?php } else if( $this->ApplicationDetailsPageModel->isPCOComment($value['user_fk']) == PCO) { ?>
                                                <i class = "fa fa-envelope bg-blue"></i>
                                                <div class = "timeline-item">
                                                    <span class = "time"><i class = "fa fa-clock-o"></i> <?php echo gmdate('F j, Y H:i:s A', strtotime($value['date_created']) + date('Z')) ?></span>
                                                    <h3 class = "timeline-header"><a href = "#"><?php echo $this->UserModel->getCommentUserFullName($value['user_fk']); ?></a></h3>
                                                    <div class = "timeline-body"><?php echo $value['comment'] ?></div>
                                                    <div class="timeline-footer">
                                                        <a onclick="onClickEditComment()" href="javascript:void(0);" class="btn btn-primary btn-xs">...</a>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                           <i class = "fa fa-envelope bg-blue"></i>
                                            <div class = "timeline-item">
                                                <span class = "time"><i class = "fa fa-clock-o"></i> <?php echo gmdate('F j, Y H:i:s A', strtotime($value['date_created']) + date('Z')) ?></span>
                                                <h3 class = "timeline-header"><a href = "#"><?php echo $this->UserModel->getCommentUserFullName($value['user_fk']); ?></a></h3>
                                                <div class = "timeline-body"><?php echo $value['comment'] ?></div>
                                                <div class="timeline-footer">
                                                    <a onclick="onClickEditComment()" href="javascript:void(0);" class="btn btn-primary btn-xs">...</a>
                                                </div>
                                            </div>     
                                    <?php } ?>
                                </li>
                            <?php }
                            ?>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
            </section>
            <!-- /.content -->
        </div>

        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script>
            $("#editSAForm").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#editSAForm").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('edit-status-assignee'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $('#assignee-label').text(data.assignee_label);
                            $('#status-label').text(data.status_label);
                            alert(data.message);
                            var ul = '<li>' +
                                    '<i class = "fa fa-envelope bg-blue"></i>' +
                                    '<div class = "timeline-item">' +
                                    '<span class = "time"><i class = "fa fa-clock-o"></i>' + data.date_created + '</span>' +
                                    '<h3 class = "timeline-header"><a href = "#"> ' + data.name + ' </a></h3>' +
                                    '<div class = "timeline-body">' + data.comment + '</div>' +
                                    '<div class="timeline-footer">' +
                                    '<a class="btn btn-primary btn-xs">Edit</a>' +
                                    '</div>' +
                                    '</div>' +
                                    ' </li>';
                            $('.timeline').append(ul);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageU').html('<span style="color:red;">Local error callback. Please try again!</span>');
                    }
                });
            });
            
            $("#commentF").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    //data: {new_comment: $("new-comment").val()},
                    data: $("#commentF").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('send-new-comment'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $("#commentF").trigger('reset');
                            location.reload();
                            
                            alert(data.message);
                           /* var li = '<li>' +
                                    '<i class = "fa fa-envelope bg-blue"></i>' +
                                    '<div class = "timeline-item">' +
                                    '<span class = "time"><i class = "fa fa-clock-o"></i>' + data.date_created + '</span>' +
                                    '<h3 class = "timeline-header"><a href = "#"> ' + data.name + ' </a></h3>' +
                                    '<div class = "timeline-body">' + data.comment + '</div>' +
                                    '<div class="timeline-footer">' +
                                    '<a class="btn btn-primary btn-xs">Edit</a>' +
                                    '</div>' +
                                    '</div>' +
                                    ' </li>';
                            $('.timeline').append(li);*/
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageU').html('<span style="color:red;">Local error callback. Please try again!</span>');
                    }
                });
            });
            
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
                        alert('Local error callback. Please try again!');
                    }
                });
            }
            
            function onClickViewFullDetails(applicationID) {
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {application_id: applicationID,url:'selected-pco-application'},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('view-selected-application-details') ?>',
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
                        alert('Local error callback. Please try again!');
                    }
                });
            } 
            
            function onClickViewFullRenewedDetails(applicationID){
            $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('select-the-renewed-application') ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            alert(data.message);
                            window.open(data.redirectUrl,'_blank');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        alert('Local error callback. Please try again!');
                    }
                });
            }
            
            function onClickViewPCOProfile(accountID) {
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
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        alert('Local error callback. Please try again!');
                    }
                });
            } 
            
            function onClickOrderOfPayment(applicationID,accountID) {
            $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {application_id: applicationID,account_id: accountID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('redirect-to-order-of-payment') ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            alert(data.message);
                            window.open(data.redirectUrl,'_blank');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        alert('Local error callback. Please try again!');
                    }
                });
            } 
            
            function onClickSubmit(applicationID) {
            $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {application_id: applicationID},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('submit-back-to-evaluator') ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $('#assignee-label').text(data.assignee_label);
                            $('#submit-button').hide();
                            $('#commentF').hide();
                            alert(data.message);
                        }
                        if (data.status === 2)
                        {
                            alert(data.message);
                            
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        alert('Local error callback. Please try again! '+ err);
                    }
                });
            } 
            
            function onClickEditComment() {
                alert("Not yet implemented.");
            }
            
        </script>
</body>
</html>
