<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo html_escape($post_count); ?></h3>
                <p>Posts</p>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/posts" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo html_escape($category_count); ?></h3>
                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-folder-open"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/categories" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->

    <?php if (is_admin()): ?>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo html_escape($comment_count); ?></h3>
                    <p>Comments</p>
                </div>
                <div class="icon">
                    <i class="ion-chatbubbles"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/comments" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo html_escape($user_count); ?></h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo base_url(); ?>admin/users" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    <?php endif; ?>
</div><!-- /.row -->

<?php if (is_admin()): ?>
<div class="row">
    <div class="col-sm-12 no-padding">

            <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Last Comments</h3>
                        <br>
                        <small>You can see last comments here</small>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                            </button>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body index-table">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th style="width: 60%">Comment</th>
                                    <th style="min-width: 13%">Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($last_comments as $item): ?>

                                    <tr>
                                        <td> <?php echo html_escape($item->id); ?> </td>
                                        <td>
                                            <?php echo html_escape($item->username); ?>
                                        </td>
                                        <td style="width: 60%" class="break-word">
                                            <?php echo html_escape($item->comment); ?>
                                        </td>
                                        <td style="min-width: 13%">
                                            <?php echo nice_date($item->created_at, 'd.m.Y'); ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                    <div class="box-footer clearfix">
                        <a href="<?php echo base_url(); ?>admin/comments"
                           class="btn btn-sm btn-default btn-flat pull-right">View All Comments</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Last Contact Messages</h3>
                        <br>
                        <small>You can see last contact messages here</small>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                            </button>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body index-table">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th style="width: 60%">Message</th>
                                    <th style="min-width: 13%">Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($last_contacts as $item): ?>

                                    <tr>
                                        <td>
                                            <?php echo html_escape($item->id); ?>
                                        </td>
                                        <td>
                                            <?php echo html_escape($item->name); ?>
                                        </td>
                                        <td style="width: 60%" class="break-word">
                                            <?php echo html_escape($item->message); ?>
                                        </td>
                                        <td style="min-width: 13%">
                                            <?php echo nice_date($item->created_at, 'd.m.Y'); ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                    <div class="box-footer clearfix">
                        <a href="<?php echo base_url(); ?>admin/contact-messages"
                           class="btn btn-sm btn-default btn-flat pull-right">View All Contact Messages</a>
                    </div>
                </div>
            </div>

    </div>


</div>
<!-- /.row -->

<div class="row">
    <div class="col-sm-12 no-padding margin-bottom-20">
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Users</h3>
                    <br>
                    <small>You can see last registered users here</small>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">

                        <?php foreach ($last_users as $item) : ?>
                            <li>
                                <a>
                                    <?php if (!empty(get_user($item->id)->avatar)): ?>
                                        <img src="<?php echo base_url() . html_escape($item->avatar); ?>" alt="user"
                                             class="img-responsive">
                                    <?php else: ?>
                                        <img src="<?php echo base_url(); ?>assets/img/user.png" alt="user"
                                             class="img-responsive">
                                    <?php endif; ?>
                                </a>
                                <a class="users-list-name"><?php echo html_escape($item->username); ?></a>
                                <span class="users-list-date"><?php echo nice_date($item->created_at, 'd.m.Y'); ?></span>
                            </li>

                        <?php endforeach; ?>

                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="<?php echo base_url(); ?>admin/users" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
</div>
<!-- /.row -->
<?php endif; ?>