<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start Footer Section -->
<footer id="footer">

    <div class="container">
        <div class="row footer-widgets">

            <!-- footer widget about-->
            <div class="col-sm-4 col-xs-12">
                <div class="footer-widget f-widget-about">
                    <div class="col-sm-12">
                        <div class="row">
                            <h4 class="title"><?php echo html_escape($this->lang->line("footer_about")); ?></h4>
                            <div class="title-line"></div>
                            <p>
                                <?php echo html_escape($settings->about_footer); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-sm-4 -->


            <!-- footer widget random posts-->
            <div class="col-sm-4 col-xs-12">
                <!--Include footer random posts partial-->
                <?php $this->load->view('partials/_footer_random_posts'); ?>
            </div><!-- /.col-sm-4 -->


            <!-- footer widget follow us-->
            <div class="col-sm-4 col-xs-12">
                <div class="footer-widget f-widget-follow">
                    <div class="col-sm-12">
                        <div class="row">
                            <h4 class="title"><?php echo html_escape($this->lang->line("footer_follow")); ?></h4>
                            <div class="title-line"></div>
                            <ul>
                                <!--if facebook url exists-->
                                <?php if (!empty($settings->facebook_url)) : ?>
                                    <li>
                                        <a class="facebook" href="<?php echo html_escape($settings->facebook_url); ?>"
                                           target="_blank"><i
                                                    class="fa fa-facebook"></i></a>
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
                                           target="_blank"><i
                                                    class="fa fa-google-plus"></i></a>
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

                            </ul>
                        </div>
                    </div>
                </div>

                <!-- newsletter -->
                <div class="newsletter col-sm-12">
                    <div class="row">
                        <p><?php echo html_escape($this->lang->line("footer_newsletter")); ?></p>
                        <?php echo form_open('add-to-newsletter'); ?>
                        <input type="email" name="email" id="newsletter_email" maxlength="199"
                               placeholder="<?php echo html_escape($this->lang->line("placeholder_email")); ?>" required>

                        <input type="submit" value="<?php echo html_escape($this->lang->line("btn_send")); ?>" class="newsletter-button">

                        <?php echo form_close(); ?>
                    </div>
                    <div class="row">
                        <p id="newsletter">
                            <?php
                            if ($this->session->flashdata('news_error')):
                                echo '<span class="text-danger">' . $this->session->flashdata('news_error') . '</span>';
                            endif;

                            if ($this->session->flashdata('news_success')):
                                echo '<span class="text-success">' . $this->session->flashdata('news_success') . '</span>';
                            endif;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- .col-md-3 -->
        </div>
        <!-- .row -->


        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-left">
                        <p><?php echo html_escape($this->lang->line("footer_copyright")); ?></p>
                    </div>

                    <div class="footer-bottom-right">
                        <ul class="nav-footer">
                            <?php foreach ($footer_pages as $page) : ?>
                                <?php if ($page->page_active == 1): ?>
                                    <li>
                                        <a href="<?php echo base_url() . html_escape($page->slug); ?>"><?php echo html_escape($page->title); ?> </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- .row -->
        </div>
    </div>
</footer>
<!-- End Footer Section -->

<canvas id="canvasC" width="200" height="54">
    Your browser does not support the canvas element.
</canvas>

<!-- Scroll Up Link -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>


<!-- Jquery -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>

<!-- Bootstrap js -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

<!-- Owl-carousel js -->
<script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>

<!-- Jquery Confirm js -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>

<!-- Gallery js -->
<script src="<?php echo base_url(); ?>assets/js/imagesloaded.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/masonry-3.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/masonry.filter.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>

<!-- Cookie js -->
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>

<!-- Theme js -->
<script src="<?php echo base_url(); ?>assets/js/theme.js"></script>

</body>
</html>
