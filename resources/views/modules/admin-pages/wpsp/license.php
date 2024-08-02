<form method="POST">
    <input name="action" value="save_license_key" type="hidden"/>
    <div id="poststuff" class="row gx-2">
        <div class="col">
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle ui-sortable-handle"><?php echo $funcs->_trans('License key', true) ?></h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="toggle-indicator"></span>
                            </button>
                        </div>
                    </div>
                    <div class="inside">
                        <label class="screen-reader-text" for="settings[license_key]"><?php echo $funcs->_trans('messages.license_key') ?></label>
                        <input type="text" name="settings[license_key]" id="settings[license_key]" value="<?php echo $settings['license_key'] ?? '' ?>" style="margin-top: 5px; width: 100%;" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx"/>
                    </div>
                </div>
                <button type="submit" class="button button-primary"><?php echo $funcs->_trans('Save changes', true) ?></button>
            </div>
        </div>
    </div>
</form>