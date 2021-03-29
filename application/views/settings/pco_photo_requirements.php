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
                    PCO Photo Requirements
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-file-text-o"></i>PCO Photo Requirements</a></li>
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
                                <p> <strong>MALE PHOTO</strong> </p>
                                <img style="width: 300px; height: 300px;" src="<?= base_url('public') ?>/images/male_2x2_photo_guide.jpg">
                            </div>
                            
                            <div class="col-sm-8">
                                <p> <strong>FEMALE PHOTO</strong> </p>
                                <img style="width: 300px; height: 300px;" src="<?= base_url('public') ?>/images/Female_2x2_photo_guide.jpg">
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
                            <li id="<?php echo $value['id']; ?>"> <?php echo $value['value']; ?> 
                                <a onclick="remove(<?php echo $value['id']; ?>)" href="javascript:void(0);" class="fa fa-fw fa-remove" data-toggle="tooltip" data-placement="right" title="Remove"></a></li>
                            <?php } ?>
                        </ul>
                        </section>
                    </div>
                    
                     <div class="box-footer">
                        <span>
                            <a href="<?= base_url('picture-requirements') ?>" target="_blank" class="btn btn-primary btn-flat btn-sm">Preview</a>
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
            
             $("#page_header_form").submit('on', function (e) {
                e.preventDefault();
                $("#page_header_element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#page_header_form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('update-pco-req-page-header'); ?>',
                    success: function (data)
                    {
                        $("#page_header_element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            alert(data.message);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        alert("Local error callback. Please try again!"+ err);
                        $("#page_header_element_overlap1").LoadingOverlay("hide", true);
                    }
                });
            }); 
            
            $("#male_photo_header_form").submit('on', function (e) {
                e.preventDefault();
                $("#male_page_header_element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#male_photo_header_form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('update-male-photo-header'); ?>',
                    success: function (data)
                    {
                        $("#male_page_header_element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            alert(data.message);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        alert("Local error callback. Please try again!"+ err);
                        $("#male_page_header_element_overlap1").LoadingOverlay("hide", true);
                    }
                });
            }); 
            
            $("#female_photo_header_form").submit('on', function (e) {
                e.preventDefault();
                $("#female_page_header_element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#female_photo_header_form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('update-female-photo-header'); ?>',
                    success: function (data)
                    {
                        $("#female_page_header_element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            alert(data.message);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        alert("Local error callback. Please try again!"+ err);
                        $("#female_page_header_element_overlap1").LoadingOverlay("hide", true);
                    }
                });
            }); 
            
            $("#add_description_form").submit('on', function (e) {
                e.preventDefault();
                $("#add_description_form_element_overlap1").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#add_description_form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('add-description-entry'); ?>',
                    success: function (data)
                    {
                        $("#add_description_form_element_overlap1").LoadingOverlay("hide", true);
                        if (data.status === 0)
                        {
                            alert(data.message);
                        }
                        if (data.status === 1)
                        {
                            $("#add_description_form").trigger('reset');
                            var li = '<li id='+ data.description_entry_id +'>'+ data.description_entry +' \n\
                                <a onclick="remove('+ data.description_entry_id +')" href="javascript:void(0);" \n\
                                class="fa fa-fw fa-remove" data-toggle="tooltip" data-placement="right" title="Remove">\n\
                                </a> </li>';
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
                    url: '<?= base_url('remove-description-entry') ?>',
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
</body>
</html>
