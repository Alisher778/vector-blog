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
                    <li class="breadcrumb-item active"><?php echo html_escape($this->lang->line("breadcrumb_search")); ?></li>
                    </li>
                </ol>
            </div>

            <div class="page-content">
                <div class="col-sm-12 col-md-8">

                    <div class="content">
                        <h1 class="page-title"> <?php echo html_escape($this->lang->line("page_title_search")); ?>
                            : <?php echo html_escape($q); ?></h1>

                        <!-- posts -->
                        <div class="posts">

                            <?php $count = 0; ?>

                            <?php foreach ($posts as $item): ?>

                                <!-- post item -->
                                <?php $this->load->view('partials/_post_item', ['item' => $item]); ?>
                                <!-- /.post item -->


                                <?php if ($count == 0): ?>
                                    <!-- Ad Space -->
                                    <?php if (trim($ads->search_728) != ''): ?>
                                        <div class="col-sm-12 post-item ad-block-728">
                                            <div id="ad-space" class="p0">
                                                <div class="row">
                                                    <div class="ads-728">
                                                        <?php echo $ads->search_728; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (trim($ads->search_468) != ''): ?>
                                        <div class="col-sm-12 post-item ad-block-468">
                                            <div id="ad-space" class="p0">
                                                <div class="row">
                                                    <div class="ads-468">
                                                        <?php echo $ads->search_468; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (trim($ads->search_234) != ''): ?>
                                        <div class="col-sm-12 post-item ad-block-234">
                                            <div id="ad-space" class="p0">
                                                <div class="row">
                                                    <div class="ads-234">
                                                        <?php echo $ads->search_234; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- /.Ad Space -->

                                    <!-- increment count -->
                                    <?php $count++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($post_count < 1): ?>
                                <p class="text-center"><?php echo html_escape($this->lang->line("search_noresult")); ?></p>
                            <?php endif; ?>


                        </div><!-- /.posts -->


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

