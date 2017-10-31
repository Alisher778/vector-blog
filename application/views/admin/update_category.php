<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Category</h3>
                <br>
                <small>You can update category from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/update-category-post'); ?>

            <input type="hidden" name="category_id" value="<?php echo html_escape($category->id); ?>">

            <div class="box-body">
                <?php $this->load->view('admin/_messages'); ?>

                <div class="form-group">
                    <label class="control-label">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Category Name"
                           value="<?php echo html_escape($category->name); ?>" maxlength="200" required>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>

