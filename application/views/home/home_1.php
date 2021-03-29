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
                            <h3 class="timeline-header"><a href="#">ICT - Team</a></h3>
                            <div class="timeline-body">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="width: 50%; vertical-align: text-top">
                                            <div class="box-header">
                                                <span>WHAT IS POLLUTION CONTROL OFFICER?</span><br>
                                            </div>
                                            <div style="font-weight: normal; padding-right: 50px;" class="box-body">
                                                <p>A Pollution Control Officer (PCO), is a type of career that engage in environmental protections and environmental compliance,
                                                    which the main goal is to provide and establish companies Objective, Targets and Programs, 
                                                    that will help the company and the organization on the preservation of our natural resources, 
                                                    reduce the generations of the company waste and establish proper mitigation on pollutions controls 
                                                    in the environment aspect and impact on air, land, water, flora and fauna and human living.
                                                    And also as a part of the duties and responsibilities of the PCO, he or she must also assess and establish 
                                                    the applicable legal requirements of the company's environmental compliance that was set by the Law in 
                                                    his/ her country and must be also aware in the international standards such as, RoHS, ISO 14001:2004 and etc., 
                                                    that will help to improve the Environmental Management Programs and Environmental Management System.</p>
                                                
                                                <img src="<?= base_url('public') ?>/images/CareEnvironmentLogo-Large.jpg">
                                            
                                                <p style="font-style: italic; font-weight: bold">Note:</p>
                                                <p>To be a Pollution Control Officer, you must attend trainings in a accredited PCO training facilitators 
                                                    such as the PCAPI (Pollution Control Association of the Philippines) for the Basic Pollution 
                                                    Control Officer Course and take a examinations, for the PCO Accreditation Certification for your company, 
                                                    by the Department of Environmental and Natural Resources (DENR).</p>
                                                <p style="font-style: italic;" >Source: <a href="http://marcobusakulo.blogspot.com/2011/05/what-is-pollution-control-officer.html" target="_blank"><i class="fa fa-home"></i> PCO</a></p>
                                            </div>
                                        </th>
                                        <th style="width: 50%; vertical-align: text-top">
                                            <div class="box-header">
                                                <span>PROCESS FLOW FOR APPLYING CERTIFICATE OF ACCREDETATION</span><br>
                                            </div>
                                            <img src="<?= base_url('public') ?>/images/pco-process-flow.jpg" style="width: 600px; height: 500px">
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
