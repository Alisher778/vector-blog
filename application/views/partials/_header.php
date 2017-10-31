<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> - <?php echo html_escape($settings->site_title); ?></title>

    <meta name="description" content="<?php echo html_escape($description); ?>">
    <meta name="keywords" content="<?php echo html_escape($settings->site_keywords); ?>"/>
    <meta name="author" content="Codingest">
    <meta name="robots" content="all"/>
    <meta name="revisit-after" content="1 Days"/>

    <?php if (empty($settings->favicon_path)): ?>
        <link rel="shortcut icon" type="image/png"
              href="<?php echo base_url(); ?>assets/img/favicon.png"/>
    <?php else: ?>
        <link rel="shortcut icon" type="image/png"
              href="<?php echo base_url() . html_escape($settings->favicon_path); ?>"/>
    <?php endif; ?>

    <?php echo $primary_font_url; ?>
    <?php echo $secondary_font_url; ?>

    <!-- Font-awesome CSS -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">

    <!-- Owl-carousel CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.theme.default.min.css" rel="stylesheet"/>

    <!-- Jquery Confirm CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/jquery-confirm/jquery-confirm.min.css" rel="stylesheet"/>

    <!-- Animated CSS -->
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!-- Magnific Popup CSS -->
    <link href="<?php echo base_url(); ?>assets/css/magnific-popup.css" rel="stylesheet"/>

    <!-- Style CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet"/>

    <!-- Color CSS -->
    <?php if ($settings->site_color == '') : ?>
        <link href="<?php echo base_url(); ?>assets/css/colors/default.css" rel="stylesheet"/>
    <?php else : ?>
        <link href="<?php echo base_url(); ?>assets/css/colors/<?php echo html_escape($settings->site_color); ?>.css" rel="stylesheet"/>
    <?php endif; ?>

    <!-- Responsive CSS -->
    <link href="<?php echo base_url(); ?>assets/css/responsive.min.css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo $settings->google_analytics; ?>


    <style>
        body {
        <?php echo $primary_font_family; ?>
        }

        .text-style {
        <?php echo $secondary_font_family; ?>
        }
    </style>

    <script>
        var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
        var csfr_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>
</head>
<body>

