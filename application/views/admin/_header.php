<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo html_escape($title); ?> - Admin Infinite</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php if (empty($settings->favicon_path)): ?>
        <link rel="shortcut icon" type="image/png"
              href="<?php echo base_url(); ?>assets/img/favicon.png"/>
    <?php else: ?>
        <link rel="shortcut icon" type="image/png"
              href="<?php echo base_url() . html_escape($settings->favicon_path); ?>"/>
    <?php endif; ?>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/_all-skins.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables_themeroller.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/all.css">

    <!-- Tags Input -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/tagsinput/bootstrap-tagsinput.css">

    <!-- Bootstrap Toggle  css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-toggle.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
        var csfr_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>I</b>n</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <b>Infinite Panel</b>
            </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <a class="btn btn-sm btn-success pull-left btn-site-prev" target="_blank"
                   href="<?php echo base_url(); ?>"><i
                            class="fa fa-eye"></i> View Site</a>
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url(); ?>assets/admin/img/user.jpg" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs"><?php echo html_escape(user()->username); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo base_url(); ?>assets/admin/img/user.jpg" class="img-circle"
                                     alt="User Image">
                                <p>
                                    <?php echo html_escape(user()->username); ?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>logout"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                        <i class="fa fa-sign-out"></i>&nbsp;
                                        <?php echo html_escape($this->lang->line("nav_logout")); ?>
                                    </a>

                                    <?php echo form_open('logout', array('id' => 'logout-form', 'class' => 'hidden')); ?>
                                    <?php echo form_close(); ?>

                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>assets/admin/img/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo html_escape(user()->username); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>


            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo base_url(); ?>admin">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                <?php if (is_admin()): ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-leaf"></i> <span>Pages</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active">
                                <a href="<?php echo base_url(); ?>admin/add-page">
                                    <i class="fa fa-circle-o"></i> Add New Page
                                </a>
                            </li>

                            <?php foreach ($pages as $page): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>admin/update-page/<?php echo html_escape($page->id); ?>">
                                        <i class="fa fa-circle-o"></i>
                                        <?php echo html_escape($page->title); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file"></i> <span>Posts</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin/add-post">
                                <i class="fa fa-circle-o"></i> Add New Post
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/posts"><i class="fa fa-circle-o"></i> Posts
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/categories">
                        <i class="fa fa-folder-open"></i> <span>Categories</span>
                    </a>
                </li>

                <?php if (is_admin()): ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-image"></i> <span>Photo Gallery</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/gallery-categories">
                                    <i class="fa fa-circle-o"></i> Categories
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/photo-gallery">
                                    <i class="fa fa-circle-o"></i> Photos
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/comments">
                            <i class="fa fa-comments"></i>
                            <span>Comments</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/contact-messages">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <span>Contact Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/newsletter">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>Newsletter</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/ads">
                            <i class="fa fa-dollar" aria-hidden="true"></i>
                            <span>Ad Spaces</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/font-options"><i class="fa fa-font" aria-hidden="true"></i>
                            <span>Font Options</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/seo-tools"><i class="fa fa-wrench"></i>
                            <span>Seo Tools</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/settings">
                            <i class="fa fa-cogs"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
