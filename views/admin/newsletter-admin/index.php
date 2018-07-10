<?php
$pageTitle = __('Newsletter administation');
echo head(array('title' => $pageTitle, 'bodyclass' => 'newsletter administration'));
?>

<h1><?php echo $pageTitle;?></h1>

<p><?php echo __("Download CSV file of newsletter subscriptions <strong>(coma separated)</strong>") ?> : </p>
<a href="<?php echo url('newsletter/download') ?>" class="button"><?php echo _("Download") ?></a>

<?php fire_plugin_hook('public_items_browse', array('view' => $this)); ?>

<?php echo foot(); ?>
