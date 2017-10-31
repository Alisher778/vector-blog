<div class="box">
    <div class="box-header">
        <div class="left">
            <h3 class="box-title">Posts</h3>
            <br>
            <small class="pull-left">You can see posts here.</small>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Visibility</th>
                            <th>Slider</th>
                            <th style="max-width: 40px;">Slider Order</th>
                            <th>Date</th>
                            <th class="max-width-120">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($posts as $item): ?>
                            <tr>
                                <td><?php echo html_escape($item->id); ?></td>
                                <td>
                                    <img src="<?php echo base_url() . html_escape($item->image_small); ?>" alt="">
                                </td>
                                <td class="break-word">
                                    <?php echo html_escape($item->title); ?>
                                </td>
                                <td>
                                    <?php echo html_escape($item->category_name); ?>
                                </td>
                                <td>
                                    <?php if ($item->visibility == 0): ?>
                                        <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                    <?php else: ?>
                                        <label class="label label-success"><i class="fa fa-eye"></i></label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($item->is_slider): ?>
                                        <label class="label label-success">Yes</label>
                                    <?php else: ?>
                                        <label class="label label-danger">No</label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($item->is_slider): ?>

                                        <?php echo form_open('admin/post-slider-order-post'); ?>
                                        <div class="slider-order">
                                            <div class="slider-order-left">
                                                <input type="hidden" name="id"
                                                       value="<?php echo html_escape($item->id); ?>">
                                                <input type="number" name="slider_order" class="form-control"
                                                       value="<?php echo html_escape($item->slider_order); ?>">
                                            </div>
                                            <div class="slider-order-right">
                                                <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo nice_date($item->created_at, 'd.m.Y'); ?></td>

                                <td>
                                    <!-- form delete user -->
                                    <?php echo form_open('admin/post-options-post'); ?>

                                    <input type="hidden" name="post_id" value="<?php echo html_escape($item->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle btn-select-option"
                                                type="button" data-toggle="dropdown">Select an option
                                            <span class="caret"></span></button>

                                        <ul class="dropdown-menu pull-right options-list">
                                            <?php if ($item->is_slider): ?>
                                                <li>
                                                    <a class="p0">
                                                        <button type="submit" name="option" value="add_delete_slider"
                                                                class="btn-list-button">
                                                            <i class="fa fa-minus"></i>Remove From Slider
                                                        </button>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a class="p0">
                                                        <button type="submit" name="option" value="add_delete_slider"
                                                                class="btn-list-button">
                                                            <i class="fa fa-plus"></i>Add to Slider
                                                        </button>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <li>
                                                <a href="<?php echo base_url(); ?>admin/update-post/<?php echo html_escape($item->id); ?>">
                                                    <i class="fa fa-edit i-edit"></i>Edit</a></li>
                                            <li>
                                                <a class="p0">
                                                    <button type="submit" name="option" value="delete"
                                                            class="btn-list-button"
                                                            onclick="return confirm('Are you sure you want to delete this post?');">
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