<div id="submitdiv" class="postbox @if(isset($metaboxes['closed']['submitdiv'])) closed @endif @if(isset($metaboxes['hidden']['submitdiv'])) hidden @endif">
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