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

                <div class="col-sm-12">
                    <div class="content page-about page-gallery">

                        <?php if ($page->title_active) : ?>
                            <h1 class="page-title"><?php echo html_escape($this->lang->line("nav_gallery")); ?></h1>
                        <?php endif; ?>


                        <!--Portfolio Filters-->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="filters text-center">
                                    <label data-filter="" class="btn btn-primary active">
                                        <input type="radio" name="options"> All
                                    </label>

                                    <?php foreach ($gallery_categories as $category): ?>
                                        <label data-filter="<?php echo $category->name; ?>" class="btn btn-primary">
                                            <input type="radio" name="options"> <?php echo $category->name; ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row row-masonry">
                            <div id="masonry" class="gallery">
                                <!--Load Items-->
                                <?php foreach ($gallery_images as $item): ?>
                                    <div data-filter="<?php echo html_escape($item->category_name); ?>" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gallery-item">
                                        <div class="item-inner">
                                            <a class="image-popup expand-image lightbox" href="<?php echo base_url() . $item->path_big; ?>" data-effect="mfp-zoom-out" title="<?php echo html_escape($item->title); ?>">
                                                <img src="<?php echo base_url() . $item->path_small; ?>"  alt="<?php echo html_escape($item->title); ?>"  class="img-responsive"/>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    var get_gallery_images_url = '<?php echo base_url();?>gallery-get-images-post';
</script>
