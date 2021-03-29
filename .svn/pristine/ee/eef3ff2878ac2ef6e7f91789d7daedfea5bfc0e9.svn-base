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
                    Termination of COA
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>Termination of Certificate of Accreditation</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-primary" style="height: auto; min-height: 700px;">
                    <div class="box-header with-border">
                      <h3 class="box-title">Certificate of Accreditation details</h3>
                    </div>
                    <div class="box-body">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?= base_url('uploads') ?>/profiles/<?php
                                        $photo = $user_profile_picture == FALSE ? 'no-image.png' : $user_profile_picture;
                                        echo $photo;
                                        ?>" alt="user image">
                                <span class="username">
                                  <a href="#"><?php echo $this->UserModel->getAccountUserFullName($account_id); ?></a>
                                </span>
                            <span class="description"><?php echo gmdate('F j, Y H:i:s A', strtotime($date_created) + date('Z')) ?></span>
                        </div>
                        <section class="content">
                            <form id="coa_temination_form">
                                <input type="hidden" class="form-control" name="account_id" id="account_id" value="<?php echo isset($account_id) == TRUE ? $account_id : NULL ?>">
                                <input type="hidden" class="form-control" name="application_id" id="application_id" value="<?php echo isset($application_id) == TRUE ? $application_id : NULL ?>">
                                <input type="hidden" class="form-control" name="coa_id" id="coa_id" value="<?php echo isset($coa_id) == TRUE ? $coa_id : NULL ?>">
                            <table>
                                <tbody><tr>
                                    <td> 
                                        <dl class="dl-horizontal">
                                            <dt>COA No. :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $coa_no; ?></span></dd>
                                            <dt>Application ID# :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $application_id; ?></span></dd>
                                            <dt>Establishment :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $establishment; ?></span></dd>
                                            <dt>Nature of Business :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $nature_of_business; ?></span></dd>
                                            <dt>Address :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $address; ?></span></dd>
                                            <dt>Telephone No. :</dt>
                                            <dd><span style="text-decoration: underline"> <?php echo $telephone_no; ?></span></dd>
                                            <dt>Website:</dt>
                                            <dd><span style="text-decoration: underline"> <a href="<?php echo 'http://'.$website; ?>" target="_blank"> <?php echo $website; ?></a></span></dd>
                                        </dl>
                                    </td>
                                    <td>
                                        <dl class="dl-horizontal">
                                            <dt>Application type :</dt>
                                            <dd><span id="type-label" style="text-decoration: underline"><?php echo $this->ApplicationPageModel->getApplicationTypeLabel($type_id)['label'] ?></span></dd>
                                            <dt>Status :</dt>
                                            <dd><span id="status-label" style="text-decoration: underline"><?php echo $this->ApplicationPageModel->getApplicationStatusLabel($status_id)['label'] ?></span></dd>
                                            <dt>Evaluated :</dt>
                                            <dd><span id="evaluator-label" style="text-decoration: underline"><?php echo $this->UserModel->getForwardedToNameByID($evaluator);?> </span></dd>
                                            <dt>Approved by :</dt>
                                            <dd><span style="text-decoration: underline"><?php echo $this->UserModel->getUserFullName($approved_by_id);?></span></dd>
                                            <dt>Date approved :</dt>
                                            <dd><span style="text-decoration: underline"><?php echo gmdate('F j, Y H:i:s A', strtotime($date_approved) + date('Z')) ?></span></dd>
                                            <dt>Date expires :</dt>
                                            <dd><span style="text-decoration: underline"><?php echo gmdate('F j, Y H:i:s A', strtotime($date_expires) + date('Z')) ?></span></dd>
                                            <dt>:</dt>
                                            <dd><span>-</span></dd>
                                        </dl>
                                    </td>
                                </tr>
                            </tbody></table>
                            <table>
                                <tbody>
                                <tr>
                                    <td> 
                                        <dl class="dl-horizontal">
                                            <dd><label class="control-label text-green">Scanned Copy of the Document - (PDF format only)</label></dd>
                                            <dt style="margin-top: 5px;">Attachment :</dt>
                                            <dd style="margin-top: 5px; width: auto;">
                                                <div>
                                                    <div type="button" class="btn btn-primary btn-xs" onclick="$('#termination_attachment').trigger('click')"><i class="glyphicon glyphicon-plus"></i> Add File</div>
                                                    <input type="file" name="" style="opacity: 0; float: right;" id="termination_attachment" required onchange="onClickAttachment()"/>
                                                </div>
                                                <div class="col-sm-10" style="float: right; margin-top: -20px;">
                                                    <?php  
                                                   if(isset($termination_attachment)) { ?>
                                                       <div id="attachment_name">File:  <span class="label label-info" style="margin-right: 10px;" ><?php echo $this->ApplicationDetailsPageModel->getAttachmentFileName(null) ?> </span> <a href="<?= base_url('uploads'). "/attachment/". $this->ApplicationDetailsPageModel->getAttachmentFileName(null) ?>" target="_blank" class="label label-danger" >view</a></div>
                                                   <?php } ?>
                                                   <div id="attachment_name"></div>
                                                   <div id="attachment_file_size"></div>
                                                   <div id="attachment_file_type"></div>
                                                   <a id="termination_attachment" href="#" target="_blank" style="color:#ffffff; display:none;" class="btn btn-primary btn-sm"> <span class="fa fa-file-pdf-o" style="color:#ffffff;"></span> view</a>
                                               </div>
                                            </dd>
                                            <dt style="margin-top: 20px;">Remarks :</dt>
                                            <dd style="margin-top: 20px;"><textarea id="remarks" class="form-control" rows="4" required></textarea></dd>
                                            <dt style="margin-top: 30px;">
                                                <button id="element_overlap_coa_temination_button" type="submit" class="btn btn-danger btn-sm">Revoke</button>
                                            </dt>
                                            <dd style="margin-top: 30px;"> 
                                                <p id="coa_temination_form_error_message"></p>
                                            </dd>
                                        </dl>
                                    </td>
                                </tr>
                            </tbody></table>
                        </form>
                        </section>
                        
                    </div>
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
            function onClickAttachment() {
                var file = $('#termination_attachment').prop('files')[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024) {
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    } else {
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                    }
                    $('#attachment_name').html('Name: ' + '<span class="label label-info">' + file.name + '</pan>');
                    $('#attachment_file_size').html('Size: ' + fileSize);
                    $('#attachment_file_type').html('Type: ' + file.type);
                }
            }
            
            $("#coa_temination_form").submit('on', function (e) {
            e.preventDefault();
            $('#coa_temination_form_error_message').html('<span style="color:#060;">Please wait...</span>');
            $("#element_overlap_coa_temination_button").LoadingOverlay("show");
            var file_data = $('#termination_attachment').prop('files')[0];
            var form_data = new FormData();
            form_data.append('termination_attachment', file_data); 
            form_data.append('account_id', $('#account_id').val());
            form_data.append('application_id', $('#application_id').val());
            form_data.append('coa_id', $('#coa_id').val());
            form_data.append('remarks', $('#remarks').val());
            $.ajax({
                dataType: "json",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url('coa-temination-form-data'); ?>',
                success: function (data)
                {
                    $("#element_overlap_coa_temination_button").LoadingOverlay("hide", true);
                    if (data.status === 0)
                    {
                        $('#coa_temination_form_error_message').html('<span style="color:red;">' + data.message + '</span>');
                    }
                    if (data.status === 1)
                    {
                        $('#coa_temination_form_error_message').html('<span style="color:green;font-size:15px;">' + data.message + '</span>');
                        $('#element_overlap_coa_temination_button').attr("disabled", true);
                    }
                },
                error: function (jqXHR, status, err) {
                    $('#coa_temination_form_error_message').html('<span style="color:red;">Local error callback. Please try again!</span>');
                }
            });
        }); 
        </script>
</body>
</html>
