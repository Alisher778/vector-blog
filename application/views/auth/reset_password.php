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
                    <li class="breadcrumb-item active"><?php echo html_escape($this->lang->line("breadcrumb_reset_password")); ?></li>
                </ol>
            </div>

            <div class="page-content">
                <div class="col-xs-12 col-sm-5 center-box">
                    <div class="content page-contact page-login">

                        <h1 class="page-title text-center"><?php echo html_escape($this->lang->line("nav_reset_password")); ?></h1>

                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <!-- form start -->
                        <?php echo form_open('reset-password-post'); ?>

                        <div class="form-group has-feedback">
                            <input type="email" name="email" class="form-control"
                                   placeholder="<?php echo html_escape($this->lang->line("placeholder_email")); ?>"
                                   required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-action pull-right">
                                <?php echo html_escape($this->lang->line("btn_reset_password")); ?>
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



