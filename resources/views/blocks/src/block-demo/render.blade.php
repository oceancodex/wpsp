<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php echo 'Custom block "' . $block->name . '" - frontend content'; ?>
	<br/>
	Title attribute value: <strong>{!! $attributes['title'] ?? null !!}</strong>
</div>