<p>
	<label for="{{ $widget->get_field_id('title') }}">
		<?php _e('Tiêu đề:', 'text-domain'); ?>
	</label>
	<input class="widefat"
	       id="{{ $widget->get_field_id('title') }}"
	       name="{{ $widget->get_field_name('title') }}"
	       type="text"
	       value="{{ esc_attr($title) }}"/>
</p>