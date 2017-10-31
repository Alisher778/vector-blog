<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="widget-title">
    <h4 class="title"><?php echo html_escape($this->lang->line("title_random_posts")); ?></h4>
</div>
<div class="col-sm-12 widget-body">
    <div class="row">

        <!-- owl-carousel -->
        <div class="owl-carousel random-post-slider" id="random-slider">

            <!--List  random slider posts-->
        <?php foreach($random_slider_posts as $item):?>
            <!-- slider item -->
                <div class="random-slider-item">
                    <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                        <img src="<?php echo base_url() . $item->image_slider; ?>"
                             alt="<?php echo html_escape($item->title); ?>"/>
                        <div class="img-gradient"></div>

                        <div class="item-info">
                                <a href="<?php echo base_url() . 'category/' . str_slug($item->category_name) . '/' . $item->category_id; ?>" class="a-slider-category">
                                    <label class="label label-danger label-slider-category cursor-pointer">
                                        <?php echo html_escape($item->category_name); ?>
                                    </label>
                                </a>

                            <h3 class="title">
                                <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                                    <?php echo html_escape(character_limiter($item->title, 70, '...')); ?>
                                </a>
                            </h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>