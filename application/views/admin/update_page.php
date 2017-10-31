<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Page</h3>
                <br>
                <small>You can update page from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/update-page-post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/_messages'); ?>

                <input type="hidden" value="<?php echo html_escape($page->id); ?>" name="id">

                <?php if ($page->is_custom == 1): ?>
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Page Title"
                               value="<?php echo html_escape($page->title); ?>" required>
                    </div>
                <?php else: ?>

                    <div class="form-group">
                        <label>Title: </label>
                        <label>
                            <?php echo html_escape($page->title); ?>
                        </label>
                    </div>

                <?php endif; ?>

                <div class="form-group">
                    <label>Page Description (Meta Tag)</label>
                    <input type="text" class="form-control" name="page_description"
                           placeholder="Page Description"
                           value="<?php echo html_escape($page->page_description); ?>">
                </div>

                <div class="form-group">
                    <label>Navigation Order</label>
                    <input type="number" class="form-control" name="page_order" placeholder="Order"
                           value="<?php echo html_escape($page->page_order); ?>" min="1" max="999" required
                           style="width: 150px;">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label>Location</label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="location" value="header" id="location_enabled"
                                   class="flat-orange" <?php echo ($page->location == "header") ? 'checked' : ''; ?>>
                            <label for="location_enabled" class="option-label">Header</label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="location" value="footer" id="location_disabled"
                                   class="flat-orange" <?php echo ($page->location == "footer") ? 'checked' : ''; ?>>
                            <label for="location_disabled" class="option-label">Footer</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 col-lang">
                            <label>Show Only to Registered Users</label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="need_auth" value="1" id="need_auth_enabled"
                                   class="flat-orange" <?php echo ($page->need_auth == 1) ? 'checked' : ''; ?>>
                            <label for="need_auth_enabled" class="option-label">Enabled</label>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                            <input type="radio" name="need_auth" value="0" id="need_auth_disabled"
                                   class="flat-orange" <?php echo ($page->need_auth == 0) ? 'checked' : ''; ?>>
                            <label for="need_auth_disabled" class="option-label">Disabled</label>
                        </div>
                    </div>
                </div>


                <?php if ($page->slug != "index"): ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lang">
                                <label>Show Page</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="page_active" value="1" id="page_enabled"
                                       class="flat-orange" <?php echo ($page->page_active == 1) ? 'checked' : ''; ?>>
                                <label for="page_enabled" class="option-label">Enabled</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="page_active" value="0" id="page_disabled"
                                       class="flat-orange" <?php echo ($page->page_active == 0) ? 'checked' : ''; ?>>
                                <label for="page_disabled" class="option-label">Disabled</label>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($page->slug != "index"): ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lang">
                                <label>Show Page Title</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="title_active" value="1" id="title_enabled"
                                       class="flat-orange" <?php echo ($page->title_active == 1) ? 'checked' : ''; ?>>
                                <label for="title_enabled" class="option-label">Enabled</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="title_active" value="0" id="title_disabled"
                                       class="flat-orange" <?php echo ($page->title_active == 0) ? 'checked' : ''; ?>>
                                <label for="title_disabled" class="option-label">Disabled</label>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($page->slug != "index") : ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lang">
                                <label>Show Breadcrumb</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="breadcrumb_active" value="1" id="breadcrumb_enabled"
                                       class="flat-orange" <?php echo ($page->breadcrumb_active == 1) ? 'checked' : ''; ?>>
                                <label for="breadcrumb_enabled" class="option-label">Enabled</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="breadcrumb_active" value="0" id="breadcrumb_disabled"
                                       class="flat-orange" <?php echo ($page->breadcrumb_active == 0) ? 'checked' : ''; ?>>
                                <label for="breadcrumb_disabled" class="option-label">Disabled</label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($page->slug != "index" && $page->slug != "gallery"): ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lang">
                                <label>Show Right Column</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="right_column_active" value="1" id="right_column_enabled"
                                       class="flat-orange" <?php echo ($page->right_column_active == 1) ? 'checked' : ''; ?>>
                                <label for="right_column_enabled" class="option-label">Enabled</label>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 col-lang">
                                <input type="radio" name="right_column_active" value="0" id="right_column_disabled"
                                       class="flat-orange" <?php echo ($page->right_column_active == 0) ? 'checked' : ''; ?>>
                                <label for="right_column_disabled" class="option-label">Disabled</label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($page->is_custom == 1): ?>
                    <div class="form-group">
                        <textarea id="ckEditor" class="form-control" name="page_content"
                                  placeholder="Content" required><?php echo $page->page_content; ?></textarea>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px;">Save Changes</button>

                <?php if ($page->is_custom): ?>
                    <a class="btn btn-danger pull-right"
                       onclick="deletePage('<?php echo html_escape($page->id); ?>');">Delete Page</a>
                <?php endif; ?>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>


<script>
    var delete_page_url = '<?php echo base_url(); ?>admin/delete-page-post';
</script>
