<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Seo Options</h3>
                <br>
                <small>You can generate a sitemap.xml from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/seo-tools-post'); ?>
            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/_messages'); ?>

                <div class="form-group">
                    <label class="control-label"> Site Title </label>
                    <input type="text" class="form-control" name="site_title"
                           placeholder="Site title" value="<?php echo html_escape($settings->site_title); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"> Home Page Title </label>
                    <input type="text" class="form-control" name="home_title"
                           placeholder="Home page title" value="<?php echo html_escape($settings->home_title); ?>">
                </div>

                <div class="form-group">
                    <label class="control-label"> Site Keywords </label>
                    <textarea class="form-control text-area" name="site_keywords"
                              placeholder="Site Keywords"><?php echo html_escape($settings->site_keywords); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="control-label">Google Analytics</label>
                    <textarea class="form-control text-area" name="google_analytics"
                              placeholder="Paste Google Analytics Code"
                              style="min-height: 140px;"><?php echo html_escape($settings->google_analytics); ?></textarea>
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

    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Generate Sitemap</h3>
                <br>
                <small>You can generate a sitemap.xml from this form</small>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('admin/generate-sitemap-post'); ?>
            <div class="box-body">

                <div class="form-group">
                    <label class="label-sitemap">Frequency</label>
                    <small class="small-sitemap">This value indicates how frequently the content at a particular URL is likely to change</small>

                    <select name="frequency" class="form-control">
                        <option value="none">None</option>
                        <option value="always">Always</option>
                        <option value="hourly">Hourly</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly" selected>Monthly</option>
                        <option value="yearly">Yearly</option>
                        <option value="never">Never</option>
                    </select>

                </div>

                <div class="form-group">
                    <label class="label-sitemap">Last Modification</label>
                    <small class="small-sitemap">The time the URL was last modified</small>
                    <div class="form-radio">
                        <input type="radio" name="last_modification" value="none" class="flat-orange"> <span>None</span>
                    </div>

                    <div class="form-radio">
                        <input type="radio" name="last_modification" value="server_response" class="flat-orange" checked> <span>Server's Response</span>
                    </div>

                    <div class="form-radio">
                        <input type="radio" name="last_modification" value="custom" class="flat-orange">
                        <span> Use this date/time: </span>
                        <input type="text" class="form-control input-custom-time" name="lastmod_time" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-sitemap">Priority</label>
                    <small class="small-sitemap">The priority of a particular URL relative to other pages on the same site</small>
                    <div class="form-radio">
                        <input type="radio" name="priority" value="none" class="flat-orange"> <span>None</span>
                    </div>

                    <div class="form-radio">
                        <input type="radio" name="priority" value="automatically" class="flat-orange" checked> <span>Automatically Calculated Priority</span>
                    </div>

                </div>

                <!-- /.box-body -->
                <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                    <button type="submit" class="btn btn-primary pull-right">Generate</button>
                </div>
                <!-- /.box-footer -->

                <?php echo form_close(); ?><!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</div>

