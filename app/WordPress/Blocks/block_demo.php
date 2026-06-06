<?php
namespace WPSP\App\WordPress\Blocks;

use WPSP\App\Services\TestService;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\Blocks\BaseBlock;

/**
 * @docs https://developer.wordpress.org/block-editor/
 */
class block_demo extends BaseBlock {

	use InstancesTrait;

	public $name 		= 'block-demo';
//	public $blockPath   = null;
//	public $args		= [];

	/**
	 * Custom properties.
	 */
	public function customProperties() {
		$this->args = [
//			'api_version'            => '',
//			'title'                  => '',
//			'category'               => null,
//			'parent'                 => null,
//			'ancestor'               => null,
//			'allowed_blocks'         => null,
//			'icon'                   => null,
//			'description'            => '',
//			'keywords'               => [],
//			'textdomain'             => null,
//			'styles'                 => [],
//			'variations'             => [],
//			'selectors'              => [],
//			'supports'               => null,
//			'example'                => null,
//			'render_callback'        => function($attributes, $content, $block) { return 'Custom block "block-demo": ' . $attributes['title'] ?? null; }
//			'variation_callback'     => null,
//			'attributes'             => null,
//			'uses_context'           => [],
//			'provides_context'       => null,
//			'block_hooks'            => [],
//			'editor_script_handles'  => [],
//			'script_handles'         => [],
//			'view_script_handles'    => [],
//			'editor_style_handles'   => [],
//			'style_handles'          => [],
//			'view_style_handles'     => [],
		];
	}

	/**
	 * Renders the view for the specified block with the given attributes and content.
	 *
	 * @param array     $attributes An array of attributes for the block.
	 * @param string    $content    The inner content of the block.
	 * @param \WP_Block $block      The block data structure.
	 */
	public function render(array $attributes, string $content, \WP_Block $block, TestService $testService) {
		$attributes['test'] = $testService->test();
		return Funcs::view('blocks.src.block-demo.render', compact('attributes', 'content', 'block'));
	}

}