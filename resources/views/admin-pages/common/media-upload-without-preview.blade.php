<div class="wpsp-admin-media-upload {{ $class ?? '' }}" data-no_image_url="{{ wpsp_asset('widen/media/images/no-image.jpg') }}">
	<div class="d-flex align-items-start gap-0">
		<button class="button button-primary button-upload" type="button" id="{{ $button_id ?? '' }}">Chọn tệp tin</button>
		<div class="hiddenx mb-0 flex-grow-1">
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
			       class="media-file-name-value m-0 w-100"
			       placeholder="File name"
			/>
		</div>
		<button class="button button-remove" type="button">Xóa</button>
	</div>
</div>