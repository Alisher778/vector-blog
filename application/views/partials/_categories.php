<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--Partial: Categories-->
<div class="widget-title">
    <h4 class="title"><?php echo html_escape($this->lang->line("title_categories")); ?></h4>
</div>
<div class="col-sm-12 widget-body">
    <div class="row">
        <ul class="widget-list w-category-list">

            <!--List all categories-->
            <?php foreach($categories as $item):?>
                <li>
                    <a href="<?php echo base_url() . 'category/' . str_slug($item->name) . '/' . $item->id; ?>"><?php echo html_escape($item->name); ?></a><span>(<?php echo helper_get_category_post_count($item->id); ?>)</span>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>
