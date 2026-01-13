<x-admin-pages.admin-page-meta-box id="testhiddendiv" :adminPageMetaBoxes="$admin_page_meta_boxes">
    <x-slot:title>Test hidden</x-slot:title>
    <x-slot:content>
        <p>Đây là meta box được xây dựng bằng Blade Template Engine và được gọi ra với phương thức "view".<br/>Khi sử dụng phương thức này, screen options sẽ cần được thiết lập để hiển thị ra.</p>
        Metabox này được ẩn mặc định để thử nghiệm việc khai báo meta boxes trong admin page class với hidden meta boxes.
    </x-slot:content>
</x-admin-pages.admin-page-meta-box>