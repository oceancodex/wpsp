<?php

namespace WPSP\App\WordPress\Customizers\customize_demo;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\App\WordPress\Customizers\customize_demo\Controls\ExampleControl;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Customizers\BaseCustomize;

/**
 * @see https://developer.wordpress.org/themes/classic-themes/customize-api/customizer-objects/
 */
class customize_demo extends BaseCustomize {

	use InstancesTrait;

//	public  $name   = 'customize_demo';
	private $prefix = null;

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {
//		dump($request);
//	}

	/*
	 *
	 */

	public function customProperties(Request $request) {
//		$this->name   = class_basename($this);
		$this->prefix = Funcs::instance()->_getAppShortName() . '_';
	}

	/*
	 *
	 */

	public function panels(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_panel(
			$this->prefix . 'panel_' . $this->name,
			[
				'title'       => $this->rootNamespace . ' Panel: ' . $this->name,
				'description' => $this->rootNamespace . ' Panel: ' . $this->name . ' description',
				'priority'    => 160,
			]
		);
	}

	public function sections(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_section(
			$this->prefix . 'section_' . $this->name,
			[
				'title'       => $this->rootNamespace . ' Section: ' . $this->name,
				'description' => $this->rootNamespace . ' Section: ' . $this->name . ' description',
				'panel'       => $this->prefix . 'panel_' . $this->name,
				'priority'    => 30,
				'capability'  => 'edit_theme_options',
//				'theme_supports' => '',
			]
		);
	}

	public function controls(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_control(
			$this->prefix . 'control_' . $this->name,
			[
				'type'            => 'text',
				'label'           => 'Customize text',
				'description'     => $this->rootNamespace . ' Control: ' . $this->name . ' description',
				'section'         => $this->prefix . 'section_' . $this->name,
				'priority'        => 10, // Within the section.
//				'input_attrs' => [
//					'class'       => 'custom-class-for-js',
//					'style'       => 'border: 1px solid #900',
//					'placeholder' => __('mm/dd/yyyy'),
//				],
				'settings'        => $this->prefix . 'customize_text_' . $this->name,
//				'active_callback' => 'is_front_page', // Quyết định control có được hiển thị (active) hay không. (callable)
//				'mime_type' 	  => 'image',
			]
		);

		$wpCustomizeManager->add_control(
			new ExampleControl(
				$wpCustomizeManager,
				$this->prefix . 'example_control_' . $this->name,
				[
					'label'   => 'Example Control Label',
					'description' => $this->rootNamespace . ' Example Control: ' . $this->name . ' description',
					'section' => $this->prefix . 'section_' . $this->name,
				]
			)
		);
	}

	public function settings(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_setting(
			$this->prefix . 'customize_text_' . $this->name,
			[
				'type'                 => 'theme_mod', // or "option"
				'capability'           => 'edit_theme_options',
//				'theme_supports'       => '',
				'default'              => '',
				'transport'            => 'refresh', // or "postMessage"
				'sanitize_callback'    => 'sanitize_text_field',
//				'sanitize_js_callback' => function($value) { return strtoupper($value); },
			]
		);

		$wpCustomizeManager->add_setting(
			$this->prefix . 'example_control_' . $this->name,
			[
				'default' => '',
			]
		);
	}

	/*
	 *
	 */

	public function hooks() {
//		add_action(...);
	}

	/*
	 *
	 */

	public function controlStyles() {}

	public function controlScripts() {
		wp_enqueue_script($this->name . '-control-script', Funcs::asset('js/Customizers/wpsp-control-script.js'), null, time(), ['in_footer' => 'true']);
	}

	public function controlLocalizeScripts() {}

	/*
	 *
	 */

	public function previewStyles() {}

	public function previewScripts() {
		wp_enqueue_script($this->name . '-preview-script', Funcs::asset('js/Customizers/wpsp-preview-script.js'), ['customize-preview'], time(), ['in_footer' => 'true']);
	}

	public function previewLocalizeScripts() {}

}