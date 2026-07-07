@component('components.admin-pages.common.popup', ['id' => 'popup_demo'])
	@slot('title')
		Popup demo
	@endslot

	@slot('content')
		Đây là popup demo
	@endslot

	@slot('footer')
		<button class="button button-secondary me-2 button-close-popup">Hủy bỏ</button>
		<button class="button button-primary">Lưu lại</button>
	@endslot
@endcomponent