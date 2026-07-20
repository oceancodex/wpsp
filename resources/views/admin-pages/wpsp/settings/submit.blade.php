<x-admin-pages.admin-page-meta-box id="submitdiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Lưu thay đổi</x-slot:title>
    <x-slot:content>
        <p class="mt-0">Đây là meta box được xây dựng bằng Blade Template Engine và được gọi ra với phương thức "view".<br/>Khi sử dụng phương thức này, screen options sẽ cần được thiết lập để hiển thị ra.</p>
    </x-slot:content>
	<x-slot:footer>
		<button type="submit" class="button button-primary">{{ wpsp_trans('messages.save_changes') }}</button>
	</x-slot:footer>
</x-admin-pages.admin-page-meta-box>