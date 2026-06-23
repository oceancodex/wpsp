jQuery(function($) {
	$('body').on('click', '#doaction, #doaction2', function(e) {
		let action = $(e.currentTarget).closest('.bulkactions').find('select[name^="action"]').val();
		if (action === 'bulk_edit') {
			e.preventDefault();
			let form = $(e.currentTarget).closest('form');
			let bulkEditPanel = $(form).find('.bulk-edit-panel');
			bulkEditPanel.show();
			bulkEditPanel[0].scrollIntoView({behavior: 'smooth', block: 'start'});

			bulkEditPanel.find('button.cancelled').on('click', function() {
				bulkEditPanel.hide();
			});
		}
	});
});