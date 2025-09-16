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
                                <input type="text" id="settings[setting_1]" name="settings[setting_1]" class="w-100 mt-1" value="<?php echo $settings['setting_1'] ?? '' ?>"/>
                            </label>
                        </div>

                        <div class="input-group mt-2 mb-3">
                            <label for="settings[setting_2]">
                                <?php echo wpsp_trans('Title', true) ?>:
                                <input type="text" id="settings[setting_2]" name="settings[setting_2]" class="w-100 mt-1" value="<?php echo $settings['setting_2'] ?? '' ?>"/>
                            </label>
                        </div>

                        <div class="input-group">
                            <label for="settings[logo]">
                                Logo:
                                <div>
                                    <img id="preview_logo" style="max-width:200px; display:block; margin-top:10px;" alt="" src="<?php echo $settings['logo'] ?? '' ?>"/>
                                    <br/>
                                    <input type="text"
                                           name="settings[logo]"
                                           id="settings[logo]"
                                           value="<?php echo $settings['logo'] ?? '' ?>"
                                           class="mb-2"
                                           style="max-width: 600px; width: 100%; display: block;"/>
                                    <button class="button" type="button" id="upload_logo_button">Chọn ảnh</button>
                                </div>
                            </label>
                        </div>

                    </div>

                </div>
                <button type="submit" class="button button-primary"><?php echo wpsp_trans('Save changes', true) ?></button>
            </div>
        </div>
    </div>
</form>

<?php
    wp_enqueue_media();
?>

<script>
	jQuery(document).ready(function ($) {
		let frame;
		$('#upload_logo_button').on('click', function (e) {
			e.preventDefault();

			if (frame) {
				frame.open();
				return;
			}

			frame = wp.media({
				title: 'Chọn hoặc upload ảnh',
				button: { text: 'Sử dụng ảnh này' },
				multiple: false
			});

			frame.on('select', function () {
				const attachment = frame.state().get('selection').first().toJSON();
				$('input[name="settings[logo]"]').val(attachment.url);
				$('#preview_logo').attr('src', attachment.url);
			});

			frame.open();
		});
	});
</script>
