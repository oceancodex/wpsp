<div class="wpsp-admin-media-upload {{ $class ?? '' }}" data-no_image_url="{{ wpsp_asset('widen/media/images/no-image.jpg') }}">
    <img class="preview-image d-block mb-2 border" style="max-width:118px;" alt="" src="{{ $url_value ?: wpsp_asset('widen/media/images/no-image.jpg') }}"/>
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
		<input type="text"
	           id="{{ $file_name_id ?? '' }}"
	           name="{{ $file_name_name ?? '' }}"
	           value="{{ $file_name_value ?? '' }}"
	           class="media-file-name-value hiddenx m-0"
	           placeholder="File name"
		/>
    </div>
    <button class="button button-primary button-small button-upload" type="button" id="{{ $button_id ?? '' }}">Chọn tệp tin</button>
	<button class="button button-small button-remove" type="button">Xóa</button>
</div>