<x-admin-pages.admin-page-meta-box id="inputsdiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Cài đặt</x-slot:title>
    <x-slot:content>
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
    </x-slot:content>
</x-admin-pages.admin-page-meta-box>