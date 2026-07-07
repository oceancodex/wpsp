<div data-repeater-item class="repeater-demo-item row mt-1 gx-2 align-items-center">
	<!--  Base name -->
	<input type="hidden"
	       name="repeater_demo[0][id]"
	       data-item_base_name="repeater_demo[0]"
	       value=""/>

	<!-- Name -->
	<div class="col col-2">
		<input name="repeater_demo[0][name]"
			   type="text"
			   class="w-100 d-block"
			   placeholder="Tên hạng mục"/>
	</div>

	<!-- Unit price -->
	<div class="col col-2 text-end">
		<div class="d-flex">
			<input name="repeater_demo[0][unit_price]"
			       id="repeater_demo[0][unit_price]"
			       type="text"
			       step="0.01"
			       class="wpsp-autonumeric w-100 text-end"
			       data-repeater_value="0"
			       value=""
			       placeholder="Đơn giá"/>
			@include('admin-pages.common.form-elements.select', [
				'name' => 'repeater_demo[0][currency]',
				'options' => [
					'VND' => 'VND',
				],
				'value' => 'VND',
			])
		</div>
	</div>

	<!-- Time -->
	<div class="col col-2">
		<input id="repeater_demo[0][issue_date]"
		       name="repeater_demo[0][issue_date]"
		       type="text"
		       class="wpsp-admin-date-picker w-100"
		       value=""
		       placeholder="Thời gian"/>
	</div>

	<!-- Actions -->
	<div class="col col-auto text-end">
		<input data-repeater-delete class="button" type="button" value="Xóa"/>
	</div>
</div>