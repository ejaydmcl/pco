 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('include/header');?>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('include/topbar');?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('include/sidebar');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">
                    <li class="time-label">
                        <span class="bg-red">
                            01 August. 2019
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i>  August 01, 2019 01:00:00 PM</span>
                            <h3 class="timeline-header"><a href="#">Support - Team</a></h3>
                            <div class="timeline-body">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="width: 50%; vertical-align: text-top">
                                            <div class="box-header">
                                                <span>Revised Guidelines for Pollution Control Officer Accreditation.</span><br>
                                            </div>
                                            <div style="font-weight: normal; padding-right: 50px;" class="box-body">
                                                <span> 
                                                <p style="font-style: italic;" >DENR Administrative Order No. 2014-02 <a href="<?= base_url('uploads')  ?>/attachment/system/DAO-no.-2014-02 - Revised Guidelines for PCO Accreditation.pdf" download><i class="fa fa-file-pdf-o"> Download the document here.</i></a></p>
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">...</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
        </div>
        
    <!-- Small boxes (Stat box) -->
    <!--<div class="row">
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>News</h3>
            </div>
            <div class="icon">
              <i class="fa fa-info-circle"></i>
            </div>
              <a href="<?= base_url('home'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>-->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view('include/footer');?>

 <!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('public')?>/components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>
