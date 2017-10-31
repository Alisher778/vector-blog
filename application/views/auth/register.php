<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Section: main -->
<section id="main">
    <div class="container">
        <div class="row">
            <!-- breadcrumb -->
            <div class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>"><?php echo html_escape($this->lang->line("breadcrumb_home")); ?></a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo html_escape($this->lang->line("breadcrumb_register")); ?></li>
                </ol>
            </div>

            <div class="page-content">
                <div class="col-xs-12 col-sm-5 center-box">
                    <div class="content page-contact page-login">

                        <h1 class="page-title text-center"><?php echo html_escape($this->lang->line("nav_register")); ?></h1>

                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <!-- form start -->
                        <?php echo form_open('register-post', array('onsubmit'=>"if (!checkCaptcha($('#captcha-input').val())) { $('#captcha-input').addClass('has-error'); return false };")); ?>

                        <div class="form-group has-feedback">
                            <input type="text" name="username" class="form-control"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_username")); ?>"
                                   value="<?php echo html_escape($this->session->flashdata('form_data')['username']); ?>" required>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="email" name="email" class="form-control"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_email")); ?>"
                                   value="<?php echo html_escape($this->session->flashdata('form_data')['email']); ?>" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_password")); ?>"
                                   value="<?php echo html_escape($this->session->flashdata('form_data')['password']); ?>" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" name="confirm_password" class="form-control"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_confirm_password")); ?>" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback text-center captcha-cnt">
                            <a class="captcha-refresh" onclick="refreshCaptcha();"><i class="fa fa-refresh"></i></a>
                            <img id='imageCaptcha' alt="">
                        </div>

                        <div class="col-sm-12 p0 form-group has-feedback m0">
                            <input type="text" id="captcha-input" class="form-control pull-right"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_captcha")); ?>" required>
                        </div>
                        <div class="col-sm-12 p0 form-group has-feedback">
                            <button type="submit" class="btn btn-primary btn-action pull-right margin-top-15">
                                <?php echo html_escape($this->lang->line("breadcrumb_register")); ?>
                            </button>
                        </div>

                        <?php echo form_close(); ?><!-- form end -->

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- /.Section: main -->

