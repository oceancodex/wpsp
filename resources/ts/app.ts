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
			$('body').on('click', '.button-csrf', (e) => {
				let csrf = $(e.currentTarget).closest('form').find('input[name="_token"]').val();
				let xsrf = decodeURIComponent(this.getCookie('wpsp-session-XSRF-TOKEN'));
				let append = $(e.currentTarget).data('append');
				if (append) {
					xsrf += append;
				}

				fetch('/wp-json/wpsp/v1/test-rate-limit-token', {
					method     : 'POST',
					credentials: 'include',
					headers    : {
						'Content-Type': 'application/json',
//						'wpsp-session-X-CSRF-TOKEN': csrf,
						'wpsp-session-X-XSRF-TOKEN': xsrf,
						'X-Requested-With'         : 'XMLHttpRequest'
					},
					body       : JSON.stringify({})
				}).then(r => {
					const isOk = r.ok;
					const status = r.status;
					return r.json().then((data: any) => ({isOk, status, data}));
				}).then(({isOk, status, data}) => {
					if (isOk) {
						(<any>window).toastr.success(data.data?.message || data.message || "Thành công!");
					}
					else {
						const errorMsg = status === 429
							? "Bạn đã thao tác quá nhanh. Vui lòng thử lại sau!"
							: (data.message || "Đã có lỗi xảy ra!");

						(<any>window).toastr.error(errorMsg);
					}

					console.log(data.message);
				}).catch(err => {
					(<any>window).toastr.error("Không thể kết nối đến máy chủ.");
				});
			});
		});
	}
}

new App();