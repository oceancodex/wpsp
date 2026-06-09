class Admin {

	public constructor() {
		this.initWPMedia();
		this.initDateTimePicker();
		this.initFormRepeater();
		this.initSelectize();
		this.initAutoNumeric();
	}

	public initWPMedia() {
		(function($) {

			$(document).on('click', '.wpsp-admin-media-upload .button-upload', function (e) {
				e.preventDefault();

				const container = $(this).closest('.wpsp-admin-media-upload');
				const inputAttachment = container.find('.media-attachment-value');
				const inputURL = container.find('.media-url-value');
				const preview = container.find('.preview-image');
				const inputFileName = container.find('.media-file-name-value');
				const removeBtn = container.find('.button-remove');

				const title = container.data('title') || 'Chọn hoặc upload media';
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
					title   : title,
					button  : {text: button},
					library : {
						type: ['image']
					},
					multiple: false
				});

				/**
				 * Restore selected image (giống edit post)
				 */
				mediaFrame.on('open', function() {
					const selection = mediaFrame.state().get('selection');
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
				mediaFrame.on('select', function() {
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

					inputFileName.val(attachment.filename);

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
				let noImageURL = container.attr('data-no_image_url');

				container.find('.media-attachment-value').val('');
				container.find('.media-url-value').val('');
				container.find('.preview-image').attr('src', noImageURL);
				container.find('.media-file-name-value').val('');
			});

		})(jQuery);
	}

	public initDateTimePicker() {
		(function($) {
			$('document').ready(function() {
				$('.wpsp-admin-date-picker').datepicker({
					dateFormat: 'dd/mm/yy'
				});
			});
		})(jQuery);
	}

	public initFormRepeater() {
		const self = this;

		jQuery(($) => {
			$(document).ready((e)=> {
				if (typeof (<any>$.fn).repeater === 'function') {
					(<any>$('.repeater')).repeater({
						// (Optional)
						// start with an empty list of repeaters. Set your first (and only)
						// "data-repeater-item" with style="display:none;" and pass the
						// following configuration flag
						initEmpty: false,
						// (Optional)
						// "defaultValues" sets the values of added items.  The keys of
						// defaultValues refer to the value of the input's name attribute.
						// If a default value is not specified for an input, then it will
						// have its value cleared.
						defaultValues: {
							'text-input': 'foo'
						},
						// (Optional)
						// "show" is called just after an item is added.  The item is hidden
						// at this point.  If a show callback is not given the item will
						// have $(this).show() called on it.
						show: function() {
							$(this).slideDown();

							// Reset select về option đầu tiên
							$(this).find('select').each(function() {
								this.selectedIndex = 0;
							});

							let repeaterValueElements = $(this).find('[data-repeater_value]');
							repeaterValueElements.each((index, element) => {
								let value = $(element).attr('data-repeater_value');
								$(element).val(value);
							});

							let repeaterInnerElements = $(this).find('[data-repeater_inner]');
							repeaterInnerElements.each((index, element) => {
								let inner = $(element).attr('data-repeater_inner');
								$(element).html(inner);
							});

							let time :any = new Date();
							time = time.getTime();
							$(this).find('.wpsp-autonumeric').attr('data-unique_id', time);

							self.initAutoNumeric('[data-unique_id="' + time + '"]');

							(<any>window).FinanceInvoicesCreate.triggerInvoiceItemsChange();
						},
						// (Optional)
						// "hide" is called when a user clicks on a data-repeater-delete
						// element.  The item is still visible.  "hide" is passed a function
						// as its first argument which will properly remove the item.
						// "hide" allows for a confirmation step, to send a delete request
						// to the server, etc.  If a hide callback is not given the item
						// will be deleted.
						hide: function(deleteElement) {
							// if(confirm('Are you sure you want to delete this element?')) {
							$(this).slideUp(deleteElement);
							// }
						},
						// (Optional)
						// You can use this if you need to manually re-index the list
						// for example if you are using a drag and drop library to reorder
						// list items.
						// ready: function (setIndexes) {
						//     $dragAndDrop.on('drop', setIndexes);
						// },
						// (Optional)
						// Removes the delete button from the first list item,
						// defaults to false.
						isFirstItemUndeletable: true
					});
				}
			});
		});
	}

	public initSelectize() {
		jQuery(($) => {
			$(function () {
				const instances: any[] = [];

				$('select.selectize').each(function () {
					const element = this as HTMLSelectElement & {
						selectize?: any
					};

					// Tránh init nhiều lần
					if (element.selectize) {
						return;
					}

					const selectize = ($(element) as any).selectize({
						placeholder: '- Chọn -',
						plugins: ['auto_position'],
						onFocus: function () {
							instances.forEach(instance => {
								if (instance !== this) {
									instance.close();
									instance.blur();
								}
							});
						}
					})[0].selectize;

					instances.push(selectize);
				});
			});
		});
	}

	public initAutoNumeric(selector: string = '.wpsp-autonumeric', force = false) {
		jQuery(() => {
			if (force) {
				new (<any>window).AutoNumeric.multiple(selector, {
					digitGroupSeparator       : '.',
					decimalCharacter          : ',',
					decimalPlaces             : 0,
					decimalPlacesRawValue     : 0,
					decimalPlacesShownOnBlur  : 0,
					decimalPlacesShownOnFocus : 0
				});
			}
			else {
				document.querySelectorAll(selector).forEach((element: any) => {

					// Skip nếu đã init
					if ((<any>window).AutoNumeric.getAutoNumericElement(element)) {
						return;
					}

					new (<any>window).AutoNumeric(element, {
						digitGroupSeparator       : '.',
						decimalCharacter          : ',',
						decimalPlaces             : 0,
						decimalPlacesRawValue     : 0,
						decimalPlacesShownOnBlur  : 0,
						decimalPlacesShownOnFocus : 0
					});
				});
			}
		});
	}

}

new Admin();