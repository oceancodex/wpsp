<p>
	<label for="{{ $widget->get_field_id('title') }}">
		Tiêu đề:
	</label>
	<input class="widefat"
	       id="{{ $widget->get_field_id('title') }}"
	       name="{{ $widget->get_field_name('title') }}"
	       type="text"
	       value="{{ esc_attr($instance['title'] ?? '') }}"/>
</p>