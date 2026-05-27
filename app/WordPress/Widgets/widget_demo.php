<?php

namespace WPSP\App\WordPress\Widgets;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Widgets\BaseWidget;

class widget_demo extends BaseWidget {

	use InstancesTrait;

	public $id_base         = 'widget_demo';
	public $name            = 'widget_demo';
	public $widget_options  = [];
	public $control_options = [];

	/*
	 *
	 */

	/**
	 * Tùy chỉnh các tham số.
	 */
	public function customProperties() {
//		$this->name 	= 'widget_demo';
//		$this->id_base 	= 'widget_demo';
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
		echo Funcs::view('widgets.widget_demo-form', compact('instance', 'title'))->with([
			'widget' => $this,
		])->render();
//		echo '<p>widget_demo - Description.</p>';
	}

	public function update($new_instance, $old_instance) {
		$instance          = [];
		$instance['title'] = sanitize_text_field($new_instance['title']);
		return $instance;
	}

}