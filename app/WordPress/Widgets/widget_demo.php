<?php

namespace WPSP\App\WordPress\Widgets;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Widgets\BaseWidget;

class widget_demo extends BaseWidget {

	use InstancesTrait;

//	public $id_base         = 'widget_demo';
//	public $name            = 'widget_demo';
//	public $widget_options  = [];
//	public $control_options = [];

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {
//		dump($request);
//	}

	/*
	 *
	 */

	/**
	 * Tùy chỉnh các tham số.
	 */
	public function customProperties() {
//		$this->id_base 	= 'widget_demo';
//		$this->name 	= 'widget_demo';
		$this->widget_options = [
//			'classname'                   => 'widget_demo',
			'description'                 => 'widget_demo - Description.',
//			'customize_selective_refresh' => true,
//			'show_instance_in_rest'       => true,
		];
//		$this->control_options = [
//			'width' => 400,
//			'height' => 350,
//			'id_base' => 'widget_demo',
//		];
	}

	/*
	 *
	 */

	/**
	 * Renders the widget content in front-end.
	 *
	 * @param array $args     An associative array of widget arguments.
	 * @param array $instance An associative array of widget instance settings.
	 *
	 * @return void
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];
		echo $args['before_title'] . ($instance['title'] ?? '') . $args['after_title'];
		echo 'widget_demo - Description.';
		echo $args['after_widget'];
	}

	/**
	 * Renders the form for the widget.
	 *
	 * @param array $instance The instance data of the widget, including parameters such as 'title'.
	 *
	 * @return void
	 */
	public function form($instance) {
		$title = $instance['title'] ?? '';
		echo <<<HTML
			<p>
				<label for="{$this->get_field_id('title')}">
					Tiêu đề:
				</label>

				<input class="widefat"
				       id="{$this->get_field_id('title')}"
				       name="{$this->get_field_name('title')}"
				       type="text"
				       value="{$title}"/>
			</p>
			HTML;
		echo '<p>widget_demo - Description.</p>';
	}

	/**
	 * Updates the widget instance with new values.
	 *
	 * @param array $new_instance The new instance data submitted by the widget form.
	 * @param array $old_instance The existing instance data of the widget.
	 *
	 * @return array The updated instance data with sanitized settings.
	 */
	public function update($new_instance, $old_instance) {
		$instance          = [];
		$instance['title'] = sanitize_text_field($new_instance['title']);
		return $instance;
	}

}