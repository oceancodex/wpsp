class App {
    public constructor() {
        console.log('Hello World');

		this.clickCSRF();
    }

	public clickCSRF() {
		jQuery(($) => {
			$('body').on('click', 'button#csrf', (e) => {
				let csrf = $(e.currentTarget).closest('form').find('input[name="_token"]').val();

				fetch('/wp-json/wpsp/v1/test-rate-limit', {
					method: 'POST',
					credentials: 'include',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': csrf
					}
				}).then(r => console.log(r.status));
			})
		});
	}
}

new App();