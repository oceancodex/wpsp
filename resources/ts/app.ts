class App {
	public constructor() {
		console.log('Hello World');

		this.clickCSRF();
	}

	public getCookie(name) {
		return document.cookie
		               .split('; ')
		               .find(row => row.startsWith(name + '='))
		               ?.split('=')[1];
	}

	public clickCSRF() {
		jQuery(($) => {
			$('body').on('click', 'button#csrf', (e) => {
				let csrf = $(e.currentTarget).closest('form').find('input[name="_token"]').val();
				let xsrf = decodeURIComponent(this.getCookie('wpsp-session-XSRF-TOKEN'));

				fetch('/wp-json/wpsp/v1/test-rate-limit', {
					method     : 'POST',
					credentials: 'include',
					headers    : {
						'Content-Type': 'application/json',
//						'wpsp-session-X-CSRF-TOKEN': csrf,
						'wpsp-session-X-XSRF-TOKEN': xsrf,
					}
				}).then(r => console.log(r.status));
			})
		});
	}
}

new App();