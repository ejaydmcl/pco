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
                   Order of payment
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text"></i>Order of payment</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="invoice" id="element_overlap1">
                
                    <!-- title row -->
                    <div class="row">
                      <div class="col-xs-12">
                        <h2 class="page-header">
                            <img height="30" width="30" src="<?= base_url('public') ?>/images/logo.png" class="img-circle img-bordered-sm"> EMBR-XI, PCO.
                        </h2>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                      <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong><?php echo $organization['name']; ?></strong><br>
                          <?php echo $organization['address']; ?> <br>
                          Phone: <?php echo $organization['phone']; ?><br>
                          Email: <?php echo $organization['email']; ?>
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong><?php echo $user['first_name']. " " .$user['middle_name']. " ". $user['last_name']; ?></strong><br>
                          <?php echo $user['address']; ?><br>
                          Phone: <?php echo $user['telephone_no']; ?><br>
                          Email: <?php echo $user['email_address']; ?>
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        <b>Account:</b> <?php echo $user['pco_id']; ?>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Qty</th>
                            <th>ID#</th>
                            <th>Application</th>
                            <th>Type</th>
                            <th>Serial #</th>
                            <th>Description</th>
                            <th>Total</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>1</td>
                            <td><?php echo $application_id; ?></td>
                            <td><?php echo $application_name; ?></td>
                            <td><?php echo $application_type; ?></td>
                            <td><?php echo $serial_no; ?></td>
                            <td>Certificate of Accreditation</td>
                            <td><?php echo $price; ?></td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
						<div class="col-xs-12">
							<label>Please print (3)copies of order of payment.</label>
						</div>
                      <div class="col-xs-12">
                        <form id="invoice-form">
                            <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                            <input type="hidden" name="application_id" value="<?php echo $application_id; ?>">
                            <input type="hidden" name="serial_no" value="<?php echo $serial_no; ?>">
                            <button id="add-new-comment" type="submit" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">&nbsp;</label>
                                <p  id="ErrorMessageOOP"></p>
                            </div>
                        </form>
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
            
            $("#invoice-form").submit('on', function (e) {
                e.preventDefault();
                $("#element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#invoice-form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('order-of-payment'); ?>',
                    success: function (data)
                    {
                        $("#element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            $("#element_overlap1").LoadingOverlay("hide", true);
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $("#element_overlap1").LoadingOverlay("hide", true);
                            window.open(data.redirectUrl,'_blank');
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $('#ErrorMessageOOP').html('<span style="color:red;">Local error callback. Please try again!</span>');
                    }
                });
            });
            
        </script>
</body>
</html>
