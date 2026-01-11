class Admin {
	public constructor() {
		this.initWPMedia();
		this.initDateTimePicker();
	}

	public initWPMedia() {
		(function ($) {

			$(document).on('click', '.wpsp-admin-media-upload .button-upload', function (e) {
				e.preventDefault();

				const container = $(this).closest('.wpsp-admin-media-upload');
				const inputAttachment = container.find('.media-attachment-value');
				const inputURL = container.find('.media-url-value');
				const preview = container.find('.preview-image');
				const removeBtn = container.find('.button-remove');

				const title  = container.data('title') || 'Chọn hoặc upload media';
				const button = container.data('button') || 'Sử dụng media';

				let mediaFrame = container.data('mediaFrame');

				/**
				 * Nếu frame đã tồn tại cho container này → reuse
				 */
				if (mediaFrame) {
					mediaFrame.open();
					return;
				}

				mediaFrame = wp.media({
					title: title,
					button: { text: button },
					library: {
						type: ['image']
					},
					multiple: false
				});

				/**
				 * Restore selected image (giống edit post)
				 */
				mediaFrame.on('open', function () {
					const selection   = mediaFrame.state().get('selection');
					const attachmentId = inputAttachment.val();

					selection.reset();

					if (attachmentId) {
						const attachment = wp.media.attachment(attachmentId);
						attachment.fetch();
						selection.add(attachment);
					}
				});

				/**
				 * Khi chọn media
				 */
				mediaFrame.on('select', function () {
					const attachment = mediaFrame
						.state()
						.get('selection')
						.first()
						.toJSON();

					inputAttachment.val(attachment.id);
					inputURL.val(attachment.url);

					const imageUrl = attachment.sizes?.thumbnail?.url || attachment.url;

					preview
						.attr('src', imageUrl)
						.show();

					removeBtn.show();
				});

				// Lưu frame vào container
				container.data('mediaFrame', mediaFrame);

				mediaFrame.open();
			});

			/**
			 * Remove image
			 */
			$(document).on('click', '.wpsp-admin-media-upload .button-remove', function () {
				const container = $(this).closest('.wpsp-admin-media-upload');

				container.find('.media-attachment-value').val('');
				container.find('.media-url-value').val('');
				container.find('.preview-image').attr('src', '').hide();
				$(this).hide();
			});

		})(jQuery);
	}

	public initDateTimePicker() {
		(function ($) {
			$('.wpsp-admin-date-picker').datepicker({
				dateFormat: 'dd/mm/yy'
			});
		})(jQuery);
	}
}

new Admin();