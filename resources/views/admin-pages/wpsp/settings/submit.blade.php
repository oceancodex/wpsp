<x-admin-pages.admin-page-meta-box id="submitdiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Lưu thay đổi</x-slot:title>
    <x-slot:content>
        <div class="p-2 text-end bg-light">
            <button type="submit" class="button button-primary">{{ wpsp_trans('messages.save_changes') }}</button>
        </div>
    </x-slot:content>
</x-admin-pages.admin-page-meta-box>