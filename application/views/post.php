<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Section: main -->
<section id="main">
    <div class="container">
        <div class="row">
            <!-- breadcrumb -->
            <div class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                                href="<?php echo base_url(); ?>"> <?php echo html_escape($this->lang->line("breadcrumb_home")); ?></a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo html_escape($post->title); ?></li>
                </ol>
            </div>

            <div class="page-content">
                <div class="col-sm-12 col-md-8">
                    <div class="content">

                        <div class="post-content">
                            <div class="post-image">

                                <?php if ($post_image_count > 0) : ?>
                                    <!-- owl-carousel -->
                                    <div class="owl-carousel post-detail-slider" id="post-detail-slider">
                                        <div class="post-detail-slider-item" style="position: relative">
                                            <img src="<?php echo base_url() . $post->image_big; ?>"
                                                 alt="<?php echo html_escape($post->title); ?>" class="img-responsive"/>
                                        </div>
                                        <!--List  random slider posts-->
                                        <?php foreach ($post_images as $image): ?>
                                            <!-- slider item -->
                                            <div class="ramdom-slider-item">
                                                <img src="<?php echo base_url() . $image->image_path; ?>"
                                                     alt="<?php echo html_escape($post->title); ?>"
                                                     class="img-responsive"/>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                <?php else: ?>
                                    <?php if (!empty($post->image_big)): ?>
                                        <img src="<?php echo base_url() . html_escape($post->image_big); ?>"
                                             class="img-responsive center-image"
                                             alt="<?php echo html_escape($post->title); ?>"/>
                                    <?php endif; ?>
                                <?php endif; ?>


                            </div>
                            <div class="post-title">
                                <h1 class="title"><?php echo html_escape($post->title); ?></h1>
                            </div>
                            <div class="post-meta">
                                    <span>
                                            <a href="<?php echo base_url() . 'category/' . str_slug($post->category_name) . '/' . $post->category_id; ?>">
                                            <i class="fa fa-folder"></i>
                                                <?php echo html_escape($post->category_name); ?>
                                            </a>
                                    </span>
                                <span><i class="fa fa-calendar"></i> <?php echo nice_date($post->created_at, 'd.m.Y'); ?></span>
                                <span><i class="fa fa-comments"></i>&nbsp;
                                    <?php echo helper_get_comment_count($post->id); ?>
                                    <?php echo html_escape($this->lang->line("meta_comments")); ?>
                                </span>

                                <!--Show if enabled-->
                                <?php if ($settings->show_pageviews == 1) : ?>
                                    <span>
                                        <i class="fa fa-eye"></i>&nbsp;
                                        <?php echo $post->hit; ?>
                                    </span>
                                <?php endif; ?>


                                <!--Add to Reading List-->
                                <?php if (auth_check()) : ?>
                                    <?php if ($is_reading_list == false) : ?>

                                        <?php echo form_open('add-delete-reading-list-post'); ?>
                                        <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">

                                        <button type="submit" class="add-to-reading-list pull-right">
                                            <i class="fa fa-plus-circle"></i>&nbsp;<?php echo html_escape($this->lang->line("btn_add_reading_list")); ?>
                                        </button>
                                        <?php echo form_close(); ?>

                                    <?php else: ?>

                                        <!--Remove from Reading List-->
                                        <?php echo form_open('add-delete-reading-list-post'); ?>
                                        <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">

                                        <button type="submit" class="delete-from-reading-list  pull-right">
                                            <i class="fa fa-minus-circle"></i>&nbsp;
                                            <?php echo html_escape($this->lang->line("btn_delete_reading_list")); ?>
                                        </button>
                                        <?php echo form_close(); ?>

                                    <?php endif; ?>

                                <?php else: ?>

                                    <a href="<?php echo  base_url();?>login" class="add-to-reading-list pull-right">
                                        <i class="fa fa-plus-circle"></i>&nbsp;<?php echo html_escape($this->lang->line("btn_add_reading_list")); ?>
                                    </a>

                                <?php endif; ?>



                            </div>
                            <div class="post-text text-style">

                                <?php echo $post->content; ?>

                                <?php if (!empty($post->optional_url)) : ?>
                                    <br>
                                    <a href="<?php echo html_escape($post->optional_url); ?>"
                                       class="btn btn-success btn-action margin-bottom15"
                                       target="_blank"><?php echo html_escape($settings->optional_url_button_name); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="post-tags">
                                <h2 class="tags-title"><?php echo html_escape($this->lang->line("post_tags")); ?></h2>
                                <ul class="tag-list">
                                    <?php foreach ($post_tags as $tag) : ?>
                                        <li>
                                            <a href="<?php echo base_url() . 'tag/' . html_escape($tag->tag_slug); ?>">
                                                <?php echo html_escape($tag->tag); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="post-share">
                                <!-- Facebook Share Button -->
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo base_url() . 'post/' . html_escape($post->title_slug) . '/' . $post->id; ?>"
                                   class="btn-share share facebook" target="_blank"><i
                                            class="fa fa-facebook"></i><span class="hidden-sm">Facebook</span></a>
                                <!-- Googple Plus Share Button -->
                                <a href="https://plus.google.com/share?url=<?php echo base_url() . 'post/' . html_escape($post->title_slug) . '/' . $post->id; ?>"
                                   class="btn-share share gplus" href="#" target="_blank"><i
                                            class="fa fa-google-plus"></i><span class="hidden-sm">Google+</span></a>
                                <!-- Twitter Share Button -->
                                <a href="https://twitter.com/share?url=<?php echo base_url() . 'post/' . html_escape($post->title_slug) . '/' . $post->id; ?>&amp;text=<?php echo html_escape($post->title); ?>"
                                   class="btn-share share twitter" target="_blank"><i
                                            class="fa fa-twitter"></i><span class="hidden-sm">Twitter</span></a>
                                <!-- LinkedIn Share Button -->
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url() . 'post/' . html_escape($post->title_slug) . '/' . $post->id; ?>"
                                   class="btn-share share linkedin" target="_blank"><i
                                            class="fa fa-linkedin"></i><span class="hidden-sm">Linkedin</span></a>
                            </div>


                            <!-- Ad Space -->
                            <?php if (trim($ads->post_728) != ''): ?>
                                <div class="ads-post ad-block-728">
                                    <div id="ad-space" class="p0">
                                        <div class="ads-728">
                                            <?php echo $ads->post_728; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (trim($ads->post_468) != ''): ?>
                                <div class="ads-post ad-block-468">
                                    <div id="ad-space" class="p0">
                                        <div class="ads-468">
                                            <?php echo $ads->post_468; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (trim($ads->post_234) != ''): ?>
                                <div class="ads-post ad-block-234">
                                    <div id="ad-space" class="p0">
                                        <div class="ads-234">
                                            <?php echo $ads->post_234; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- /.Ad Space -->


                        </div><!--/post-content-->


                        <div class="related-posts">
                            <div class="related-post-title">
                                <h4 class="title"><?php echo html_escape($this->lang->line("title_related_posts")); ?></h4>
                            </div>
                            <div class="row related-posts-row">
                                <ul class="post-list">
                                    <?php foreach ($related_posts as $item): ?>

                                        <li class="col-sm-4 col-xs-12 related-posts-col">
                                            <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                                                <?php if (!empty($item->image_big)): ?>
                                                    <img src="<?php echo base_url() . html_escape($item->image_slider); ?>"
                                                         class="img-responsive"
                                                         alt="<?php echo html_escape($item->title); ?>"/>
                                                <?php endif; ?>
                                            </a>
                                            <h3 class="title">
                                                <a href="<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>">
                                                    <?php echo html_escape(character_limiter($item->title, 70, '...')); ?>
                                                </a>
                                            </h3>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <?php $this->load->view('partials/_comments', ['comments' => $comments, 'comment_count' => $comment_count]); ?>

                        <!--Comment Box-->
                        <div class="leave-reply">
                            <h4 class="leave-reply-title"><?php echo html_escape($this->lang->line("title_leave_reply")); ?></h4>
                            <div class="row">

                                <div class="col-sm-12 leave-reply-body">
                                    <div class="comment-loader-container">
                                        <div class="loader"></div>
                                    </div>

                                    <?php if (auth_check()): ?>
                                        <!-- form make comment -->
                                        <form method="post" id="formC">
                                            <input type="hidden" id="comment_post_id" value="<?php echo $post->id; ?>">
                                            <input type="hidden" id="comment_user_id" value="<?php echo user()->id; ?>">

                                            <div class="form-group margin-top-15">
                                                    <textarea class="form-control" name="comment" id="comment_text"
                                                              maxlength="999"
                                                              placeholder="<?php echo html_escape($this->lang->line("placeholder_comment")); ?>"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="button" id="make-comment"
                                                        class="btn btn-default pull-right btn-action">
                                                    <?php echo html_escape($this->lang->line("btn_submit")); ?>
                                                </button>
                                            </div>
                                        </form><!-- form end -->
                                    <?php else: ?>
                                        <p class="margin-top-30 margin-bottom30">
                                            <?php echo html_escape($this->lang->line("message_login_for_comment")); ?>
                                        </p>

                                    <?php endif; ?>

                                </div>
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

<script>
    var add_comment_url = '<?php echo base_url() . 'add-comment-post'; ?>';
    var delete_comment_url = '<?php echo base_url() . 'delete-comment-post'; ?>';
</script>

