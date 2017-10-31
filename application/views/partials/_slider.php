<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- owl-carousel -->
<div class="owl-carousel" id="home-slider">

    <?php foreach ($slider_posts as $item) : ?>
        <!-- slider item -->
        <div class="home-slider-item">
            <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                <img src="<?php echo base_url() . $item->image_slider; ?>"
                     alt="<?php echo html_escape($item->title); ?>"/>
                <div class="item-overlay"></div>

                <div class="item-info">
                    <a href="<?php echo base_url() . 'category/' . str_slug($item->category_name) . '/' . $item->category_id; ?>"
                       class="a-slider-category">
                        <label class="label label-danger label-slider-category cursor-pointer">
                            <?php echo html_escape($item->category_name); ?>
                        </label>
                    </a>

                    <h2 class="title">
                        <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                            <?php echo html_escape(character_limiter($item->title, 70, '...')); ?>
                        </a>
                    </h2>
                    <div class="item-meta">
                        <span>
                            <i class="fa fa-calendar"></i>&nbsp;
                            <?php echo nice_date($item->created_at, 'd.m.Y'); ?>
                        </span>

                        <span>
                        <i class="fa fa-comments"></i>&nbsp;
                            <?php echo helper_get_comment_count($item->id);?>
                            <?php echo html_escape($this->lang->line("meta_comments")); ?>
                        </span>
                        <!--Show if enabled-->
                        <?php if ($settings->show_pageviews == 1) : ?>
                            <span><i class="fa fa-eye"></i>&nbsp;
                                <?php echo $item->hit; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>

</div><!-- /.owl-carousel -->