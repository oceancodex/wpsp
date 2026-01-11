<div id="{{ $id }}"
     class="postbox
     {{ $isClosed ? 'closed' : '' }}
     {{ $isHidden ? 'hidden' : '' }}
     ">
    <div class="postbox-header">
        <h2 class="hndle ui-sortable-handle">
            {{ $title ?? 'Meta box title' }}
        </h2>
        <div class="handle-actions">
            <button type="button" class="handle-order-higher" aria-disabled="true" aria-describedby="{{ $id }}-handle-order-higher-description">
                <span class="screen-reader-text">Di chuyển lên</span>
                <span class="order-higher-indicator" aria-hidden="true"></span>
            </button>
            <span class="hidden" id="{{ $id }}-handle-order-higher-description">Chuyển Xuất bản lên trên</span>

            <button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="{{ $id }}-handle-order-lower-description">
                <span class="screen-reader-text">Di chuyển xuống</span>
                <span class="order-lower-indicator" aria-hidden="true"></span>
            </button>
            <span class="hidden" id="{{ $id }}-handle-order-lower-description">Chuyển Xuất bản xuống dưới</span>

            <button type="button" class="handlediv" aria-expanded="true">
                <span class="screen-reader-text">Chuyển đổi bảng điều khiển: Xuất bản</span>
                <span class="toggle-indicator" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    <div class="inside">
        {!! $content !!}
    </div>
</div>