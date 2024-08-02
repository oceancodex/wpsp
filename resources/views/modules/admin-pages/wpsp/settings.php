<form method="POST">
    <input name="action" value="save_settings" type="hidden"/>
    <div id="poststuff" class="row gx-2">
        <div class="col">
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox">

                    <div class="postbox-header">
                        <h2 class="hndle ui-sortable-handle"><?php echo wpsp_trans('Settings', true) ?></h2>
                        <div class="handle-actions">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="toggle-indicator"></span>
                            </button>
                        </div>
                    </div>

                    <div class="inside form-table w-auto">

                        <div class="input-group mt-2 mb-3">
                            <label for="settings[setting_1]">
                                <?php echo wpsp_trans('Title', true) ?>:
                                <input type="text" id="settings[setting_1]" name="settings[setting_1]" class="w-100 mt-2" value="<?php echo $settings['setting_1'] ?? '' ?>"/>
                            </label>
                        </div>

                        <div class="input-group">
                            <label for="settings[setting_2]">
                                <?php echo wpsp_trans('Title', true) ?>:
                                <input type="text" id="settings[setting_2]" name="settings[setting_2]" class="w-100 mt-2" value="<?php echo $settings['setting_2'] ?? '' ?>"/>
                            </label>
                        </div>

                    </div>

                </div>
                <button type="submit" class="button button-primary"><?php echo wpsp_trans('Save changes', true) ?></button>
            </div>
        </div>
    </div>
</form>