<?php

namespace WPSP\App\WordPress\Customizers;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Customizers\BaseCustomize;

class customize_demo extends BaseCustomize {

	use InstancesTrait;

//	public  $name   = null;
	private $prefix = null;

	/*
	 *
	 */

	public function customProperties() {
		$this->name = basename(get_class($this));
		$this->prefix = Funcs::instance()->_getAppShortName() . '_';
	}

	/*
	 *
	 */

	public function panels(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_panel(
			$this->prefix . 'panel_' . $this->name,
			[
				'title'       => __($this->rootNamespace . ' Panel: ' . $this->name, 'wpsp'),
				'description' => $this->rootNamespace . ' Panel: ' . $this->name . ' description',
				'priority'    => 160,
			]
		);
	}

	public function sections(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_section(
			$this->prefix . 'section_' . $this->name,
			[
				'title'    => __($this->rootNamespace . ' Section: ' . $this->name, 'wpsp'),
				'priority' => 30,
				'panel'    => $this->prefix . 'panel_' . $this->name,
			]
		);
	}

	public function controls(\WP_Customize_Manager $wpCustomizeManager) {
		$wpCustomizeManager->add_control(
			$this->prefix . 'control_' . $this->name,
			[
				'label'    => __('Customize text', 'wpsp'),
				'section'  => $this->prefix . 'section_' . $this->name,
				'settings' => $this->prefix . 'customize_text_' . $this->name,
				'type'     => 'text',
			]
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