<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-1">
        <div class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <div id="<?php echo $id ?? ''; ?>" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle"><?php echo $title ?? ''; ?></h2>
                    </div>
                    <?php if (isset($navigation)) { include($navigation); } ?>
                    <div class="inside form-table w-auto">