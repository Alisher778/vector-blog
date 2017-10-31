<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--post list item-->
<div class="col-sm-12 post-item">
    <div class="row">
        <div class="post-image">
            <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                <?php if (!empty($item->image_mid)): ?>
                    <img src="<?php echo base_url() . html_escape($item->image_mid); ?>" class="img-responsive"
                         alt="<?php echo html_escape($item->title); ?>"/>
                <?php endif; ?>
            </a>
        </div>

        <div class="post-footer">
            <div class="text-center">
                <!--if related category exists-->
                <p class="label-post-category">
                    <a href="<?php echo base_url() . 'category/' . str_slug($item->category_name) . '/' . $item->category_id; ?>"
                       class="a-slider-category">
                        <label class="label label-danger cursor-pointer">
                            <?php echo html_escape($item->category_name); ?>
                        </label>
                    </a>
                </p>
                <h3 class="title">
                    <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                        <?php echo html_escape($item->title); ?>
                    </a>
                </h3>
                <div class="post-meta">
                    <span><i class="fa fa-calendar"></i>&nbsp;
                        <?php echo nice_date($item->created_at, 'd.m.Y'); ?>
                    </span>
                    <span>
                        <i class="fa fa-comments"></i>&nbsp;
                        <?php echo helper_get_comment_count($item->id); ?>
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
            <p class="summary text-center">
                <?php echo html_escape($item->summary); ?>
            </p>

            <div class="post-buttons">
                <!--Include social share links-->
                <?php $this->load->view('partials/_social_share', ['item' => $item]); ?>

                <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>"
                   class="pull-right read-more">
                    <?php echo html_escape($this->lang->line("btn_readmore")); ?>
                    <i class="fa fa-angle-right read-more-i" aria-hidden="true"></i>
                </a>
            </div>

        </div><!-- /.post footer -->
    </div><!-- /.row -->
</div>