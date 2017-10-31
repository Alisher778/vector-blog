<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Partial: Popular Posts-->
<div class="widget-title widget-popular-posts-title">
    <h4 class="title"><?php echo html_escape($this->lang->line("title_popular_posts")); ?></h4>
</div>

<div class="col-sm-12 widget-body">
    <div class="row">
        <ul class="widget-list w-popular-list">

            <!--List  popular posts-->
            <?php foreach ($popular_posts as $item): ?>
                <li>
                    <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                            <?php if (!empty($item->image_small)): ?>
                                <img src="<?php echo base_url() . $item->image_small; ?>"
                                     alt="<?php echo html_escape($item->title); ?>" class="img-popular"/>
                            <?php endif; ?>
                            <?php if (!empty($item->image_slider)): ?>
                                <img src="<?php echo base_url() . $item->image_slider; ?>"
                                     alt="<?php echo html_escape($item->title); ?>" class="img-popular-mobile"/>
                            <?php endif; ?>

                    </a>
                    <h3 class="title">
                        <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                            <?php echo html_escape(character_limiter($item->title, 55, '...')); ?>
                        </a>
                    </h3>
                    <div class="w-meta">
                        <span><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo nice_date($item->created_at, 'd.m.Y'); ?></span>
                        <span><i class="fa fa-comments"></i>&nbsp;
                            <?php echo helper_get_comment_count($item->id); ?>&nbsp;<?php echo html_escape($this->lang->line("meta_comments")); ?>
                         </span>

                        <!--Show if enabled-->
                        <?php if ($settings->show_pageviews == 1) : ?>
                            <span><i class="fa fa-eye"></i>&nbsp;
                                <?php echo $item->hit; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>