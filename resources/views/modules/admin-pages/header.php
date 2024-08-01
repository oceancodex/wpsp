<div class="wrap">
    <h1><?php echo $title ?? ''; ?></h1>
    <?php echo $notice ?? '' ?>
    <?php if (isset($navigation)) { include($navigation); } ?>
    <div class="wpsp-admin-page-content">