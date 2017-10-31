<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--social share-->
<ul class="post-social pull-left">
    <li>
        <!-- Facebook Share Button -->
        <a href="http://www.facebook.com/sharer.php?u=<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>" class="btn-share share facebook" target="_blank"><i class="fa fa-facebook"></i></a>
    </li>

    <li>
        <!-- Googple Plus Share Button -->
        <a href="https://plus.google.com/share?url=<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>" class="btn-share share gplus" href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
    </li>

    <li>
        <!-- Twitter Share Button -->
        <a href="https://twitter.com/share?url=<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>&amp;text=<?php echo html_escape($item->title);?>" class="btn-share share twitter" target="_blank"><i class="fa fa-twitter"></i></a>
    </li>
    <li>
        <!-- LinkedIn Share Button -->
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url() . 'post/' . html_escape($item->title_slug) . '/' . $item->id; ?>" class="btn-share share linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
    </li>

</ul>