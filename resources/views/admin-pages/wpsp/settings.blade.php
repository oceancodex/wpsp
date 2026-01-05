@extends('admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.settings') }}
@endsection

@section('content')
    <form method="POST">
        <input name="action" value="save_settings" type="hidden"/>
	    <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
	    <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
        <div id="poststuff">
            <div id="post-body" class="columns-2">
                <div id="postbox-container-1" class="postbox-container">
                    <div id="side-sortables" class="meta-box-sortables ui-sortable">
                        <div id="submitdiv" class="postbox">
                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">{{ wpsp_trans('messages.save_changes') }}</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handle-order-higher" aria-disabled="true" aria-describedby="submitdiv-handle-order-higher-description">
                                        <span class="screen-reader-text">Di chuyển lên</span>
                                        <span class="order-higher-indicator" aria-hidden="true"></span>
                                    </button>
                                    <span class="hidden" id="submitdiv-handle-order-higher-description">Chuyển Xuất bản lên trên</span>

                                    <button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="submitdiv-handle-order-lower-description">
                                        <span class="screen-reader-text">Di chuyển xuống</span>
                                        <span class="order-lower-indicator" aria-hidden="true"></span>
                                    </button>
                                    <span class="hidden" id="submitdiv-handle-order-lower-description">Chuyển Xuất bản xuống dưới</span>

                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="screen-reader-text">Chuyển đổi bảng điều khiển: Xuất bản</span>
                                        <span class="toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="inside">
                                <div class="p-2 text-end bg-light">
                                    <button type="submit" class="button button-primary">{{ wpsp_trans('messages.save_changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="postbox-container-2" class="postbox-container">
                    @adminpagemetaboxes('kaka', 'keke', ['koko' => 'kekeke'])
                    xxxxxx
                    @endadminpagemetaboxes
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable" style="min-height: 200px;">
                        <div id="forminputs" class="postbox">
                            <div class="postbox-header">
                                <h2 class="hndle ui-sortable-handle">Cài đặt</h2>
                                <div class="handle-actions">
                                    <button type="button" class="handle-order-higher" aria-disabled="true" aria-describedby="submitdiv-handle-order-higher-description">
                                        <span class="screen-reader-text">Di chuyển lên</span>
                                        <span class="order-higher-indicator" aria-hidden="true"></span>
                                    </button>

                                    <button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="submitdiv-handle-order-lower-description">
                                        <span class="screen-reader-text">Di chuyển xuống</span>
                                        <span class="order-lower-indicator" aria-hidden="true"></span>
                                    </button>

                                    <button type="button" class="handlediv" aria-expanded="true">
                                        <span class="screen-reader-text">Chuyển đổi bảng điều khiển: Xuất bản</span>
                                        <span class="toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="inside">
                                <div class="input-group mt-2">
                                    <label for="test">
                                        Test:
                                        <input type="text" id="test" name="test" class="w-100 mt-1" value=""/>
                                    </label>
                                </div>

                                <div class="input-group mt-3">
                                    <label for="settings[setting_1]">
                                        {{ wpsp_trans('messages.title') }}:
                                        <input type="text" id="settings[setting_1]" name="settings[setting_1]" class="w-100 mt-1" value="{{ $settings['setting_1'] ?? '' }}"/>
                                    </label>
                                </div>

                                <div class="input-group mt-3">
                                    <label for="settings[setting_2]">
                                        {{ wpsp_trans('messages.title') }}:
                                        <input type="text" id="settings[setting_2]" name="settings[setting_2]" class="w-100 mt-1" value="{{ $settings['setting_2'] ?? '' }}"/>
                                    </label>
                                </div>

                                <div class="input-group">
                                    <label for="settings[logo]">
                                        Logo:
                                        <div>
                                            <img id="preview_logo" style="max-width:200px; display:block; margin-top:10px;" alt="" src="{{ $settings['logo'] ?? '' }}"/>
                                            <br/>
                                            <input type="text"
                                                   name="settings[logo]"
                                                   id="settings[logo]"
                                                   value="{{ $settings['logo'] ?? '' }}"
                                                   class="mb-2"
                                                   style="max-width: 600px; width: 100%; display: block;"/>
                                            <button class="button" type="button" id="upload_logo_button">Chọn ảnh</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('after-wrap')
    @php
        wp_enqueue_media();
    @endphp

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
@endsection