<div class="row">
    <div class="col-lg-11 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ad Spaces</h3>
                <br>
                <small>You can update ad spaces from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/ads-post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/_messages'); ?>

                <div class="form-group">
                    <h4 class="text-center">Index Page Ad Space</h4>
                    <label class="control-label">728x90</label>
                    <textarea class="form-control text-area" name="home_728"
                              placeholder="Paste Ad Code"><?php echo $ads->home_728; ?></textarea>
                    <br>

                    <label class="control-label">468x60</label>


                    <textarea class="form-control text-area" name="home_468"
                              placeholder="Paste Ad Code"><?php echo $ads->home_468; ?></textarea>

                    <br>
                    <label class="control-label">234x60</label>


                    <textarea class="form-control text-area" name="home_234"
                              placeholder="Paste Ad Code"><?php echo $ads->home_234; ?></textarea>
                    <br>
                </div>

                <div class="form-group">
                    <h4 class="text-center">Post Detail Page Ad Space</h4>
                    <label class="control-label">728x90</label>
                    <textarea class="form-control text-area" name="post_728"
                              placeholder="Paste Ad Code"><?php echo $ads->post_728; ?></textarea>
                    <br>

                    <label class="control-label">468x60</label>
                    <textarea class="form-control text-area" name="post_468"
                              placeholder="Paste Ad Code"><?php echo $ads->post_468; ?></textarea>
                    <br>

                    <label class="control-label">234x60</label>
                    <textarea class="form-control text-area" name="post_234"
                              placeholder="Paste Ad Code"><?php echo $ads->post_234; ?></textarea>
                    <br>

                </div>

                <div class="form-group">
                    <h4 class="text-center">Category Page Ad Space</h4>
                    <label class="control-label">728x90</label>
                    <textarea class="form-control text-area" name="category_728"
                              placeholder="Paste Ad Code"><?php echo $ads->category_728; ?></textarea>
                    <br>

                    <label class="control-label">468x60</label>
                    <textarea class="form-control text-area" name="category_468"
                              placeholder="Paste Ad Code"><?php echo $ads->category_468; ?></textarea>
                    <br>

                    <label class="control-label">234x60</label>
                    <textarea class="form-control text-area" name="category_234"
                              placeholder="Paste Ad Code"><?php echo $ads->category_234; ?></textarea>
                    <br>

                </div>

                <div class="form-group">
                    <h4 class="text-center">Tag Page Ad Space</h4>
                    <label class="control-label">728x90</label>
                    <textarea class="form-control text-area" name="tag_728"
                              placeholder="Paste Ad Code"><?php echo $ads->tag_728; ?></textarea>
                    <br>

                    <label class="control-label">468x60</label>
                    <textarea class="form-control text-area" name="tag_468"
                              placeholder="Paste Ad Code"><?php echo $ads->tag_468; ?></textarea>
                    <br>

                    <label class="control-label">234x60</label>
                    <textarea class="form-control text-area" name="tag_234"
                              placeholder="Paste Ad Code"><?php echo $ads->tag_234; ?></textarea>
                    <br>

                </div>

                <div class="form-group">
                    <h4 class="text-center">Search Page Ad Space</h4>
                    <label class="control-label">728x90</label>
                    <textarea class="form-control text-area" name="search_728"
                              placeholder="Paste Ad Code"><?php echo $ads->search_728; ?></textarea>
                    <br>


                    <label class="control-label">468x60</label>
                    <textarea class="form-control text-area" name="search_468"
                              placeholder="Paste Ad Code"><?php echo $ads->search_468; ?></textarea>
                    <br>

                    <label class="control-label">234x60</label>
                    <textarea class="form-control text-area" name="search_234"
                              placeholder="Paste Ad Code"><?php echo $ads->search_234; ?></textarea>
                    <br>

                </div>

                <div class="form-group">
                    <h4 class="text-center">Sidebar Ad Space</h4>
                    <label class="control-label">300x250</label>
                    <textarea class="form-control text-area" name="sidebar_300"
                              placeholder="Paste Ad Code"><?php echo $ads->sidebar_300; ?></textarea>
                    <br>

                    <label class="control-label">234x60</label>
                    <textarea class="form-control text-area" name="sidebar_234"
                              placeholder="Paste Ad Code"><?php echo $ads->sidebar_234; ?></textarea>
                    <br>

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
