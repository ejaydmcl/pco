<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>PCO</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>PCO</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 0 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <!-- end message -->

<!--                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= base_url('public') ?>/images/user-icon.jpg" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            Reviewers
                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                        </h4>
                                        <p>See the instructions</p>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="footer"><a href="<?= base_url('#'); ?>">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu" id="menu_element_overlapT">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-danger"><?php
                            $newAppCount = 0;
                            if (isset($this->session->userdata['user']['employee_fk'])) {
                                $count1 = sizeof($this->TopBarModel->employeeNotification());
                                $newAppCount = 0; 
                            } else {
                                $count1 = sizeof($this->TopBarModel->pcoNotification()); // For the client
                            }
                            echo ($count1 + $newAppCount) >= 10?'10+': $count1 + $newAppCount;
                            ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php
                            if (isset($this->session->userdata['user']['employee_fk'])) {
                                $count1 = sizeof($this->TopBarModel->employeeNotification());
                                $newAppCount = 0; 
                            } else {
                                $count1 = sizeof($this->TopBarModel->pcoNotification()); // For the client
                            }
                            echo ($count1 + $newAppCount) >= 10?'more than 10': $count1 + $newAppCount;
                            ?> notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php
                                $newApplication = $this->TopBarModel->employeeNotification();
                                $comments = $this->TopBarModel->pcoNotification();
                                if (isset($this->session->userdata['user']['employee_fk'])) {
                                    if (isset($newApplication)) {
                                        foreach ($newApplication as $key => $value) {
                                            ?>
                                            <li>
                                                <ul class="menu">
                                                    <li>
                                                        <a id="notification-wrapper" <a onclick="notification(<?php echo $value['id']; ?>,<?php echo $value['receiver_id']; ?>, <?php echo $value['application_fk']; ?>)" href="javascript:void(0);">
                                                            <div id="notification-img" class="pull-left">
                                                                <img src="<?= base_url('uploads') ?>/profiles/<?php echo $this->ProfileModel->getProfilePhotoByUserID($value['user_id']) ?>" class="img-circle" alt="User Image">
                                                            </div>
                                                            <h6 class="notifications-label">
                                                                <span class="commentH label label-danger"> <?php echo $this->TopBarModel->application($value['application_fk'])['name_of_establishment'] ?> </span>
                                                                <span class="pull-right"><small><i class="fa fa-clock-o"></i> <?php echo gmdate('F j, Y', strtotime($value['date_created']) + date('Z')) ?> </small></span>
                                                            </h6>
                                                                <small> <p class="comment"><?php echo $this->TopBarModel->comment($value['comments_fk'])['comment'] ?></p></small>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                    }
                                } 
                                if (isset($comments)) {
                                        foreach ($comments as $key => $value) {
                                            ?>
                                            <li>
                                                <ul class="menu">
                                                    <li>
                                                        <a id="notification-wrapper" <a onclick="notification(<?php echo $value['id']; ?>,<?php echo $value['receiver_id']; ?>, <?php echo $value['application_fk']; ?>)" href="javascript:void(0);">
                                                            <div id="notification-img" class="pull-left">
                                                                <img src="<?= base_url('uploads') ?>/profiles/<?php echo $this->ProfileModel->getProfilePhotoByUserID($value['user_id']) ?>" class="img-circle" alt="User Image">
                                                            </div>
                                                            <h6 class="notifications-label">
                                                                <span class="commentH label label-danger"> <?php echo $this->TopBarModel->application($value['application_fk'])['name_of_establishment'] ?> </span>
                                                                <span class="pull-right"><small><i class="fa fa-clock-o"></i> <?php echo gmdate('F j, Y', strtotime($value['date_created']) + date('Z')) ?> </small></span>
                                                            </h6>
                                                            <small> <p class="comment"><?php echo $this->TopBarModel->comment($value['comments_fk'])['comment'] ?></p></small>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->
                <?php
                $user = $this->TopBarModel->getUserInformation();
                $userType = $user['account_fk'];
                $account = null;
                $employee = null;
                // PCO personnel
                if(isset($user['account_fk'])) {
                    $account =  $this->TopBarModel->getAccountInformation($user['account_fk']);
                }
                // For the employee
                if(isset($user['employee_fk'])) {
                    $employee =  $this->TopBarModel->getEmployeeInformation($user['employee_fk']);
                }
                
                $userData = ( isset($account)==TRUE? $account : (isset($employee)==TRUE? $employee:NULL) );
                
                //var_dump($user);
                ?>
                <li class="dropdown user user-menu element_overlap_profile">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url('uploads') ?>/profiles/<?php $photo = $this->ProfileModel->getProfilePhoto() == FALSE ? 'no-image.png' : $this->ProfileModel->getProfilePhoto(); echo $photo; ?>" class="user-image profileImgUrl" alt="">
                        <span class="hidden-xs NameEdt"><?= $userData['first_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <img src="<?= base_url('uploads') ?>/profiles/<?php $photo = $this->ProfileModel->getProfilePhoto() == FALSE ? 'no-image.png' : $this->ProfileModel->getProfilePhoto(); echo $photo; ?>" class="img-circle profileImgUrl" alt="">

                            <p>
                                <span class="NameEdt"><?= $userData['first_name']; ?></span>
                                <small>Member since <?= date('M. Y', strtotime($this->session->userdata['user']['date_created'])); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a onclick="onClickProfile(<?php echo $this->session->userdata['user']['id']; ?>)" href="javascript:void(0);" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
<script>
    function notification(notification_id,receiver_id,app_fk) {
        $("#menu_element_overlapT").LoadingOverlay("show");
        $.ajax({
            dataType: "json",
            type: "post",
            data: {notification: notification_id,receiver: receiver_id,application_fk: app_fk},
            headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
            url: '<?= base_url('notification-click') ?>',
            success: function (data)
            {
                if (data.status === 0)
                {
                    alert(data.message);
                }
                if (data.status === 1)
                {
                    window.location = data.redirectUrl;
                }
            },
            error: function (jqXHR, status, err) {
                $("#menu_element_overlapT").LoadingOverlay("hide", true);
                alert('Local error callback. Please try again... ');
            }
        });
    }
    
    function onClickProfile(id) {
        $(".element_overlap_profile").LoadingOverlay("show");
        $.ajax({
            dataType: "json",
            type: "post",
            data: {id: id,url:'selected-profile'},
            headers: {'Authorization': '<?= $this->security->get_csrf_hash(); ?>'},
            url: '<?= base_url('selected-pco-profile') ?>',
            success: function (data)
            {
                $(".element_overlap_profile").LoadingOverlay("hide", true);
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
                    window.open(data.redirectUrl,'_blank');
                }
            },
            error: function (jqXHR, status, err) {
                $(".element_overlap_profile").LoadingOverlay("hide", true);
                alert('Local error callback');
            }
        });
    }
</script>