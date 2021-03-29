<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <?php
                $obj = &get_instance();
                $obj->load->model(['UserModel', 'OuthModel']);
                $user = $obj->UserModel->GetUserData();
                ?>
                <img src="<?= base_url('uploads') ?>/profiles/<?php $photo = $this->ProfileModel->getProfilePhoto() == FALSE ? 'no-image.png' : $this->ProfileModel->getProfilePhoto();
                echo $photo; ?>" class="img-circle img-bordered-sm" alt=""> </div>
            <div id="username-label" class="pull-left info">
                <p class="NameEdt">
<?= $user['first_name']; ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->

<?php $uri = $this->uri->segment(1) . '/' . $this->uri->segment(2) ?>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><strong>MAIN NAVIGATION</strong> </li>
            <?php
            $userRole = array();
            array_push($userRole, $this->session->userdata['user']['role_fk']);
            if (count(array_intersect($userRole, [SUPER_USER, EMPLOYEE, SYSTEM_ADMINISTRATOR, PCO]))) {
                ?>
                <li class="<?php
                if ($uri == 'home/') {
                    echo'active';
                }
                ?>"><a href="<?= base_url('home'); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <?php } ?>

            <?php if ($this->session->userdata['user']['role_fk'] == PCO) { ?>
                <li class="<?php
                    if ($uri == 'profile/') {
                        echo'active';
                    }
                    ?>" ><a href="<?= base_url('profile'); ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <?php } ?>

            <li class="<?php
            if ($uri == 'application-page/') {
                echo'active';
            }
            ?>" ><a href="<?= base_url('application-page'); ?>"><i class="fa fa-list"></i> <span>Application</span></a></li>

            <li class="<?php
            if ($uri == 'downloadable-forms/') {
                echo'active';
            }
            ?>" ><a href="<?= base_url('downloadable-forms'); ?>"><i class="fa fa-edit"></i> <span>Downloadable forms</span></a></li>

                <?php if (count(array_intersect($userRole, [SUPER_USER, SYSTEM_ADMINISTRATOR]))) { ?>
                <li class="treeview <?php
                if ($uri == 'user-page/' || $uri == 'add-user-page/') {
                    echo 'active';
                }
                    ?>"> <a href="#"> <i class="fa fa-users"></i> <span>Users</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li class="<?php
                            if ($uri == 'user-page/') {
                                echo 'active';
                            }
                            ?>"> <a href="<?= base_url('user-page'); ?>">
                            <i class="<?php 
                            if ($uri == 'user-page/') {
                                echo 'fa fa-circle"';
                            } else {
                                echo 'fa fa-circle-o"';
                            }
                            ?>"></i>Personnel</a>
                        </li>
                    </ul>
                </li>
                <?php
            }
            ?>

<?php if (count(array_intersect($userRole, [SUPER_USER, SYSTEM_ADMINISTRATOR]))) { ?>
                <li class="treeview <?php
                        if ($uri == 'nature-of-business-page/' || $uri == 'pco-photo-requirements/' || $uri == 'pco-signature-requirements/' || $uri == 'pco-organization/' ) {
                            echo 'active';
                        }
                        ?>"> <a href="#"> <i class="fa fa-gears"></i> <span>Settings</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li class="<?php
                                if ($uri == 'pco-organization/') {
                                    echo 'active';
                                }
                                ?>"> <a href="<?= base_url('pco-organization'); ?>">
                                <i class="<?php
                               if ($uri == 'pco-organization/') {
                                   echo 'fa fa-circle"';
                               } else {
                                   echo 'fa fa-circle-o"';
                               }
                                ?>"></i>Organization</a>
                        </li>
                        <li class="<?php
                                if ($uri == 'pco-photo-requirements/') {
                                    echo 'active';
                                }
                                ?>"> <a href="<?= base_url('pco-photo-requirements'); ?>">
                                <i class="<?php
                               if ($uri == 'pco-photo-requirements/') {
                                   echo 'fa fa-circle"';
                               } else {
                                   echo 'fa fa-circle-o"';
                               }
                                ?>"></i>PCO Photo</a>
                        </li>
                        <li class="<?php
                                if ($uri == 'pco-signature-requirements/') {
                                    echo 'active';
                                }
                                ?>"> <a href="<?= base_url('pco-signature-requirements'); ?>">
                                <i class="<?php
                        if ($uri == 'pco-signature-requirements/') {
                            echo 'fa fa-circle"';
                        } else {
                            echo 'fa fa-circle-o"';
                        }
                        ?>"></i>PCO Signature</a>
                        </li>
                        <li class="<?php
                                if ($uri == 'nature-of-business-page/') {
                                    echo 'active';
                                }
                                ?>"> <a href="<?= base_url('nature-of-business-page'); ?>">
                                <i class="<?php
                if ($uri == 'nature-of-business-page/') {
                    echo 'fa fa-circle"';
                } else {
                    echo 'fa fa-circle-o"';
                }
                ?>"></i>Nature of Business</a>
                        </li>
                    </ul>
                </li>
    <?php
}
?>
                
<?php if (count(array_intersect($userRole, [SUPER_USER]))) { ?>
    <li class="treeview <?php
            if ($uri == 'pco-system/' || $uri == 'administrator-page/' || $uri == 'client-page/' || $uri == 'client-profile/') {
                echo 'active';
            }
            ?>"> <a href="#"> <i class="fa fa-gears"></i> <span>System</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
            <li class="<?php
                    if ($uri == 'pco-system/') {
                        echo 'active';
                    }
                    ?>"> <a href="<?= base_url('pco-system'); ?>">
                    <i class="<?php
                   if ($uri == 'pco-system/') {
                       echo 'fa fa-circle"';
                   } else {
                       echo 'fa fa-circle-o"';
                   }
                    ?>"></i>Error logs</a>
            </li>
            <li class="<?php
                    if ($uri == 'administrator-page/') {
                        echo 'active';
                    }
                    ?>"> <a href="<?= base_url('administrator-page'); ?>">
                    <i class="<?php
                   if ($uri == 'administrator-page/') {
                       echo 'fa fa-circle"';
                   } else {
                       echo 'fa fa-circle-o"';
                   }
                    ?>"></i>Administrator</a>
            </li>
            <li class="<?php
                    if ($uri == 'client-page/') {
                        echo 'active';
                    }
                    ?>"> <a href="<?= base_url('client-page'); ?>">
                    <i class="<?php
                   if ($uri == 'client-page/' || $uri == 'client-profile/') {
                       echo 'fa fa-circle"';
                   } else {
                       echo 'fa fa-circle-o"';
                   }
                    ?>"></i>Client</a>
            </li>
            
        </ul>
    </li>
    <?php
}
?>
        </ul>
    </section>

    <!-- /.sidebar -->

</aside>