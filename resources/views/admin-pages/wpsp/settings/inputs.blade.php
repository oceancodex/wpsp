<x-admin-pages.admin-page-meta-box id="inputsdiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Cài đặt</x-slot:title>
    <x-slot:content>
        <p>Đây là meta box được xây dựng bằng Blade Template Engine và được gọi ra với phương thức "view".<br/>Khi sử dụng phương thức này, screen options sẽ cần được thiết lập để hiển thị ra.</p>

		<div class="input-group mt-2">
			<label for="settings[logo]button" class="d-inline-block">
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

        <div class="input-group mt-3">
            <label for="test">
                Test (required, min: 10):
                <input type="text" id="test" name="test" class="w-100 mt-1" value="{{ old('test') ?? $test ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[setting_1]">
				Setting 1:
                <input type="text" id="settings[setting_1]" name="settings[setting_1]" class="w-100 mt-1"
                       value="{{ old('settings.setting_1') ?? $settings['setting_1'] ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[setting_2]">
                Setting 2:
                <input type="text" id="settings[setting_2]" name="settings[setting_2]" class="w-100 mt-1"
                       value="{{ old('settings.setting_2') ?? $settings['setting_2'] ?? '' }}"/>
            </label>
        </div>

        <div class="input-group mt-3">
            <label for="settings[setting_2]">
                {{ wpsp_trans('messages.expiry_date') }}:
                <input type="text"
					   id="settings[expiry_date]"
					   name="settings[expiry_date]"
					   class="w-100 mt-1 wpsp-admin-date-picker"
                       value="{{ old('settings.expiry_date') ?? $settings['expiry_date'] ?? '' }}"/>
            </label>
        </div>

		<div class="input-group mt-3">
			<a href="javascript:void(0);" class="button-open-popup button button-primary" data-target_popup_selector="#popup_demo">Popup demo</a>
			@include('admin-pages.wpsp.settings.popup-demo')
		</div>

		<div class="input-group mt-3">
			<div class="repeater">
				<div data-repeater-list="settings[repeater_demo]" class="repeater-demo">
					@foreach($settings['repeater_demo'] as $key => $item)
						@include('admin-pages.wpsp.settings.repeater-item', ['id' => $key, 'item' => $item])
					@endforeach
				</div>
				<input data-repeater-create class="button button-primary mt-3" type="button" value="Thêm"/>
			</div>
		</div>
    </x-slot:content>
</x-admin-pages.admin-page-meta-box>