<!-- header -->
<header id="header">
    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">

                <div class="social-mobile">
                    <div class="col-sm-12">
                        <div class="row">
                            <ul class="nav navbar-nav">
                                <!--if facebook url exists-->
                                <?php if (!empty($settings->facebook_url)) : ?>
                                    <li>
                                        <a class="facebook" href="<?php echo html_escape($settings->facebook_url); ?>"
                                           target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                <?php endif; ?>
                                <!--if twitter url exists-->
                                <?php if (!empty($settings->twitter_url)) : ?>
                                    <li>
                                        <a class="twitter" href="<?php echo html_escape($settings->twitter_url); ?>"
                                           target="_blank"><i
                                                    class="fa fa-twitter"></i></a>
                                    </li>
                                <?php endif; ?>
                                <!--if google url exists-->
                                <?php if (!empty($settings->google_url)) : ?>
                                    <li>
                                        <a class="google" href="<?php echo html_escape($settings->google_url); ?>"
                                           target="_blank">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <!--if pinterest url exists-->
                                <?php if (!empty($settings->pinterest_url)) : ?>
                                    <li>
                                        <a class="pinterest" href="<?php echo html_escape($settings->pinterest_url); ?>"
                                           target="_blank"><i
                                                    class="fa fa-pinterest"></i></a>
                                    </li>
                                <?php endif; ?>
                                <!--if instagram url exists-->
                                <?php if (!empty($settings->instagram_url)) : ?>
                                    <li>
                                        <a class="instgram" href="<?php echo html_escape($settings->instagram_url); ?>"
                                           target="_blank"><i
                                                    class="fa fa-instagram"></i></a>
                                    </li>
                                <?php endif; ?>
                                <!--if linkedin url exists-->
                                <?php if (!empty($settings->linkedin_url)) : ?>
                                    <li>
                                        <a class="linkedin" href="<?php echo html_escape($settings->linkedin_url); ?>"
                                           target="_blank"><i
                                                    class="fa fa-linkedin"></i></a>
                                    </li>
                                <?php endif; ?>
                                <!--if vk url exists-->
                                <?php if (!empty($settings->vk_url)) : ?>
                                    <li>
                                        <a class="vk" href="<?php echo html_escape($settings->vk_url); ?>"
                                           target="_blank"><i class="fa fa-vk"></i></a>
                                    </li>
                                <?php endif; ?>

                                <li class="pull-right">
                                    <a href="#" data-toggle="modal-search" class="search-icon"><i
                                                class="fa fa-search"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php if (empty($settings->logo_path)): ?>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img
                                src="<?php echo base_url(); ?>assets/img/logo.png" alt=""></a>
                <?php else: ?>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img
                                src="<?php echo base_url() . html_escape($settings->logo_path); ?>" alt=""></a>
                <?php endif; ?>

            </div>


            <!--current active page-->
            <?php
            $active = uri_string();
            $page_count = 1;
            $dropdown_page = 1;
            ?>

            <!--navigation-->
            <div class="collapse navbar-collapse navbar-left">
                <ul class="nav navbar-nav">

                    <?php foreach ($header_pages as $page) : ?>
                        <?php if ($page->page_active == 1): ?>

                            <!--If count smaller than 6-->
                            <?php if ($page_count < 6) : ?>


                                <!--If not custom-->
                                <?php if ($page->is_custom == 0) : ?>
                                    <?php if ($page->slug == "index") : ?>
                                        <li class="<?php echo ($active == "") ? 'active' : ''; ?>">
                                            <a href="<?php echo base_url(); ?>">
                                                <?php echo html_escape($this->lang->line("nav_home")); ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="<?php echo ($active == $page->slug) ? 'active' : ''; ?>">
                                            <a href="<?php echo base_url() . html_escape($page->slug); ?>">
                                                <?php echo html_escape($this->lang->line("nav_" . $page->slug)); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?><!--If index-->

                                <?php else : ?>
                                    <!--If custom page-->
                                    <li class="<?php echo ($active == $page->slug) ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url() . html_escape($page->slug); ?>">
                                            <?php echo html_escape($page->title); ?>
                                        </a>
                                    </li>
                                <?php endif; ?><!--If page custom-->


                            <?php endif; ?><!--If count < 6-->

                            <?php $page_count++; ?>
                        <?php endif; ?><!--If page active-->
                    <?php endforeach; ?>


                    <!--Show More Pages-->
                    <?php if ($page_count > 6) : ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo html_escape($this->lang->line("more")); ?>
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu">

                                <?php foreach ($header_pages as $page) : ?>
                                    <?php if ($page->page_active == 1) : ?>
                                        <?php if ($dropdown_page > 5) : ?>
                                            <!--If not custom-->
                                            <?php if ($page->is_custom == 0) : ?>
                                                <?php if ($page->slug == "index") : ?>
                                                    <li>
                                                        <a href="<?php echo base_url(); ?>">
                                                            <?php echo html_escape($this->lang->line("nav_home")); ?>
                                                        </a>
                                                    </li>
                                                <?php else : ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . html_escape($page->slug); ?>">
                                                            <?php echo html_escape($this->lang->line("nav_" . $page->slug)); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?><!--If index-->

                                            <?php else : ?>
                                                <!--If custom page-->
                                                <li>
                                                    <a href="<?php echo base_url() . html_escape($page->slug); ?>">
                                                        <?php echo html_escape($page->title); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?><!--If page custom-->

                                        <?php endif; ?><!--If dropdown page-->
                                        <?php $dropdown_page++; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </ul>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="collapse navbar-collapse navbar-right social-nav">
                <ul class="nav navbar-nav">
                    <?php if (auth_check()) : ?>
                        <li class="dropdown profile-dropdown">
                            <a href="#" class="dropdown-toggle image-profile-drop" data-toggle="dropdown"
                               aria-expanded="false">
                                <?php if (!empty(user()->avatar)) : ?>
                                    <img src="<?php echo base_url() . user()->avatar; ?>" alt="">
                                <?php else : ?>
                                    <img src="<?php echo base_url(); ?>assets/img/user.png" alt="">
                                <?php endif; ?>
                                <span><?php echo html_escape(character_limiter(user()->username, 20, '...')); ?></span>
                            </a>
                            <a href="#" class="dropdown-toggle profile-drop" data-toggle="dropdown"
                               aria-expanded="false">
                                <span><?php echo html_escape(character_limiter(user()->username, 20, '...')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (is_admin() || is_editor()): ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>admin">
                                            <i class="fa fa-cog"></i>&nbsp;
                                            <?php echo html_escape($this->lang->line("nav_admin_panel")); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>reading-list">
                                        <i class="fa fa-star"></i>&nbsp;
                                        <?php echo html_escape($this->lang->line("breadcrumb_reading_list")); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>update-profile">
                                        <i class="fa fa-user"></i>&nbsp;
                                        <?php echo html_escape($this->lang->line("breadcrumb_update_profile")); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>change-password">
                                        <i class="fa fa-lock"></i>&nbsp;
                                        <?php echo html_escape($this->lang->line("breadcrumb_change_password")); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>logout"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>&nbsp;
                                        <?php echo html_escape($this->lang->line("nav_logout")); ?>
                                    </a>

                                    <?php echo form_open('logout', array('id' => 'logout-form', 'class' => 'hidden', 'method' => 'get')); ?>
                                    <?php echo form_close(); ?>
                                </li>
                            </ul>
                        </li>

                    <?php else : ?>
                        <li class="<?php echo ($active == 'login') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>login">
                                <?php echo html_escape($this->lang->line("nav_login")); ?>
                            </a>
                        </li>
                        <li class="<?php echo ($active == 'register') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>register">
                                <?php echo html_escape($this->lang->line("nav_register")); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="#" data-toggle="modal-search" class="search-icon"><i class="fa fa-search"></i></a>
                    </li>
                </ul>

            </div>
        </div><!--/.container-->
    </nav><!--/nav-->


    <!--search modal-->
    <div class="modal-search">
        <?php echo form_open('search', ['method' => 'get']); ?>
        <div class="container">
            <input type="text" name="q" class="form-control" maxlength="300" pattern=".*\S+.*"
                   placeholder="<?php echo html_escape($this->lang->line("placeholder_search")); ?>" required>
            <i class="fa fa-times close"></i>
        </div>
        <?php echo form_close(); ?>
    </div><!-- /.modal-search -->


</header>
<!-- /.header-->




