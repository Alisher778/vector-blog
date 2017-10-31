<div class="comments" id="comment-result">
    <div class="comments-title">
        <h4 class="title"><?php echo html_escape($this->lang->line("title_comments")); ?>
            ( <?php echo $comment_count; ?> )</h4>
    </div>
    <div class="row">
        <div class="col-sm-12 comments-body">
            <ul class="comment-lists">

                <?php foreach ($comments as $item) : ?>
                    <?php if (!is_null(get_user($item->user_id))) : ?>
                        <li>
                            <div class="row m0">
                                <div class="col-sm-1 col-xs-1 comment-left p0">

                                    <?php if (!empty(get_user($item->user_id)->avatar)): ?>
                                        <img src="<?php echo base_url() . html_escape(get_user($item->user_id)->avatar); ?>"
                                             alt="user" class="img-responsive">
                                    <?php else: ?>
                                        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                             class="img-responsive">
                                    <?php endif; ?>

                                </div><!--/comment-left -->

                                <div class="col-sm-11 col-xs-11 comment-right">
                                    <h5 class="user-name"><?php echo html_escape($item->username); ?></h5>
                                    <p class="comment-text"><?php echo html_escape($item->comment); ?></p>
                                    <div class="comment-meta">
                                        <small class="comment-date"><?php echo nice_date($item->created_at, 'd.m.Y'); ?>
                                            &nbsp;&nbsp;<?php echo nice_date($item->created_at, 'H:i'); ?></small>

                                        <!--Check login-->
                                        <?php if (auth_check()): ?>
                                            <button class="btn-comment-reply"
                                                    onclick="return showSubCommentBox('<?php echo $item->id; ?>');">
                                                <i class="fa fa-reply"></i>&nbsp;<?php echo html_escape($this->lang->line("btn_reply")); ?>
                                            </button>

                                            <?php if (user()->id == $item->user_id): ?>
                                                <button type="button"
                                                        onclick="deleteComment('<?php echo html_escape($this->lang->line("text_warning")); ?>',
                                                                '<?php echo html_escape($this->lang->line("message_comment_delete")); ?>',
                                                                '<?php echo $item->id; ?>' );"
                                                        class="btn-comment-delete">
                                                    <i class="fa fa-trash"></i>&nbsp;<?php echo html_escape($this->lang->line("btn_delete")); ?>
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>


                                    <!-- make sub comment block -->
                                    <div id="sub_comment_<?php echo $item->id; ?>"
                                         class="col-sm-12 leave-reply-body leave-reply-sub-body">
                                        <div class="row">
                                            <div class="sub-comment-loader-container">
                                                <div class="loader"></div>
                                            </div>
                                            <!-- form make  sub comment -->
                                            <form method="post">
                                                <input type="hidden" id="comment_parent_id_<?php echo $item->id; ?>"
                                                       value="<?php echo $item->id; ?>">
                                                <div class="form-group">
                                    <textarea class="form-control" name="comment" id="comment_text_<?php echo $item->id; ?>"
                                              placeholder="<?php echo html_escape($this->lang->line("placeholder_comment")); ?>"
                                              maxlength="999"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" onclick="return makeSubComment('<?php echo $item->id; ?>')"
                                                            class="btn btn-default pull-right btn-action">
                                                        <?php echo html_escape($this->lang->line("btn_submit")); ?>
                                                    </button>
                                                </div>

                                            </form><!-- form end -->
                                        </div>
                                    </div> <!--/make sub comment block -->


                                    <!--Print sub comments-->
                                    <?php foreach (helper_get_subcomments($item->id) as $sub_comment) : ?>
                                        <?php if (!is_null(get_user($sub_comment->user_id))): ?>
                                            <div class="row m0 item-sub-comment">

                                                <div class="col-sm-1 col-xs-1 p0 comment-left">
                                                    <?php if (!empty(get_user($sub_comment->user_id)->avatar)): ?>
                                                        <img src="<?php echo base_url() . html_escape(get_user($sub_comment->user_id)->avatar); ?>"
                                                             alt="user" class="img-responsive">
                                                    <?php else: ?>
                                                        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                                             class="img-responsive">
                                                    <?php endif; ?>
                                                </div><!--/comment-left -->


                                                <div class="col-sm-11 col-xs-11 comment-right">
                                                    <h5 class="user-name"><?php echo html_escape($sub_comment->username); ?></h5>
                                                    <p class="comment-text"><?php echo html_escape($sub_comment->comment); ?></p>
                                                    <div class="comment-meta">
                                                        <small class="comment-date"><?php echo nice_date($sub_comment->created_at, 'd.m.Y'); ?>
                                                            &nbsp;&nbsp;<?php echo nice_date($sub_comment->created_at, 'H:i'); ?></small>

                                                        <?php if (auth_check()): ?>
                                                            <?php if (user()->id == $sub_comment->user_id): ?>
                                                                <button type="button"
                                                                        onclick="deleteComment('<?php echo html_escape($this->lang->line("text_warning")); ?>',
                                                                                '<?php echo html_escape($this->lang->line("message_comment_delete")); ?>',
                                                                                '<?php echo $sub_comment->id; ?>' );"
                                                                        class="btn-comment-delete">
                                                                    <i class="fa fa-trash"></i>&nbsp;<?php echo html_escape($this->lang->line("btn_delete")); ?>
                                                                </button>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div><!--/comment-right -->

                                            </div><!--/row -->
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div><!--/item-sub-comment -->


                            </div><!--/row -->
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>
