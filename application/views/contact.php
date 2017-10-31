<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Section: main -->
<section id="main">
    <div class="container">
        <div class="row">

            <!-- breadcrumb -->
            <?php if ($page->breadcrumb_active == 1): ?>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>"><?php echo html_escape($this->lang->line("breadcrumb_home")); ?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo html_escape($page->title); ?></li>
                    </ol>
                </div>
            <?php else: ?>
                <div class="page-breadcrumb m-t-45">
                </div>
            <?php endif; ?>

            <div class="page-content">

                <?php if ($page->right_column_active): ?>

                <div class="col-sm-12 col-md-8">
                    <div class="content page-contact">

                        <?php if ($page->title_active): ?>
                            <h1 class="page-title"><?php echo html_escape($this->lang->line("nav_contact")); ?></h1>
                        <?php endif; ?>


                        <div class="contact-text text-style">
                            <?php echo $settings->contact_text; ?>
                        </div>

                        <?php if ($settings->contact_address): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_address); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_email): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_email); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_phone): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_phone); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <h2 class="contact-leave-message"><?php echo html_escape($this->lang->line("leave_message")); ?></h2>

                        <!-- include message block -->
                        <?php $this->load->view('partials/_messages'); ?>

                        <!-- form start -->
                        <?php echo form_open('contact-post',['onsubmit'=>"if (!checkCaptcha($('#captcha-input').val())) { $('#captcha-input').addClass('has-error'); return false };"]); ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name"
                                       placeholder="<?php echo html_escape($this->lang->line("placeholder_name")); ?>" maxlength="199" minlength="1"
                                       pattern=".*\S+.*" value="<?php echo html_escape($this->session->flashdata('form_data')['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" maxlength="199"
                                       placeholder="<?php echo html_escape($this->lang->line("placeholder_email")); ?>"
                                       value="<?php echo html_escape($this->session->flashdata('form_data')['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="message"
                                              placeholder="<?php echo html_escape($this->lang->line("placeholder_message")); ?>" maxlength="4970"
                                              minlength="5"
                                              required><?php echo html_escape($this->session->flashdata('form_data')['message']); ?></textarea>
                            </div>
                            <div class="form-group has-feedback text-center">
                                <div class="row">
                                    <div class="col-sm-6 margin-bottom15 captcha-cnt">
                                        <a class="captcha-refresh" onclick="refreshCaptcha();"><i
                                                    class="fa fa-refresh"></i></a>
                                        <img id='imageCaptcha' alt="captcha">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" id="captcha-input" class="form-control pull-right"
                                               placeholder="<?php echo html_escape($this->lang->line("placeholder_captcha")); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default pull-right btn-action">
                                    <?php echo html_escape($this->lang->line("btn_submit")); ?>
                                </button>
                            </div>

                        </form><!-- form end -->

                    </div>

                </div>

                <div class="col-sm-12 col-md-4">
                    <!--Sidebar-->
                    <?php $this->load->view('partials/_sidebar'); ?>
                </div><!--/col-->

               <?php else: ?>
                <div class="col-sm-12">
                    <div class="content page-contact">

                        <?php if ($page->title_active): ?>
                            <h1 class="page-title"><?php echo html_escape($this->lang->line("nav_contact")); ?></h1>
                        <?php endif; ?>


                        <div class="contact-text">
                            <?php echo $settings->contact_text; ?>
                        </div>

                        <?php if ($settings->contact_address): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_address); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_email): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_email); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings->contact_phone): ?>
                            <div class="row contact-item">
                                <div class="col-sm-2 col-xs-2 contact-icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-10 col-xs-10 contact-info">
                                    <?php echo html_escape($settings->contact_phone); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <h2 class="contact-leave-message"><?php echo html_escape($this->lang->line("leave_message")); ?></h2>

                        <!-- message
                        @include('includes._front_message_block')
-->

                        <!-- form start -->
                        <form action="{{ route('contact-post') }}" method="post"
                              onsubmit="if (!checkCaptcha($('#captcha-input').val())) { $('#captcha-input').addClass('has-error'); return false };">

                            <div class="form-group">
                                <input type="text" class="form-control" name="name"
                                       placeholder="<?php echo html_escape($this->lang->line("placeholder_name")); ?>" maxlength="199" minlength="1"
                                       pattern=".*\S+.*" value="{{ Request::old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" maxlength="199"
                                       placeholder="<?php echo html_escape($this->lang->line("placeholder_email")); ?>"
                                       value="{{ Request::old('email') }}" required>
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control" name="message"
                                              placeholder="<?php echo html_escape($this->lang->line("placeholder_message")); ?>" maxlength="4970"
                                              minlength="5"
                                              required>{{ Request::old('message') }}</textarea>
                            </div>
                            <div class="form-group has-feedback text-center">
                                <div class="row">
                                    <div class="col-sm-6 margin-bottom15 captcha-cnt">
                                        <a class="captcha-refresh" onclick="refreshCaptcha();"><i
                                                    class="fa fa-refresh"></i></a>
                                        <img id='imageCaptcha' alt="captcha">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" id="captcha-input" class="form-control pull-right"
                                               placeholder="<?php echo html_escape($this->lang->line("placeholder_captcha")); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default pull-right btn-action">
                                    <?php echo html_escape($this->lang->line("btn_submit")); ?>
                                </button>
                            </div>

                        </form><!-- form end -->

                    </div>

                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- /.Section: main -->
