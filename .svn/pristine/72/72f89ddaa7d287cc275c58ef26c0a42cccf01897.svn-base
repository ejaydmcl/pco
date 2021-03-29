<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('include/header'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('include/topbar'); ?>
        <?php $this->load->view('include/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Organization<small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-list"></i>Organization</a></li>
                    <li><a href="#"></a>Setup</li>
                </ol>
            </section>
            <section class="content">
                <div id="response"></div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#office" data-toggle="tab">Office</a></li>
                        <li><a href="#contact-details" data-toggle="tab">Contact details</a></li>
                        <li><a href="#iso-standard" data-toggle="tab">ISO Standard</a></li>
                        <li><a href="#certificate-of-accreditation" data-toggle="tab">Certificate of accreditation</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="office">
                            <form id="office-tab-form">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div hidden class="form-group">
                                                <label for="office_id">Office ID No.</label>
                                                <input type="text" value="<?php echo $organization['id']; ?>" class="form-control" id="office_id" name="office_id" placeholder="Office ID" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="regional_director">Regional Director</label>
                                                <input type="text" value="<?php echo $organization['regional_director']; ?>" class="form-control" id="regional_director" name="regional_director" placeholder="Regional Director" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="office_name">Office name</label>
                                                <input type="text" value="<?php echo $organization['name']; ?>" class="form-control" id="office_name" name="office_name" placeholder="Office name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" placeholder="Address"><?php echo $organization['address']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width:100%" id="region" name="region" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($region as $value) { ?>
                                                        <?php if($value->reg_code == $organization['reg_code']) { ?> 
                                                            <option selected value="<?php echo $value->reg_code;  ?>"><?php echo $value->reg_desc;  ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $value->reg_code;  ?>"><?php echo $value->reg_desc;  ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="province">Province</label>
                                                <select  class="form-control select2 select2-hidden-accessible" style="width:100%" id="province" name="province" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($province as $value) { ?>
                                                        <?php if($value->prov_code == $organization['prov_code']) { ?> 
                                                            <option selected value="<?php echo $value->prov_code;  ?>"><?php echo $value->prov_desc;  ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $value->prov_code;  ?>"><?php echo $value->prov_desc;  ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City/Municipality</label>
                                                <select  class="form-control select2 select2-hidden-accessible" style="width:100%" id="city" name="city" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($city as $value) { ?>
                                                        <?php if($value->city_mun_code == $organization['city_mun_code']) { ?> 
                                                            <option selected value="<?php echo $value->city_mun_code;  ?>"><?php echo $value->city_mun_desc;  ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $value->city_mun_code;  ?>"><?php echo $value->city_mun_desc;  ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary element_overlap">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="iso-standard">
                            <form id="iso-standard-tab-form">
                                <div class="box-body">
                                    <div class="col-md-4">
                                        <div class="form-group" style="display: none">
                                            <label for="iso_id">ISO id</label>
                                            <input type="text" class="form-control input-sm" value="<?php echo $iso['id']; ?>" id="iso_id" name="iso_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="iso_document_code">ISO Document code <i class="text-info small">(<b>leave it blank</b> if not applicable)</i></label>
                                            <input type="text" class="form-control input-sm" id="iso_document_code" name="iso_document_code" value="<?php echo $iso['document_code']; ?>" placeholder="Code">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary element_overlap">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="certificate-of-accreditation">
                            <form id="coa-tab-form" class="element_overlap">
                                <div class="box-body">
                                    <div hidden class="form-group">
                                        <label for="coa_office_id">Office ID No.</label>
                                        <input type="text" value="<?php echo $organization['id']; ?>" class="form-control" id="coa_office_id" name="coa_office_id" placeholder="Office ID" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <img alt="No image found" id="coa_header_img" src="<?php echo base_url('uploads'). "/attachment/".$coa_header_filename; ?>" class="img-thumbnail" height="270">
                                    </div>
                                    <div class="form-group">
                                        <label for="coa_header">Upload Certificate of accreditation header</label>
                                        <input type="file" id="coa_header" name="coa_header" required>
                                    </div>
                                    <div class="col-xs-3">
                                        <p class="lead">File upload requirements</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody><tr>
                                                        <th style="width:50%">Dimensions:</th>
                                                        <td>1497x270</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Width:</th>
                                                        <td>1497 pixels</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Height:</th>
                                                        <td>270 pixels</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Resolution:</th>
                                                        <td>96 dpi</td>
                                                    </tr>
                                                    <tr>
                                                        <th>File type:</th>
                                                        <td>png/jpeg</td>
                                                    </tr>
                                                    <tr>
                                                        <th>File size:</th>
                                                        <td>Maximum of 500KB</td>
                                                    </tr>
                                                </tbody></table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="contact-details">
                            <form id="contact-details-form">
                                <div class="box-body">
                                    <div class="col-md-4">
                                        <div class="form-group" style="display: none">
                                            <label for="cd_region">Region</label>
                                            <input type="text" class="form-control input-sm" value="<?php echo $organization['reg_code']; ?>" id="cd_region" name="cd_region">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" value="<?php echo $organization['email']; ?>" class="form-control" id="email" name="email" placeholder="Office email">
                                        </div>
                                        <div class="form-group">
                                            <label for="telephone">Telephone no.</label>
                                            <input type="text" value="<?php echo $organization['phone']; ?>" class="form-control" id="telephone" name="telephone" placeholder="Office telephone no.">
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Notes <i class="text-info small">(Maximum length of 100 characters)</label>
                                            <textarea maxlength="100" class="form-control" id="notes" name="notes" placeholder="..."><?php echo $organization['notes']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary element_overlap">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </section>
        </div>
        <?php $this->load->view('include/footer'); ?>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay.min.js"></script>
        <script src="<?= base_url('public'); ?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public'); ?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>
            $(function () {
                $('.select2').select2();
            });
            function coaHeaderURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#coa_header_img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#coa_header").change(function () {
                coaHeaderURL(this);
            });
            
            $("#office-tab-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#office-tab-form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('submit-office-form'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#response').html(data.message);
                            $('#warning').fadeOut(9000);
                        }
                        if (data.status == 1)
                        {
                            $('#response').html(data.message);
                            $('#success').fadeOut(9000);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        var m = '<div id="err" class="alert alert-danger alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                                  '<span style="color:white;">Code: ' + jqXHR.status + '  Status: '+ status + ' description: '+ err + '</span>' +
                                '</div>';
                        $('#response').html(m);
                        $('#err').fadeOut(9000);
                    }
                });
            });
            
            $("#contact-details-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                $.ajax({
                    dataType: "json",
                    type: "post",
                    data: $("#contact-details-form").serialize(),
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('submit-contact-details-form'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#response').html(data.message);
                            $('#warning').fadeOut(9000);
                        }
                        if (data.status == 1)
                        {
                            $('#response').html(data.message);
                            $('#success').fadeOut(9000);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        var m = '<div id="err" class="alert alert-danger alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                                  '<span style="color:white;">Code: ' + jqXHR.status + '  Status: '+ status + ' description: '+ err + '</span>' +
                                '</div>';
                        $('#response').html(m);
                        $('#err').fadeOut(9000);
                    }
                });
            });
            
            $('select[name="region"]').on('change', function () {
                var data = $(this).val();
                if (data) {
                    $.getJSON('province-list', {data: data},
                            function (data) {
                                var items = "<option value=''>-Select-</option>";
                                $.each(data, function (i, ui) {
                                    items += "<option value='" + ui.prov_code + "'>" + ui.prov_desc + "</option>";
                                });
                                $('#province').html(items);
                            }).fail(function (jqxhr, textStatus, error) {
                        var err = textStatus + ", " + error;
                        console.log("Request Failed: " + err);
                    });
                } else {
                    $('select[name="province"]').empty();
                }
            });
            $('select[name="province"]').on('change', function () {
                var data = $(this).val();
                if (data) {
                    $.getJSON('municipality-list', {data: data},
                            function (data) {
                                var items = "<option value=''>-Select-</option>";
                                $.each(data, function (i, ui) {
                                    items += "<option value='" + ui.city_mun_code + "'>" + ui.city_mun_desc + "</option>";
                                });
                                $('#city').html(items);
                            }).fail(function (jqxhr, textStatus, error) {
                        var err = textStatus + ", " + error;
                        console.log("Request Failed: " + err);
                    });
                } else {
                    $('select[name="city"]').empty();
                }
            });
            
            
            $("#coa-tab-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                var cco_header_file = $('#coa_header').prop('files')[0];
                var d = new FormData(); 
                d.append('office_id', $("#coa_office_id").val()); 
                d.append('file', cco_header_file); 
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: d,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('submit-coa-form'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#response').html(data.message);
                            $('#warning').fadeOut(9000);
                        }
                        if (data.status == 1)
                        {
                            $('#response').html(data.message);
                            $('#success').fadeOut(9000);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        var m = '<div id="err" class="alert alert-danger alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                                  '<span style="color:white;">Code: ' + jqXHR.status + '  Status: '+ status + ' description: '+ err + '</span>' +
                                '</div>';
                        $('#response').html(m);
                        $('#err').fadeOut(9000);
                    }
                });
            });
            
            $("#iso-standard-tab-form").submit('on', function (e) {
                e.preventDefault();
                $(".element_overlap").LoadingOverlay("show");
                var d = new FormData(); 
                d.append('iso_id', $("#iso_id").val());
                d.append('iso_document_code', $("#iso_document_code").val()); 
                $.ajax({
                    dataType: "json",
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: d,
                    headers: {'Authkey': '<?= $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('submit-iso-standard-form'); ?>',
                    success: function (data)
                    {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        if (data.status == 0)
                        {
                            $('#response').html(data.message);
                            $('#warning').fadeOut(9000);
                        }
                        if (data.status == 1)
                        {
                            $('#response').html(data.message);
                            $('#success').fadeOut(9000);
                        }
                    },
                    error: function (jqXHR, status, err) {
                        $(".element_overlap").LoadingOverlay("hide", true);
                        var m = '<div id="err" class="alert alert-danger alert-dismissible">' +
                                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                  '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' +
                                  '<span style="color:white;">Code: ' + jqXHR.status + '  Status: '+ status + ' description: '+ err + '</span>' +
                                '</div>';
                        $('#response').html(m);
                        $('#err').fadeOut(9000);
                    }
                });
            });
            

        </script>
</body>
</html>
