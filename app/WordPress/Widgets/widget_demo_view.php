<?php

namespace WPSP\App\WordPress\Widgets;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Widgets\BaseWidget;

class widget_demo_view extends BaseWidget {

	use InstancesTrait;

	public $id_base         = 'widget_demo_view';
	public $name            = 'widget_demo_view';
	public $widget_options  = [];
	public $control_options = [];

	/*
	 *
	 */

	/**
	 * Tùy chỉnh các tham số.
	 */
	public function customProperties() {
//		$this->id_base 	= 'widget_demo_view';
//		$this->name 	= 'widget_demo_view';
		$this->widget_options = [
//			'classname'                   => 'widget_demo_view',
			'description'                 => 'widget_demo_view - Description.',
//			'customize_selective_refresh' => true,
//			'show_instance_in_rest'       => true,
		];
//		$this->control_options = [
//			'width' => 400,
//			'height' => 350,
//			'id_base' => 'widget_demo_view',
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
		echo Funcs::view('widgets.widget_demo_view.widget', compact('args', 'instance'))->with([
			'widget' => $this,
		])->render();
	}

	/**
	 * Renders the form for the widget.
	 *
	 * @param array $instance The instance data of the widget, including parameters such as 'title'.
	 *
	 * @return void
	 */
	public function form($instance) {
		echo Funcs::view('widgets.widget_demo_view.form', compact('instance'))->with([
			'widget' => $this,
		])->render();
	}

	public function update($new_instance, $old_instance) {
		$instance          = [];
		$instance['title'] = sanitize_text_field($new_instance['title']);
		return $instance;
	}

}