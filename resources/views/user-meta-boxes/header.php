<div id="poststuff">
    <div class="postbox-container">
        <div class="meta-box-sortables">
            <div id="{{ $id }}" class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle"><?php echo $title ?? ''; ?></h2>
                </div>
                <?php if (isset($navigation)) { include($navigation); } ?>
                <div class="inside form-table w-auto">