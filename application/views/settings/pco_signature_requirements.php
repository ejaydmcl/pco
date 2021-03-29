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
                    Signature Size Requirements
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>Signature Size Requirements</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-primary" style="height: auto;">
                    <div class="box-header with-border">
                      <h3 class="box-title">Guide</h3>
                    </div>
                    <div class="box-body">
                        <section class="content">
                            <div class="col-sm-4">
                                <p> <strong>SIGNATURE EXAMPLE</strong> </p>
                                <img style="width: 300px; height: auto" src="<?= base_url('public') ?>/images/signature_requirements.jpg">
                            </div>
                        </section>
                        <section class="content">
                            <form class="form-horizontal" id="add_description_form">
                                <div class="input-group margin" style="width: 600px;" id="add_description_form_element_overlap1">
                                    <input type="text" id="description_entry" name="description_entry" class="form-control" placeholder="..." autocomplete="off" required="">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">ADD</button>
                                    </span>
                                </div>
                            </form>
                            
                            <ul id="description_list">
                                 <?php foreach ($description_entry_list as $key => $value) { ?>
                                 <li id="<?php echo $value['id']; ?>"> <?php echo $value['value']; ?> <a onclick="remove(<?php echo $value['id']; ?>)" href="javascript:void(0);" class="fa fa-fw fa-remove" data-toggle="tooltip" data-placement="right" title="Remove"></a></li>
                                 <?php } ?>
                             </ul>
                        </section>
                    </div>
                    
                    <div class="box-footer">
                        <span>
                            <a href="<?= base_url('signature-requirements') ?>" target="_blank" class="btn btn-primary btn-flat btn-sm">Preview</a>
                        </span>
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
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
            
            $("#add_description_form").submit('on', function (e) {
                e.preventDefault();
                $("#add_description_form_element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#add_description_form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('add-pco-signature-description-entry'); ?>',
                    success: function (data)
                    {
                        $("#add_description_form_element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                           // alert(data.message);
                            $("#add_description_form").trigger('reset');
                            var li = '<li id='+ data.description_entry_id +'>'+ data.description_entry +' <a onclick="remove('+ data.description_entry_id +')" href="javascript:void(0);" class="fa fa-fw fa-remove" data-toggle="tooltip" data-placement="right" title="Remove"></a> </li>';
                            $('#description_list').append(li);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        alert("Local error callback. Please try again!"+ err);
                        $("#add_description_form_element_overlap1").LoadingOverlay("hide", true);
                    }
                });
            }); 
            
            function remove(id) {
                $("#description_list").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: {id: id},
                    headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('remove-pco-signature-description-entry') ?>',
                    success: function (data)
                    {
                        $("#description_list").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $('#description_list #'+ data.description_entry_id).remove();
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $("#description_list").LoadingOverlay("hide", true);
                        alert('Local error callback. Please try again!');
                    }
                });
            }
        </script>
    </div>
</body>
</html>
