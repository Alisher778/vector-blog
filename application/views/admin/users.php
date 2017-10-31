<div class="box">
    <div class="box-header">
        <div class="left">
            <h3 class="box-title">Users</h3>
            <br>
            <small class="pull-left">You can see the registered users here.</small>
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
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date</th>
                            <th class="max-width-120">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo html_escape($user->id); ?></td>
                                <td>
                                    <?php if (!empty($user->avatar)): ?>
                                        <img src="<?php echo base_url(); ?><?php echo html_escape($user->avatar); ?>"
                                             alt="user" class="img-responsive"
                                             style="width: 70px; border-radius: 100%;">
                                    <?php else: ?>
                                        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                             class="img-responsive"
                                             style="width: 70px; border-radius: 100%;">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo html_escape($user->username); ?></td>
                                <td><?php echo html_escape($user->email); ?></td>
                                <td><?php echo html_escape($user->role); ?></td>
                                <td><?php echo nice_date($user->created_at, 'd.m.Y'); ?></td>

                                <td>
                                    <!-- form delete user -->
                                    <?php echo form_open('admin/delete-user-post'); ?>

                                    <input type="hidden" name="user_id" value="<?php echo html_escape($user->id); ?>">

                                    <div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle btn-select-option" type="button"
                                                data-toggle="dropdown">Select an option
                                            <span class="caret"></span></button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="p0">
                                                    <button type="button" class="btn-list-button" data-toggle="modal"
                                                            data-target="#myModal"
                                                            onclick="$('#modal_user_id').val('<?php echo html_escape($user->id); ?>');">
                                                        <i class="fa fa-user i-edit"></i>Change User Role
                                                    </button>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="p0">
                                                    <button type="submit" class="btn-list-button"
                                                            onclick="return confirm('Are you sure you want to delete this user?');">
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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change User Role</h4>
            </div>
            <?php echo form_open('admin/change-user-role-post'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Select New Role</label>
                    <div class="row">

                        <input type="hidden" name="user_id" id="modal_user_id" value="">

                        <div class="col-sm-4">
                            <input type="radio" name="role" value="admin" id="role_admin"
                                   class="flat-orange" required>
                            <label for="role_admin" class="option-label">Admin</label>

                        </div>
                        <div class="col-sm-4">
                            <input type="radio" name="role" value="editor" id="role_editor"
                                   class="flat-orange" required>
                            <label for="role_editor" class="option-label">Editor</label>

                        </div>
                        <div class="col-sm-4">
                            <input type="radio" name="role" value="user" id="role_user"
                                   class="flat-orange" required>
                            <label for="role_user" class="option-label">User</label>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

            <?php echo form_close(); ?><!-- form end -->
        </div>

    </div>
</div>