<div class="handle-actions hide-if-no-js">
    <button type="button" class="handle-order-higher" aria-disabled="false" aria-describedby="wpsp_shortcode-handle-order-higher-description">
        <span class="screen-reader-text">Di chuyển lên</span>
        <span class="order-higher-indicator" aria-hidden="true"></span>
    </button>
    <span class="hidden" id="wpsp_shortcode-handle-order-higher-description">Chuyển {{ $name }} lên trên</span>
    <button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="wpsp_shortcode-handle-order-lower-description">
        <span class="screen-reader-text">Di chuyển xuống</span>
        <span class="order-lower-indicator" aria-hidden="true"></span>
    </button>
    <span class="hidden" id="wpsp_shortcode-handle-order-lower-description">Chuyển {{ $name }} xuống dưới</span>
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Chuyển đổi bảng điều khiển: {{ $name }}</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
</div>