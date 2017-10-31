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
                    <li class="breadcrumb-item active"><?php echo html_escape($this->lang->line("breadcrumb_reading_list")); ?></li>
                    </li>
                </ol>
            </div>

            <div class="page-content">
                <div class="col-sm-12 col-md-8">

                    <div class="content">
                        <h1 class="page-title"> <?php echo html_escape($this->lang->line("nav_reading_list")); ?></h1>

                        <!-- posts -->
                        <div class="posts">

                            <?php $count = 0; ?>

                            <?php foreach ($posts as $item) : ?>

                                <!-- post item -->
                                <?php $this->load->view('partials/_post_item', ['item' => $item]); ?>
                                <!-- /.post item -->

                            <?php endforeach; ?>

                            <?php if ($post_count < 1): ?>
                                <p class="text-center"><?php echo html_escape($this->lang->line("text_list_empty")); ?></p>
                            <?php endif; ?>
                        </div><!-- /.posts -->


                        <!-- Pagination -->
                        <div class="col-sm-12">
                            <div class="row">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-sm-12 col-md-4">
                    <!--Sidebar-->
                    <?php $this->load->view('partials/_sidebar'); ?>
                </div><!--/col-->

            </div>
        </div>
    </div>
</section>
<!-- /.Section: main -->

