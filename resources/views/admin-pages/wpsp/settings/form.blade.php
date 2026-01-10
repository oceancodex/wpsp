<div id="inputsdiv" class="postbox @if(isset($metaboxes['closed']['inputsdiv'])) closed @endif">
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