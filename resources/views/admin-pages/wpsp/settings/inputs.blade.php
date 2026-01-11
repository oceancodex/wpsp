<x-admin-pages.admin-page-meta-box id="inputsdiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Cài đặt</x-slot:title>
    <x-slot:content>
        <div class="input-group mt-2">
            <label for="test">
                Test:
                <input type="text" id="test" name="test" class="w-100 mt-1" value="{{ old('test') ?? $test ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[setting_1]">
                {{ wpsp_trans('messages.title') }}:
                <input type="text" id="settings[setting_1]" name="settings[setting_1]" class="w-100 mt-1"
                       value="{{ old('settings.setting_1') ?? $settings['setting_1'] ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[setting_2]">
                {{ wpsp_trans('messages.title') }}:
                <input type="text" id="settings[setting_2]" name="settings[setting_2]" class="w-100 mt-1"
                       value="{{ old('settings.setting_2') ?? $settings['setting_2'] ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[logo]button">
                Logo:
                @include('admin-pages.common.media-upload', [
                    'attachment_id' => 'settings[logo_attachment_id]',
                    'attachment_name' => 'settings[logo_attachment_id]',
                    'attachment_value' => old('settings.logo_attachment_id') ?? $settings['logo_attachment_id'] ?? '',
                    'url_id' => 'settings[logo]',
                    'url_name' => 'settings[logo]',
                    'url_value' => old('settings.logo') ?? $settings['logo'] ?? '',
                    'class' => 'mt-1',
                    'button_id' => 'settings[logo]button',
                ])
            </label>
        </div>
    </x-slot:content>
</x-admin-pages.admin-page-meta-box>