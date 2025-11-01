<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo $title ?? ''; ?></h1>
    <?php if (isset($afterTitle)) { echo $afterTitle; } ?>
    <hr class="wp-header-end">
    <?php global $notice; echo $notice ?? '' ?>
    <?php if (isset($navigation)) { include($navigation); } ?>
    <div class="wpsp-admin-page-content">