document.querySelectorAll('.loading-indicator').forEach(button => {
	button.addEventListener('click', function() {
		// 1. Xóa class để hiển thị loading indicator
		this.classList.remove('loading-indicator-hidden');

		// 2. Thêm lại class sau 2 giây (2000ms)
		setTimeout(() => {
			this.classList.add('loading-indicator-hidden');
		}, 2000);
	});
});