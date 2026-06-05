<?php

namespace WPSP\App\WordPress\Customizers\customize_demo\Controls;

use WPSP\Funcs;

class ExampleControl extends \WP_Customize_Control {

	/*public function render_content() {
		?>
		<label for="_customize-input-<?php echo $this->id; ?>" class="customize-control-title"><?php echo esc_html($this->label); ?> (Legacy)</label>
		<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		<input id="_customize-input-<?php echo $this->id; ?>" type="text" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>"/>
		<?php
	}*/

	public function render_content() {
		echo Funcs::view('customizers.customize_demo.controls.example-control', ['control' => $this]);
	}

}