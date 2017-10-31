<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Font Options</h3>
                <br>
                <small>You can change fonts from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/font-options-post'); ?>
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/_messages'); ?>

                <div class="form-group">
                    <label class="label-sitemap">Primary Font </label>
                    <select name="primary_font" class="form-control font-select">
                        <?php foreach ($fonts as $key => $value): ?>
                            <option value="<?php echo $key; ?>" <?php echo ($primary_font == $key) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-sitemap">Secondary Font </label>
                    <select name="secondary_font" class="form-control font-select">
                        <?php foreach ($fonts as $key => $value): ?>
                            <option value="<?php echo $key; ?>" <?php echo ($secondary_font == $key) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- /.box-body -->
                <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                    <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                </div>
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>

