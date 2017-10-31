<div class="box">
    <div class="box-header">
        <div class="left">
            <h3 class="box-title">Comments</h3>
            <br>
            <small class="pull-left">You can see the comments here.</small>
        </div>
    </div><!-- /.box-header -->

    <!-- include message block -->
    <div class="col-sm-12">
        <?php $this->load->view('admin/_messages'); ?>
    </div>


    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable" id="cs_datatable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th width="20">Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th style="min-width: 20%">Post</th>
                            <th style="min-width: 10%">Date</th>
                            <th class="max-width-120">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($comments as $item): ?>
                            <tr>
                                <td><?php echo html_escape($item->id); ?></td>
                                <td><?php echo html_escape($item->username); ?></td>
                                <td><?php echo html_escape($item->user_email); ?></td>
                                <td class="break-word"><?php echo html_escape($item->comment); ?></td>
                                <td><?php echo html_escape($item->post_title); ?></td>
                                <td><?php echo nice_date($item->created_at, 'd.m.Y'); ?></td>

                                <td>
                                    <!-- form delete comment-->
                                    <?php echo form_open('admin/delete-comment-post'); ?>

                                    <input type="hidden" name="id" value="<?php echo html_escape($item->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle btn-select-option"
                                                type="button"
                                                data-toggle="dropdown">Select an option
                                            <span class="caret"></span></button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="p0">
                                                    <button type="submit" class="btn-list-button"
                                                            onclick="return confirm('Are you sure you want to delete this comment?');">
                                                        <i class="fa fa-trash i-delete"></i>Delete
                                                    </button>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                    <?php echo form_close(); ?><!-- form end -->

                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>
