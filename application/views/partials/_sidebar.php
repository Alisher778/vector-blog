<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="sidebar">
    <div class="sidebar-widget widget-popular-posts">
        <!--Include popular posts partial-->
        <?php $this->load->view('partials/_popular_posts'); ?>
    </div>

    <div class="sidebar-widget">
        <!--Include categories partial-->
        <?php $this->load->view('partials/_categories'); ?>
    </div>

    <div class="sidebar-widget">
        <!--Include random slider partial-->
        <?php $this->load->view('partials/_random_slider'); ?>
    </div>

    <div class="sidebar-widget">
        <!--Include tags partial-->
        <?php $this->load->view('partials/_tags'); ?>
    </div>


    <div class="sidebar-widget">

        <!-- Ad Space -->
        <?php if (trim($ads->sidebar_300) != ''): ?>
            <div class="ads-300 ad-block-300">
                <?php echo $ads->sidebar_300; ?>
            </div>
        <?php endif; ?>

        <?php if (trim($ads->sidebar_234) != ''): ?>
            <div class="ads-234 ad-block-234">
                <?php echo $ads->sidebar_234; ?>
            </div>
        <?php endif; ?>
        <!-- /.Ad Space -->

    </div>

</div><!--/Sidebar-->