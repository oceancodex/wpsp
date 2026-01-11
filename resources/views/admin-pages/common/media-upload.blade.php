<div class="wpsp-admin-media-upload {{ $class ?? '' }}">
    <img class="preview-image d-block mb-2 border" style="max-width:100px;" alt="" src="{{ $url_value ?: wpsp_asset('widen/media/images/no-image.jpg') }}"/>
    <div class="hiddenx mb-2">
        <input type="text"
               id="{{ $attachment_id ?? '' }}"
               name="{{ $attachment_name ?? '' }}"
               value="{{ $attachment_value ?? '' }}"
               class="media-attachment-value hiddenx m-0"
               placeholder="Media ID"
        />
        <input type="text"
               id="{{ $url_id ?? '' }}"
               name="{{ $url_name ?? '' }}"
               value="{{ $url_value ?? '' }}"
               class="media-url-value hiddenx m-0"
               placeholder="Media URL"
        />
    </div>
    <button class="button button-upload" type="button" id="{{ $button_id ?? '' }}">Chọn ảnh</button>
</div>