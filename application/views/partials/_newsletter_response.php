<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('errors')): ?>
    <div class="form-group">
        <div class="error-message">
            <?php echo $this->session->flashdata('errors'); ?>
        </div>
    </div>
<?php endif; ?>


if (isset($reponse)) {

    if ($reponse == 'success') {
        echo '<span class="text-success">' . $this->lang->line("message_newsletter_success") . '</span>';
    }

    if ($reponse == 'error') {
        echo '<span class="text-danger">' . $this->lang->line("message_newsletter_error") . '</span>';
    }

}
?>

<input type="hidden" id="news_ajax_csrf_hash" value="<?php echo isset($csrf_hash) ? $csrf_hash : ''; ?>">

